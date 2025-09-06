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



                // Redirect admins away from user dashboard
                if ($user->isAdmin() && ($intendedUrl === 'dashboard' || str_starts_with($intendedUrl, 'dashboard'))) {
                    return redirect()->route('admin.dashboard');
                }

                // Redirect non-admins away from admin routes
                if (!$user->isAdmin() && str_starts_with($intendedUrl, 'admin')) {
                    return redirect()->route('user.dashboard');
                }

                // Redirect authenticated users away from login/register pages
                if (str_contains($intendedUrl, 'login') || str_contains($intendedUrl, 'register')) {
                    if ($user->isAdmin()) {
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