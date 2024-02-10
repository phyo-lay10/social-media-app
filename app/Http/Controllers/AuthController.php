<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $data = $this->validateRequest($request);
        User::create($data);

        return redirect()->route("loginForm")->with("success", "You have successfully registered!");
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with("error", "Email & password do not match our records!");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("loginForm");
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    }

}
