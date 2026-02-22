<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function inbox()
    {
        $user = auth()->user();

        $query = Item::query();
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        // Ambil semua item beserta pesannya, urutkan berdasarkan pesan terakhir atau waktu pembuatan item
        $items = $query->with([
            'user',
            'messages' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }
        ])->get()->sortByDesc(function ($item) {
            return $item->messages->first()->created_at ?? $item->created_at;
        });

        return view('chat.inbox', compact('items'));
    }

    public function index(Item $item)
    {
        $user = auth()->user();
        if ($user->role !== 'admin' && $user->id !== $item->user_id) {
            abort(403);
        }

        $messages = $item->messages()->with('sender')->orderBy('created_at', 'desc')->get();

        // Mark as read
        $item->messages()->where('sender_id', '!=', $user->id)->update(['is_read' => true]);

        return view('chat.index', compact('item', 'messages'));
    }

    public function poll(Request $request, Item $item)
    {
        $user = $request->user();
        if ($user->role !== 'admin' && $user->id !== $item->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $lastId = $request->input('last_id', 0);
        $messages = $item->messages()
            ->with('sender')
            ->where('id', '>', $lastId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($messages->isEmpty()) {
            return response()->json(['html' => '', 'last_id' => $lastId]);
        }

        // Mark as read
        $item->messages()->where('sender_id', '!=', $user->id)->where('id', '>', $lastId)->update(['is_read' => true]);

        $html = view('chat.partials.messages', compact('messages'))->render();
        $newLastId = $messages->first()->id;

        return response()->json(['html' => $html, 'last_id' => $newLastId]);
    }

    public function store(Request $request, Item $item)
    {
        $user = $request->user();
        if ($user->role !== 'admin' && $user->id !== $item->user_id) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $item->messages()->create([
            'sender_id' => $user->id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan terkirim.');
    }
}
