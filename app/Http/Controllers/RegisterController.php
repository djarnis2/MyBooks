<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create(Request $request) {
        return view('register');
    }

    public function store(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required','string', Rule::unique('users','name')],
            'email' => ['required','email', Rule::unique('users','email')],
            'password' => 'required|string'
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect()->route('index')->with('success', 'Welcome, ' . $user->name . '. You have been registered and logged in!');
    }
}
