<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle post-login redirection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        Log::info('LoginController@authenticated: Processing post-login redirect', [
            'user_id' => $user->id,
            'is_admin' => $user->isAdmin(),
        ]);

        if ($user->isAdmin()) {
            Log::info('LoginController: Redirecting admin to admin.dashboard');
            return redirect()->route('admin.dashboard');
        } else {
            Log::info('LoginController: Redirecting non-admin to user.dashboard');
            return redirect()->route('user.dashboard');
        }
    }
}