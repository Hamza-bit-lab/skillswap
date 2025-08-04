<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RedirectController extends Controller
{
    /**
     * Handle post-login redirect based on user type.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function afterLogin()
    {
        if (auth()->check()) {
            $user = auth()->user();
            Log::info('RedirectController: Processing redirect', [
                'user_id' => $user->id,
                'is_admin' => $user->isAdmin()
            ]);

            if ($user->isAdmin()) {
                Log::info('RedirectController: Redirecting admin to admin.dashboard');
                return redirect()->route('admin.dashboard');
            } else {
                Log::info('RedirectController: Redirecting non-admin to user.dashboard');
                return redirect()->route('user.dashboard');
            }
        }

        Log::info('RedirectController: No authenticated user, redirecting to welcome');
        return redirect()->route('welcome');
    }
}