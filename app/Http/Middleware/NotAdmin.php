<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
