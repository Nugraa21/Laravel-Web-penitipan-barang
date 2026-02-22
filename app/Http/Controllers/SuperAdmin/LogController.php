<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemHistory;
use App\Models\UserLog;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $itemLogs = ItemHistory::with(['item', 'user'])->latest()->paginate(25, ['*'], 'item_page');
        $userLogs = UserLog::with(['user'])->latest()->paginate(25, ['*'], 'user_page');

        return view('superadmin.logs', compact('itemLogs', 'userLogs'));
    }
}
