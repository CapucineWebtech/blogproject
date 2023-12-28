<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('users.show', auth()->user())->with('warning', 'Vous êtes déjà connecté.');
        }

        return view('auth.login');
    }

    public function dologin(AuthFormRequest $request): RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('users.show', auth()->user())->with('warning', 'Vous êtes déjà connecté.');
        }

        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            return redirect()->route('users.show', auth()->user());
        }
        return redirect()->route('auth.login')->with('error', 'Email ou mot de passe incorrecte');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('posts.index')->with('success', 'Déconnexion terminée');
    }
}
