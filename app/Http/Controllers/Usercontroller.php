<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login');  // Assuming 'login.blade.php' is your login page
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if user exists
        $user = User::where('email', $request->email)->where('name', $request->name)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in
            Auth::login($user);

            // Redirect to home page
            return redirect()->route('home');
        } else {
            // Redirect to signup page if user not found
            return redirect()->route('signup.form');
        }
    }

    // Show sign-up form
    public function showSignupForm()
    {
        return view('signup');  // Assuming 'signup.blade.php' is your signup page
    }

    // Handle sign-up
    public function signup(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',  // Validate password
        ]);

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash the password
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to home page
        return redirect()->route('home');
    }

    // Show the homepage
    public function home()
    {
        return view('Home');  // Assuming 'home.blade.php' is your homepage
    }
}
