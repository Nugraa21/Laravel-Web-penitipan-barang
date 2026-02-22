<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\UserLog;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'super_admin') {
            return redirect()->route('superadmin.dashboard');
        }

        $query = Item::query();

        if (in_array($user->role, ['admin', 'super_admin'])) {
            $query->with('user')->latest();
        } else {
            $query->where('user_id', $user->id)->latest();
        }

        // Apply Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('receipt_token', 'like', "%{$search}%");
            });
        }

        // Apply Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Apply Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->reorder()->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->reorder()->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->reorder()->orderBy('name', 'desc');
                break;
            case 'latest':
            default:
                // default is applied at the query init level via latest() but we ensure it here
                $query->reorder()->latest();
                break;
        }

        $items = $query->get();

        return view('dashboard', compact('items'));
    }

    public function create(Request $request)
    {
        if (in_array($request->user()->role, ['admin', 'super_admin'])) {
            abort(403, __('Admin tidak dapat menitipkan barang.'));
        }
        return view('items.create');
    }

    public function store(Request $request)
    {
        if (in_array($request->user()->role, ['admin', 'super_admin'])) {
            abort(403, __('Admin tidak dapat menitipkan barang.'));
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'item_type' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'characteristics' => 'nullable|string',
            'estimated_value' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'photos' => 'required|array|min:1|max:5',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $firstPath = null;
        $allPaths = [];

        foreach ($request->file('photos') as $index => $file) {
            $path = $file->store('photos', 'public');
            if ($index === 0) {
                $firstPath = $path;
            }
            $allPaths[] = $path;
        }

        // Generate a random 10-character alphanumeric token
        $receiptToken = 'PB-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));

        $item = $request->user()->items()->create([
            'name' => $request->name,
            'description' => $request->description,
            'item_type' => $request->item_type,
            'brand' => $request->brand,
            'color' => $request->color,
            'characteristics' => $request->characteristics,
            'estimated_value' => $request->estimated_value,
            'notes' => $request->notes,
            'photo_path' => $firstPath,
            'status' => 'pending',
            'receipt_token' => $receiptToken,
        ]);

        foreach ($allPaths as $path) {
            $item->photos()->create(['photo_path' => $path]);
        }

        UserLog::create([
            'user_id' => $request->user()->id,
            'action' => 'create_item',
            'description' => "Created item {$item->name} (Token: {$receiptToken})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);
        return redirect()->route('dashboard')->with('success', 'Barang berhasil ditambahkan. Nomor Penitipan: ' . $receiptToken);
    }

    public function show(Item $item)
    {
        $this->authorizeAccess($item);
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $this->authorizeAccess($item);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $user = $request->user();

        if (in_array($user->role, ['admin', 'super_admin'])) {
            // Admin and Super Admin can update the status
            if ($request->has('status')) {
                $request->validate([
                    'status' => 'required|in:pending,stored,retrieved',
                ]);

                $oldStatus = $item->status;
                $item->status = $request->status;

                if ($oldStatus !== $request->status) {
                    $item->histories()->create([
                        'user_id' => $user->id,
                        'action' => 'status_changed',
                        'changes' => [
                            'old_status' => $oldStatus,
                            'new_status' => $request->status,
                        ]
                    ]);
                }
            }

            // IF Super Admin, they can also update fields
            if ($user->role === 'super_admin' && $request->has('name')) {
                goto super_admin_fields;
            }

            $item->save();
            UserLog::create([
                'user_id' => $request->user()->id,
                'action' => 'update_item',
                'description' => "Updated item {$item->name}",
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);
            return redirect()->route('dashboard')->with('success', 'Status barang diperbarui.');
        }

        super_admin_fields:
        if ($user->role === 'user' || $user->role === 'super_admin') {
            if ($item->status !== 'pending' && $user->role !== 'super_admin') {
                return back()->withErrors(['message' => 'Hanya barang dengan status pending yang dapat diedit.']);
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'item_type' => 'nullable|string|max:255',
                'brand' => 'nullable|string|max:255',
                'color' => 'nullable|string|max:255',
                'characteristics' => 'nullable|string',
                'estimated_value' => 'nullable|numeric|min:0',
                'notes' => 'nullable|string',
                'photos' => 'nullable|array|max:5',
                'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $oldValues = $item->only(['name', 'description', 'item_type', 'brand', 'color', 'characteristics', 'estimated_value', 'notes', 'photo_path']);

            if ($request->hasFile('photos')) {
                $firstPath = null;
                $allPaths = [];

                foreach ($request->file('photos') as $index => $file) {
                    $path = $file->store('photos', 'public');
                    if ($index === 0) {
                        $firstPath = $path;
                    }
                    $allPaths[] = $path;
                }

                if (!$item->photo_path && count($allPaths) > 0) {
                    $item->photo_path = $firstPath;
                }

                foreach ($allPaths as $path) {
                    $item->photos()->create(['photo_path' => $path]);
                }
            }

            $item->name = $request->name;
            $item->description = $request->description;
            $item->item_type = $request->item_type;
            $item->brand = $request->brand;
            $item->color = $request->color;
            $item->characteristics = $request->characteristics;
            $item->estimated_value = $request->estimated_value;
            $item->notes = $request->notes;

            $changes = [];
            foreach (['name', 'description', 'item_type', 'brand', 'color', 'characteristics', 'estimated_value', 'notes', 'photo_path'] as $field) {
                if ($oldValues[$field] != $item->$field) {
                    $changes[$field] = [
                        'old' => $oldValues[$field],
                        'new' => $item->$field,
                    ];
                }
            }

            $item->save();

            if (!empty($changes)) {
                $item->histories()->create([
                    'user_id' => $user->id,
                    'action' => 'updated_by_user',
                    'changes' => $changes
                ]);
            }

            return redirect()->route('items.show', $item)->with('success', 'Data barang berhasil diperbarui.');
        }
    }

    public function print(Item $item)
    {
        // Pastikan hanya admin atau pemilik barang yang bisa print struk
        if (!in_array(auth()->user()->role, ['admin', 'super_admin']) && auth()->user()->id !== $item->user_id) {
            abort(403);
        }

        return view('items.print', compact('item'));
    }

    public function destroy(Item $item)
    {
        $this->authorizeAccess($item);
        $item->delete();
        UserLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_item',
            'description' => "Deleted item {$item->name}",
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
        return redirect()->route('dashboard')->with('success', 'Barang dihapus.');
    }

    public function destroyPhoto(Item $item, $photoId)
    {
        $this->authorizeAccess($item);
        if ($item->status !== 'pending') {
            return back()->withErrors(['message' => 'Tidak dapat menghapus foto karena barang sudah diproses.']);
        }

        $photo = $item->photos()->findOrFail($photoId);

        if ($item->photos()->count() <= 1) {
            return back()->withErrors(['message' => 'Minimal harus ada 1 foto barang.']);
        }

        if ($item->photo_path === $photo->photo_path) {
            $otherPhoto = $item->photos()->where('id', '!=', $photoId)->first();
            if ($otherPhoto) {
                $item->update(['photo_path' => $otherPhoto->photo_path]);
            } else {
                $item->update(['photo_path' => null]);
            }
        }

        $photo->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function markAsStored(Request $request, Item $item)
    {
        $user = $request->user();
        if (!in_array($user->role, ['admin', 'super_admin'])) {
            abort(403);
        }

        if ($item->status === 'pending') {
            $item->update(['status' => 'stored']);

            $item->histories()->create([
                'user_id' => $user->id,
                'action' => 'status_changed',
                'changes' => [
                    'old_status' => 'pending',
                    'new_status' => 'stored',
                ]
            ]);

            return back()->with('success', 'Barang berhasil diterima (Status: Disimpan).');
        }

        return back()->with('error', 'Status barang tidak dapat diubah (bukan pending).');
    }

    private function authorizeAccess(Item $item)
    {
        if (!in_array(request()->user()->role, ['admin', 'super_admin']) && request()->user()->id !== $item->user_id) {
            abort(403);
        }
    }
}
