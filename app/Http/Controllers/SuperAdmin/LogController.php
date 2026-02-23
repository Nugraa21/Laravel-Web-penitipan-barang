<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemHistory;
use App\Models\UserLog;

class LogController extends Controller
{
    public function itemLogs(Request $request)
    {
        $query = ItemHistory::with(['item', 'user'])->latest();

        if ($search = $request->input('search')) {
            $query->whereHas('item', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('receipt_token', 'like', "%{$search}%");
            })->orWhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('action', 'like', "%{$search}%");
        }

        $itemLogs = $query->paginate(25);
        $itemLogs->appends(['search' => $search]);

        return view('superadmin.logs.items', compact('itemLogs'));
    }

    public function userLogs(Request $request)
    {
        $query = UserLog::with(['user'])->latest();

        if ($search = $request->input('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            })->orWhere('action', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $userLogs = $query->paginate(25);
        $userLogs->appends(['search' => $search]); // Keep search persistent in pagination

        // Also apply appends to itemLogs

        return view('superadmin.logs.users', compact('userLogs'));
    }
}
