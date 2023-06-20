<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('errorMessage', 'Login failed!');
    }
    public function Register(Request $request)
    {
        $image = [
            'image_post/profdef1.jpg',
            'image_post/profdef2.jpg'
        ];
        $credentials = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $credentials['password'] = Hash::make($credentials['password']);
        $credentials['role'] = 'visitor';
        $credentials['image'] = $image[rand(0,1)];
        $store = User::create($credentials);
        if ($store) {
            $request->session()->regenerate();
            return redirect()->route('books.index');
        }else{
            return redirect()->route('register');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
