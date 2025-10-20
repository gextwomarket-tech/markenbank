<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use App\Models\BankAccount;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopupController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $accounts = $user->bankAccounts;
        $topups = $user->topups()->latest()->paginate(15);
        
        // Récupérer les méthodes de paiement activées
        $paymentMethods = Setting::getValue('payment_methods_enabled', ['iban', 'paypal', 'crypto']);
        
        // Récupérer les adresses crypto
        $cryptoAddresses = Setting::getValue('crypto_addresses', []);
        
        // Récupérer les détails IBAN
        $ibanDetails = [
            'account' => Setting::getValue('iban_deposit_account'),
            'bic' => Setting::getValue('iban_bic'),
            'holder' => Setting::getValue('iban_account_holder'),
        ];
        
        return view('dashboard.topup', compact(
            'accounts',
            'topups',
            'paymentMethods',
            'cryptoAddresses',
            'ibanDetails'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'method' => 'required|in:iban,paypal,crypto',
            'amount' => 'required|numeric|min:10|max:100000',
            'crypto_currency' => 'required_if:method,crypto',
            'proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $user = auth()->user();
        
        // Vérifier que le compte appartient à l'utilisateur
        $account = BankAccount::where('id', $request->bank_account_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Gérer l'upload de preuve
        $proofPath = null;
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('topup-proofs', 'public');
        }

        $data = [
            'user_id' => $user->id,
            'bank_account_id' => $account->id,
            'method' => $request->method,
            'amount' => $request->amount,
            'currency' => $account->currency,
            'status' => 'pending',
            'proof_path' => $proofPath,
        ];

        if ($request->method === 'crypto') {
            $data['crypto_currency'] = $request->crypto_currency;
            $cryptoAddresses = Setting::getValue('crypto_addresses', []);
            $data['wallet_address'] = $cryptoAddresses[$request->crypto_currency] ?? null;
        }

        $topup = Topup::create($data);

        \App\Models\AuditLog::logAction(
            'topup_requested',
            $user->id,
            Topup::class,
            $topup->id,
            ['method' => $request->method, 'amount' => $request->amount]
        );

        return back()->with('success', 'Votre demande de recharge a été soumise. Elle sera traitée sous peu.');
    }

    public function show(Topup $topup)
    {
        // Vérifier que l'utilisateur est propriétaire de la recharge
        if ($topup->user_id !== auth()->id()) {
            abort(403);
        }

        return view('dashboard.topup-details', compact('topup'));
    }
}
