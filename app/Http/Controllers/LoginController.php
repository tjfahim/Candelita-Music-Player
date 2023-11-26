<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('music.list');
            }
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->back()->withInput()->withErrors(['password' => 'Incorrect password']);
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid email']);
            }

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
    return redirect()->route('music.list');
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
