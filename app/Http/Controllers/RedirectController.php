<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Handle post-login redirect based on user type
     */
    public function afterLogin()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }
        
        return redirect()->route('welcome');
    }
}
