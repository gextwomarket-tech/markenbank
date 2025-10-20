<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Comptes de démonstration
        $demoAccounts = [
            [
                'name' => 'Administrateur',
                'email' => 'admin@markenbank.com',
                'password' => 'password123',
                'role' => 'admin',
                'icon' => 'fa-user-shield',
                'color' => 'primary'
            ],
            [
                'name' => 'Jean Dupont',
                'email' => 'user1@example.com',
                'password' => 'password123',
                'role' => 'user',
                'balance' => '1,000 USD',
                'icon' => 'fa-user',
                'color' => 'success'
            ],
            [
                'name' => 'Marie Martin',
                'email' => 'user2@example.com',
                'password' => 'password123',
                'role' => 'user',
                'balance' => '250,000 XOF',
                'icon' => 'fa-user',
                'color' => 'info'
            ],
        ];
        
        return view('auth.login', compact('demoAccounts'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Rate limiting
        $key = Str::lower($request->email) . '|' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ]);
        }

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            // Redirect based on role
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/admin');
            }

            return redirect()->intended(route('dashboard.index'));
        }

        RateLimiter::hit($key, 60);

        throw ValidationException::withMessages([
            'email' => 'Les informations d\'identification fournies sont incorrectes.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
