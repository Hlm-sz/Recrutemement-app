<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->usertype == 'admin'  ) {
            return redirect()->intended('admin/dashboard'); // Rediriger vers le tableau de bord admin
        }
        elseif(Auth::attempt($credentials) &&  Auth::user()->usertype == 'validateur' ) {
            return redirect()->intended('validateur/dashboard'); // Rediriger vers le tableau de bord admin
        }
        elseif(Auth::attempt($credentials) &&  Auth::user()->usertype == 'lanceurconcour' ) {
            return redirect()->intended('lanceurconcour/dashboard'); // Rediriger vers le tableau de bord admin
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you are not an admin.',
        ]);
    }
}
