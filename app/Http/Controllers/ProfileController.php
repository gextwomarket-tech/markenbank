<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('dashboard.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($request->only('name', 'email', 'phone'));
        
        \App\Models\AuditLog::logAction(
            'profile_updated',
            $user->id,
            \App\Models\User::class,
            $user->id
        );

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function updateAvatar(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Supprimer l'ancien avatar
        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        // Sauvegarder le nouvel avatar
        $path = $request->file('avatar')->store('avatars', 'public');
        
        $user->update(['avatar_path' => $path]);
        
        \App\Models\AuditLog::logAction(
            'avatar_updated',
            $user->id,
            \App\Models\User::class,
            $user->id
        );

        return back()->with('success', 'Avatar mis à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Vérifier le mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);
        
        \App\Models\AuditLog::logAction(
            'password_changed',
            $user->id,
            \App\Models\User::class,
            $user->id
        );

        return back()->with('success', 'Mot de passe modifié avec succès.');
    }
}
