<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalItems = Item::count();
        $pendingItems = Item::where('status', 'pending')->count();
        $storedItems = Item::where('status', 'stored')->count();
        $retrievedItems = Item::where('status', 'retrieved')->count();
        $totalUsers = User::count();

        // Get 5 most recent items
        $recentItems = Item::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalItems',
            'pendingItems',
            'storedItems',
            'retrievedItems',
            'totalUsers',
            'recentItems'
        ));
    }

    public function users()
    {
        $users = User::withCount('items')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:1000',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->role === 'admin' && auth()->user()->role !== 'super_admin') {
            abort(403, 'Hanya Super Admin yang dapat membuat akses Admin.');
        }

        $path = $request->hasFile('avatar') ? $request->file('avatar')->store('avatars', 'public') : null;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'avatar' => $path,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_user',
            'description' => "Created a new user account: {$request->email} with role {$request->role}.",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function showUser(User $user)
    {
        $user->load([
            'items' => function ($query) {
                $query->latest();
            },
            'items.histories.user',
            'items.photos'
        ]);

        // Aggregate activity log related to this user's items
        $activities = \App\Models\ItemHistory::whereHas('item', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['item', 'user'])->latest()->get();

        return view('admin.users.show', compact('user', 'activities'));
    }

    public function editUser(User $user)
    {
        if (in_array($user->role, ['admin', 'super_admin']) && auth()->user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengedit administrator lain.');
        }
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:1000',
            'role' => 'required|in:admin,user',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if (in_array($user->role, ['admin', 'super_admin']) && auth()->user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengedit administrator lain.');
        }

        if ($request->role === 'admin' && auth()->user()->role !== 'super_admin') {
            abort(403, 'Hanya Super Admin yang dapat menaikkan role menjadi Admin.');
        }

        $data = $request->only(['name', 'email', 'phone', 'address', 'role']);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        UserLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_user',
            'description' => "Updated user account: {$user->email}.",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroyUser(User $user)
    {
        if (in_array($user->role, ['admin', 'super_admin']) && auth()->user()->role !== 'super_admin') {
            return back()->with('error', 'Akses ditolak. Anda tidak memiliki izin menghapus administrator lain.');
        }

        if ($user->role === 'super_admin' && User::where('role', 'super_admin')->count() === 1) {
            return back()->with('error', 'Tidak dapat menghapus Super Admin terakhir.');
        }

        if ($user->avatar) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
        }

        UserLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_user',
            'description' => "Deleted user account: {$user->email}.",
            'ip_address' => request()->ip(),
        ]);

        $user->delete();
        return back()->with('success', 'User ' . $user->name . ' berhasil dihapus.');
    }

    public function scan(Request $request)
    {
        $item = null;
        if ($request->has('token')) {
            $item = Item::with('user', 'photos')->where('receipt_token', $request->token)->first();
            if (!$item) {
                return back()->with('error', 'Barang dengan token tersebut tidak ditemukan.');
            }
        }
        return view('admin.scan', compact('item'));
    }

    public function processScan(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        $item = Item::with('user', 'photos')->where('receipt_token', $request->token)->first();

        if ($item) {
            return redirect()->route('admin.scan', ['token' => $item->receipt_token])->with('success', 'Barang ditemukan!');
        }

        return back()->with('error', 'Token tidak valid atau barang tidak ditemukan.');
    }
}
