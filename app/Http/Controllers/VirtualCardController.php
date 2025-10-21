<?php

namespace App\Http\Controllers;

use App\Models\VirtualCard;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VirtualCardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cards = $user->virtualCards()->with('bankAccount')->latest()->get();
        $accounts = $user->bankAccounts()->where('status', 'active')->get();
        
        return view('dashboard.cards', compact('cards', 'accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'card_type' => 'required|in:visa,mastercard',
        ]);

        $user = auth()->user();
        
        // Vérifier que le compte appartient à l'utilisateur
        $account = BankAccount::where('id', $request->bank_account_id)
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->firstOrFail();

        DB::beginTransaction();
        
        try {
            // Générer les détails de la carte
            $cardNumber = generateCardNumber();
            $expiryMonth = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
            $expiryYear = date('y') + rand(3, 5);
            $cvv = str_pad(rand(100, 999), 3, '0', STR_PAD_LEFT);
            
            $card = VirtualCard::create([
                'user_id' => $user->id,
                'bank_account_id' => $account->id,
                'card_number_masked' => maskCardNumber($cardNumber),
                'card_expiry' => $expiryMonth . '/' . $expiryYear,
                'card_cvv_masked' => '***',
                'status' => 'pending',
                'metadata' => [
                    'card_type' => $request->card_type,
                    'full_number' => encrypt($cardNumber),
                    'cvv' => encrypt($cvv),
                ],
            ]);

            \App\Models\AuditLog::logAction(
                'card_requested',
                $user->id,
                VirtualCard::class,
                $card->id,
                ['account' => $account->account_number, 'type' => $request->card_type]
            );

            DB::commit();

            return back()->with('success', 'Votre demande de carte virtuelle a été soumise. Elle sera activée sous peu.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la création de la carte.']);
        }
    }

    public function freeze(VirtualCard $card)
    {
        if ($card->user_id !== auth()->id()) {
            abort(403);
        }

        $card->update(['status' => 'frozen']);
        
        \App\Models\AuditLog::logAction(
            'card_frozen',
            auth()->id(),
            VirtualCard::class,
            $card->id
        );

        return back()->with('success', 'Carte gelée avec succès.');
    }

    public function unfreeze(VirtualCard $card)
    {
        if ($card->user_id !== auth()->id()) {
            abort(403);
        }

        $card->update(['status' => 'active']);
        
        \App\Models\AuditLog::logAction(
            'card_unfrozen',
            auth()->id(),
            VirtualCard::class,
            $card->id
        );

        return back()->with('success', 'Carte dégelée avec succès.');
    }

    public function destroy(VirtualCard $card)
    {
        if ($card->user_id !== auth()->id()) {
            abort(403);
        }

        $card->update(['status' => 'cancelled']);
        
        \App\Models\AuditLog::logAction(
            'card_cancelled',
            auth()->id(),
            VirtualCard::class,
            $card->id
        );

        return back()->with('success', 'Carte annulée avec succès.');
    }
}
