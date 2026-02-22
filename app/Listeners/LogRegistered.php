<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\UserLog;

class LogRegistered
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event)
    {
        $userId = $event->user ? $event->user->id : null;
        UserLog::create([
            'user_id' => $userId,
            'action' => 'register',
            'description' => 'User registered',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
?>