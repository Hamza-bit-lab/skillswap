<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                
                // Get the intended URL
                $intendedUrl = $request->path();
                
                // Check if admin trying to access user routes
                if ($user && $user->is_admin == 1 && str_starts_with($intendedUrl, 'dashboard')) {
                    Log::info('Admin attempting to access user dashboard - redirecting to admin dashboard');
                    return redirect()->route('admin.dashboard');
                }
                
                // Check if non-admin trying to access admin routes
                if ($user && $user->is_admin == 0 && str_starts_with($intendedUrl, 'admin')) {
                    Log::info('User attempting to access admin area - redirecting to user dashboard');
                    return redirect()->route('user.dashboard');
                }
                
                // If they're logged in but hitting login/register pages
                if (str_contains($intendedUrl, 'login') || str_contains($intendedUrl, 'register')) {
                    Log::info('Authenticated user attempting to access auth pages');
                    if ($user->is_admin == 1) {
                        return redirect()->route('admin.dashboard');
                    } else {
                        return redirect()->route('user.dashboard');
                    }
                }
            }
        }

        return $next($request);
    }
}