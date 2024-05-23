<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login.index');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            return back()->with([
                'notifications' => 'email atau password anda salah',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
