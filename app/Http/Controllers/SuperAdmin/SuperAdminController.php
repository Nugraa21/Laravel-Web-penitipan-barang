<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $totalSuperAdmins = User::where('role', 'super_admin')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalUsers = User::where('role', 'user')->count();

        $totalItems = Item::count();
        $pendingItems = Item::where('status', 'pending')->count();
        $storedItems = Item::where('status', 'stored')->count();
        $retrievedItems = Item::where('status', 'retrieved')->count();

        // Estimasi financial (total nilai barang yang valid)
        $totalEstimatedValue = Item::sum('estimated_value');

        // Get 5 most recent items
        $recentItems = Item::with('user')->latest()->take(5)->get();

        return view('superadmin.dashboard', compact(
            'totalSuperAdmins',
            'totalAdmins',
            'totalUsers',
            'totalItems',
            'pendingItems',
            'storedItems',
            'retrievedItems',
            'totalEstimatedValue',
            'recentItems'
        ));
    }
}
