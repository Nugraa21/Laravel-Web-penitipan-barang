<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\UserLog;

class LogLogout
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event)
    {
        $userId = $event->user ? $event->user->id : null;
        UserLog::create([
            'user_id' => $userId,
            'action' => 'logout',
            'description' => 'User logged out',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
?>