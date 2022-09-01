<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function processLogin(Request $request)
    {
        $user = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'level' => 1,
        ];

        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
