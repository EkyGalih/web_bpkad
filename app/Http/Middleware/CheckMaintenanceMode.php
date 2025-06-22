<?php

namespace App\Http\Middleware;

use App\Settings\WebsiteSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->is('login') ||
            $request->is('maintenance')
        ) {
            return $next($request);
        }

        // Ambil setting dari DB
        $settings = app(WebsiteSettings::class);

        // Jika mode maintenance AKTIF
        if ($settings->maintenance_mode) {
            // Jika user sedang login dan merupakan admin, izinkan
            if (Auth::check() && Auth::user()->role === 'admin') {
                return $next($request);
            }

            // Selain itu, redirect ke halaman maintenance
            return redirect()->route('maintenance.page');
        }

        return $next($request);
    }
}
