<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure the User model is imported
use Illuminate\Foundation\Auth\AuthenticatesUsers; // Use the AuthenticatesUsers trait

class LoginController extends Controller
{
    // Use the AuthenticatesUsers trait for built-in authentication methods
    use AuthenticatesUsers;

    // The redirect path after a user logs in successfully
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Only allow guests to access login functions, except for logout
        $this->middleware('guest')->except('logout');
        // Only authenticated users can log out
        $this->middleware('auth')->only('logout');
    }

    /**
     * The action to take after the user is authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Check the user's role and redirect accordingly
        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/user/dashboard');
        }
    }
}
