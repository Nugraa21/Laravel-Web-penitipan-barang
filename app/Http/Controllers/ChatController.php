<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a list of conversations (Admin & Super Admin only).
     */
    public function inbox()
    {
        $currentUser = Auth::user();
        if (!in_array($currentUser->role, ['admin', 'super_admin'])) {
            return redirect()->route('chat.index');
        }

        $partnerIds = collect();

        if ($currentUser->role === 'admin') {
            // Admins see all users who have sent/received messages
            $userIds = ChatMessage::join('users as senders', 'chat_messages.sender_id', '=', 'senders.id')
                ->where('senders.role', 'user')->pluck('sender_id');
            $partnerIds = $partnerIds->merge($userIds);

            $userIds2 = ChatMessage::join('users as receivers', 'chat_messages.receiver_id', '=', 'receivers.id')
                ->where('receivers.role', 'user')->pluck('receiver_id');
            $partnerIds = $partnerIds->merge($userIds2);

            // Admins ALSO see all Super Admins
            $superAdmins = User::where('role', 'super_admin')->pluck('id');
            $partnerIds = $partnerIds->merge($superAdmins);
        } else if ($currentUser->role === 'super_admin') {
            // Super admins see all Admins
            $allAdmins = User::where('role', 'admin')->pluck('id');
            $partnerIds = $partnerIds->merge($allAdmins);
        }

        $customerIds = $partnerIds->unique();

        $conversations = $customerIds->map(function ($userId) use ($currentUser) {
            $user = User::find($userId);
            if (!$user)
                return null;

            $lastMessage = ChatMessage::where(function ($q) use ($userId, $currentUser, $user) {
                if ($user->role === 'user') {
                    // Chat between ANY admin and User
                    $q->where('sender_id', $userId)->orWhere('receiver_id', $userId);
                } else {
                    // Chat exactly between currentUser and the partner (admin/super_admin)
                    $q->where(function ($q2) use ($userId, $currentUser) {
                        $q2->where('sender_id', $currentUser->id)->where('receiver_id', $userId);
                    })->orWhere(function ($q2) use ($userId, $currentUser) {
                        $q2->where('sender_id', $userId)->where('receiver_id', $currentUser->id);
                    });
                }
            })->latest()->first();

            $unreadCountQuery = ChatMessage::where('sender_id', $userId)->where('is_read', false);

            if ($user->role === 'user') {
                // For Admin reading User messages (sent to any admin -> receiver_id null or self)
                $unreadCountQuery->where(function ($q) use ($currentUser) {
                    $q->whereNull('receiver_id')->orWhere('receiver_id', $currentUser->id);
                });
            } else {
                // For direct communication sent exactly to currentUser
                $unreadCountQuery->where('receiver_id', $currentUser->id);
            }
            $unreadCount = $unreadCountQuery->count();

            return (object) [
                'user' => $user,
                'last_message' => $lastMessage,
                'unread_count' => $unreadCount
            ];
        })->filter()->sortByDesc(function ($conv) {
            return $conv->last_message->created_at ?? now()->subYears(10);
        });

        return view('chat.inbox', compact('conversations'));
    }

    /**
     * Display the unified chat thread for a user.
     */
    public function index($userId = null)
    {
        $currentUser = Auth::user();

        if ($currentUser->role === 'user') {
            $userId = $currentUser->id;
        } elseif (!$userId) {
            return redirect()->route('chat.inbox');
        }

        $chatUser = User::findOrFail($userId);

        // Security role restrictions
        if ($currentUser->role === 'super_admin' && $chatUser->role !== 'admin') {
            abort(403, 'Abaikan: Super admin hanya bisa chat dengan admin.');
        }

        // Fetch user items for selection
        $userItems = collect();
        if (in_array($currentUser->role, ['admin', 'super_admin'])) {
            $userItems = Item::with('user')->latest()->get();
        } else {
            $userItems = Item::where('user_id', $currentUser->id)->latest()->get();
        }

        // Order by DESC for flex-col-reverse
        $messages = ChatMessage::with(['sender', 'item'])
            ->where(function ($q) use ($userId, $currentUser, $chatUser) {
                if ($chatUser->role === 'user') {
                    // Chat between System/Admins and User
                    $q->where('sender_id', $userId)->orWhere('receiver_id', $userId);
                } else {
                    // Chat exactly between currentUser and chatUser
                    $q->where(function ($q2) use ($userId, $currentUser) {
                        $q2->where('sender_id', $currentUser->id)->where('receiver_id', $userId);
                    })->orWhere(function ($q2) use ($userId, $currentUser) {
                        $q2->where('sender_id', $userId)->where('receiver_id', $currentUser->id);
                    });
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Mark incoming messages as read
        if ($currentUser->role === 'admin' && $chatUser->role === 'user') {
            ChatMessage::where('sender_id', $userId)
                ->where(function ($q) use ($currentUser) {
                    $q->whereNull('receiver_id')->orWhere('receiver_id', $currentUser->id);
                })
                ->update(['is_read' => true]);
        } elseif ($currentUser->role === 'user') {
            ChatMessage::where('receiver_id', $currentUser->id)
                ->update(['is_read' => true]);
        } else {
            // Admin <-> SuperAdmin
            ChatMessage::where('sender_id', $userId)
                ->where('receiver_id', $currentUser->id)
                ->update(['is_read' => true]);
        }

        $contextItem = null;
        if (request()->has('item_id')) {
            $contextItem = Item::find(request()->item_id);
        }

        return view('chat.index', compact('chatUser', 'messages', 'contextItem', 'userItems'));
    }

    /**
     * Poll for new messages within a thread.
     */
    public function poll(Request $request, $userId = null)
    {
        $currentUser = Auth::user();
        if ($currentUser->role === 'user') {
            $userId = $currentUser->id;
        }

        $chatUser = User::find($userId);
        if (!$chatUser) {
            return response()->json(['html' => '', 'last_id' => $request->input('last_id', 0)]);
        }

        $lastId = $request->input('last_id', 0);
        $messages = ChatMessage::with(['sender', 'item'])
            ->where(function ($q) use ($userId, $currentUser, $chatUser) {
                if ($chatUser->role === 'user') {
                    $q->where('sender_id', $userId)->orWhere('receiver_id', $userId);
                } else {
                    $q->where(function ($q2) use ($userId, $currentUser) {
                        $q2->where('sender_id', $currentUser->id)->where('receiver_id', $userId);
                    })->orWhere(function ($q2) use ($userId, $currentUser) {
                        $q2->where('sender_id', $userId)->where('receiver_id', $currentUser->id);
                    });
                }
            })
            ->where('id', '>', $lastId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($messages->isEmpty()) {
            return response()->json(['html' => '', 'last_id' => $lastId]);
        }

        // Mark as read
        if ($currentUser->role === 'admin' && $chatUser->role === 'user') {
            ChatMessage::where('sender_id', $userId)
                ->where(function ($q) use ($currentUser) {
                    $q->whereNull('receiver_id')->orWhere('receiver_id', $currentUser->id);
                })
                ->where('id', '>', $lastId)
                ->update(['is_read' => true]);
        } elseif ($currentUser->role === 'user') {
            ChatMessage::where('receiver_id', $currentUser->id)
                ->where('id', '>', $lastId)
                ->update(['is_read' => true]);
        } else {
            ChatMessage::where('sender_id', $userId)
                ->where('receiver_id', $currentUser->id)
                ->where('id', '>', $lastId)
                ->update(['is_read' => true]);
        }

        $html = view('chat.partials.messages', compact('messages'))->render();
        $newLastId = $messages->first()->id;

        return response()->json(['html' => $html, 'last_id' => $newLastId]);
    }

    /**
     * Store a new message in the thread.
     */
    public function store(Request $request, $userId = null)
    {
        $currentUser = Auth::user();

        if ($currentUser->role === 'user') {
            $receiverId = null; // Broadcast to admins
        } else {
            // Admin sending to user/super_admin, Superadmin sending to Admin
            $receiverId = $userId;
        }

        $request->validate([
            'message' => 'required|string|max:1000',
            'item_id' => 'nullable|exists:items,id'
        ]);

        ChatMessage::create([
            'sender_id' => $currentUser->id,
            'receiver_id' => $receiverId,
            'item_id' => $request->item_id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan terkirim.');
    }

    /**
     * Poll for new notifications globally.
     */
    public function notifications()
    {
        $user = Auth::user();
        if (!$user)
            return response()->json(['count' => 0]);

        $query = ChatMessage::with('sender')->where('is_read', false);

        if ($user->role === 'admin') {
            $query->where(function ($q) use ($user) {
                // messages broadcasted to admin OR directly to this admin
                $q->whereNull('receiver_id')->orWhere('receiver_id', $user->id);
            });
        } elseif ($user->role === 'super_admin') {
            $query->where('receiver_id', $user->id);
        } else {
            $query->where('receiver_id', $user->id);
        }

        $count = $query->count();
        $latestUnread = $query->latest()->first();

        return response()->json([
            'count' => $count,
            'latest' => $latestUnread ? [
                'id' => $latestUnread->id,
                'sender_name' => collect(['admin', 'super_admin'])->contains($latestUnread->sender->role) && $user->role === 'user' ? 'Customer Support' : $latestUnread->sender->name,
                'sender_id' => $latestUnread->sender_id,
                'message' => \Illuminate\Support\Str::limit($latestUnread->message, 50),
                'time' => $latestUnread->created_at->diffForHumans()
            ] : null
        ]);
    }

    /**
     * Delete a chat message and log the action.
     */
    public function destroy(ChatMessage $message)
    {
        $user = Auth::user();

        // Check permission (user can delete their own, admin/super_admin can delete any)
        if ($user->role === 'user' && $message->sender_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $messageContent = $message->message;
        $messageSender = $message->sender->name;

        // Log the deletion action to Super Admin
        UserLog::create([
            'user_id' => $user->id,
            'action' => 'Chat Deleted',
            'description' => "Menghapus pesan dari {$messageSender}: \"" . \Illuminate\Support\Str::limit($messageContent, 50) . "\"",
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $message->delete();

        return response()->json(['success' => true]);
    }
}
