<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('content.authentications.login');
    }
    public function login(LoginRequest $request)
    {
        $validated_data = $request->validated();

        if (Auth::attempt($validated_data, $request->filled('remember_me'))) {
            $request->session()->regenerate();
            $user = $request->user();
            if ($user->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            } else if ($user->role === 'owner') {
                return redirect()->intended('owner/dashboard');
            }
            }
        return redirect()->route('login')
            ->with('login_failed', 'The provided email or password is invalid')
            ->withInput($request->only('email'));
    }
    public function register()
    {

    }
    public function forgot_password()
    {

    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login');
    }

}
