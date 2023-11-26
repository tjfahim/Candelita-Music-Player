<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

 

    // Handle the login process manually
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect to the appropriate dashboard based on the user's role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // Failed login attempt, redirect back with errors
        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }


    public function register(Request $request)
{
    // Validation rules for the registration form
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required',
    ];

    // Validate the request data
    $request->validate($rules);

    // Create a new user instance
    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = 'admin';

    // Save the user to the database
    $user->save();

    // Log in the newly registered user
    Auth::login($user);

    // Redirect the user to the dashboard after registration
    return redirect()->route('admin.dashboard');
}

public function showLoginForm()
{
    if (request()->is('register')) {
        return view('auth.register');
    }

    return view('auth.login');
}

    // Handle the logout process
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
    
}
