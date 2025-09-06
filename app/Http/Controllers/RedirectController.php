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
            
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return redirect()->route('welcome');
    }
}