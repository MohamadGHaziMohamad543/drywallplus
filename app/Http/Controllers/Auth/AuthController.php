<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{
    public function showLoginForm($lang)
    {
        return view('website.auth.index');
    }

    public function login($lang,Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'.App::getLocale().'/dashboard');
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->withInput();
    }
}
