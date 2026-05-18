<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SitePasswordProtection
{
    public function handle(Request $request, Closure $next): Response
    {
        // Admin, auth, and unlock routes bypass this gate
        if ($request->is('admin*') || $request->is('acceso') || $request->is('login') || $request->is('register')) {
            return $next($request);
        }

        if ($request->session()->get('site_unlocked')) {
            return $next($request);
        }

        return response()->view('site-password', [
            'error' => $request->session()->pull('site_password_error'),
        ]);
    }
}
