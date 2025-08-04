<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                $intendedUrl = $request->path();

                // Log user details for debugging
                Log::info('RedirectIfAuthenticated: Processing authenticated user', [
                    'user_id' => $user->id,
                    'is_admin' => $user->isAdmin(),
                    'intended_url' => $intendedUrl
                ]);

                // Redirect admins away from user dashboard
                if ($user->isAdmin() && ($intendedUrl === 'dashboard' || str_starts_with($intendedUrl, 'dashboard'))) {
                    Log::info('Admin attempting to access user dashboard - redirecting to admin dashboard');
                    return redirect()->route('admin.dashboard');
                }

                // Redirect non-admins away from admin routes
                if (!$user->isAdmin() && str_starts_with($intendedUrl, 'admin')) {
                    Log::info('Non-admin attempting to access admin area - redirecting to user dashboard');
                    return redirect()->route('user.dashboard');
                }

                // Redirect authenticated users away from login/register pages
                if (str_contains($intendedUrl, 'login') || str_contains($intendedUrl, 'register')) {
                    Log::info('Authenticated user attempting to access auth pages');
                    if ($user->isAdmin()) {
                        Log::info('Redirecting admin to admin.dashboard');
                        return redirect()->route('admin.dashboard');
                    } else {
                        Log::info('Redirecting non-admin to user.dashboard');
                        return redirect()->route('user.dashboard');
                    }
                }
            }
        }

        return $next($request);
    }
}