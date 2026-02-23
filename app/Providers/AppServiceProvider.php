<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\ChatMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('settings')) {
            $settings = Setting::all()->pluck('value', 'key')->toArray();
            View::share('app_settings', $settings);
        }

        View::composer(['layouts.navigation', 'layouts.app', 'dashboard', 'layouts.adminlte', 'adminlte::page'], function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $count = 0;

                if ($user->role === 'admin' || $user->role === 'super_admin') {
                    // Admins see all unread messages sent TO admins (receiver_id is null or admin id)
                    $count = ChatMessage::where('is_read', false)
                        ->where(function ($q) use ($user) {
                            $q->whereNull('receiver_id')
                                ->orWhere('receiver_id', $user->id);
                        })
                        ->count();
                } else {
                    // Regular users see unread messages explicitly for them
                    $count = ChatMessage::where('receiver_id', $user->id)
                        ->where('is_read', false)
                        ->count();
                }

                $view->with('unread_chats_count', $count);
            }
        });
    }
}
