<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\UserLog;

class LogLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $userId = $event->user ? $event->user->id : null;
        UserLog::create([
            'user_id' => $userId,
            'action' => 'login',
            'description' => 'User logged in',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
?>