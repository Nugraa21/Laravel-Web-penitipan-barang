<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class ForceHttpsForNgrok
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah request datang dari domain ngrok (atau subdomain ngrok-free.app)
        if (str_ends_with($request->getHost(), 'ngrok-free.app') ||
            str_ends_with($request->getHost(), 'ngrok.io')) {
            
            // Force Laravel generate semua URL pakai https
            URL::forceScheme('https');
        }

        return $next($request);
    }
}