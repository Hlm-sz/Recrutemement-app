<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
        
    //     if (Auth::attempt($credentials)) {
    //         return redirect()->intended('dashboard'); // Rediriger vers le tableau de bord utilisateur
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Vérifier si l'utilisateur est un candidat
            if (Auth::user()->usertype == 'candidat') {
                return redirect()->intended('dashboard'); // Rediriger vers le tableau de bord utilisateur
            } else {
                Auth::logout(); // Déconnecter l'utilisateur s'il n'est pas un candidat
                return back()->withErrors([
                    'email' => 'You are not authorized to login as a candidate.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
