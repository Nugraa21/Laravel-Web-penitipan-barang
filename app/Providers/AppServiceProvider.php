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

            // Dynamically override global Configs
            if (isset($settings['app_name'])) {
                \Illuminate\Support\Facades\Config::set('app.name', $settings['app_name']);
                \Illuminate\Support\Facades\Config::set('adminlte.title', $settings['app_name']);

                // Format AdminLTE logo creatively: Bold the first word
                $words = explode(' ', $settings['app_name']);
                $firstWord = array_shift($words);
                $rest = implode(' ', $words);
                $logoHtml = '<b>' . $firstWord . '</b> ' . $rest;
                \Illuminate\Support\Facades\Config::set('adminlte.logo', $logoHtml);
            }
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
