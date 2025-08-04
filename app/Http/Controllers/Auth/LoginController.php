<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Remove the fixed redirectTo property since we handle it in authenticated method
    // protected $redirectTo = '/redirect';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override authenticated method for role-based redirect
    protected function authenticated(Request $request, $user)
    {
        Log::info('LoginController@authenticated called', [
            'user_id' => $user->id,
            'is_admin' => $user->is_admin,
        ]);

        // Role-based redirect after successful login
        if ($user->is_admin) {
            Log::info('LoginController: Redirecting admin to admin.dashboard');
            return redirect()->route('admin.dashboard');
        } else {
            Log::info('LoginController: Redirecting normal user to user.dashboard');
            return redirect()->route('user.dashboard');
        }
    }
}