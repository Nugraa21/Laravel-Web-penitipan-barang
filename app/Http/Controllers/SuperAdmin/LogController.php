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
        $itemLogs = ItemHistory::with(['item', 'user'])->latest()->paginate(25);
        return view('superadmin.logs.items', compact('itemLogs'));
    }

    public function userLogs(Request $request)
    {
        $userLogs = UserLog::with(['user'])->latest()->paginate(25);
        return view('superadmin.logs.users', compact('userLogs'));
    }
}
