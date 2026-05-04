<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid email or password');
        }

        Auth::login($user);

        $role = strtolower(trim($user->role));

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $role,
        ]);
        
        session()->save();

        if ($role === 'admin' || $user->email === 'admin@foodcart.com') {
            return redirect('/admin/dashboard');
        }

        return redirect()->route('home');
    }

    public function showRegister()
    {
        if (session()->has('user_id')) {
            return redirect()->route('home');
        }
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => 'user',
        ]);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('landing');
    }
}
