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
            return redirect('dashboard')->with('success', 'Success Login');
        } else {
            return back()->withErrors(['email' => 'Please check your credentials'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('login');
    }
}
