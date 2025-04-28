<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credential = $request->only('email', 'password');
        // Auth : class
        if (Auth::attempt($credential)) {
            if (auth()->user()->role_id == 3) {
                return redirect('kasir')->with('success', 'Success Login');
            } elseif (auth()->user()->role_id == 2) {
                return redirect('pimpinan')->with('success', 'Success Login');
            } elseif (auth()->user()->role_id == 1) {
                return redirect('dashboard')->with('success', 'Success Login');
            }
        } else {
            return back()->withErrors(['email' => 'Please check your credentials'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');
    }
}
