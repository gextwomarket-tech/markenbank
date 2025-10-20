<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BankAccount;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $currencies = ['USD', 'EUR', 'GBP', 'CAD', 'XOF'];
        return view('auth.register', compact('currencies'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'currency' => 'required|string|in:USD,EUR,GBP,CAD,XOF',
        ]);

        DB::beginTransaction();
        
        try {
            // Créer l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'user',
                'is_verified' => false,
            ]);

            // Créer le compte bancaire principal
            $account = BankAccount::create([
                'user_id' => $user->id,
                'account_number' => generateAccountNumber($user->id),
                'iban' => generateIban(),
                'currency' => $request->currency,
                'balance' => 0,
                'status' => 'active',
            ]);

            // Log l'action
            AuditLog::logAction(
                'user_registered',
                $user->id,
                User::class,
                $user->id,
                ['email' => $user->email, 'currency' => $request->currency]
            );

            DB::commit();

            event(new Registered($user));

            // Connecter l'utilisateur
            auth()->login($user);

            return redirect()->route('dashboard.index')
                ->with('success', 'Bienvenue chez Marken Bank ! Votre compte a été créé avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la création du compte.'])->withInput();
        }
    }
}
