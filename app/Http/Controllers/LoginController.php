<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function loginform(Request $request) {
        \Log::info('Session Message: ' . session('message'));
        return view('login');
    }
    public function authenticate(Request $request) {
        $incomingFields = $request->validate([
            'loginname' => 'required|string',
            'loginpassword' => 'required|string'
        ]);
        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login Successful');
        }

        return back()->withErrors(['login' => 'Wrong username or password.'])->withInput($request->except('loginpassword'));
    }

    public function logout(Request $request) {
        auth()->logout();
        return redirect()->route('index');
    }
}
