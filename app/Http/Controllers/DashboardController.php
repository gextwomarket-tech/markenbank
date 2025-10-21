<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\Topup;
use App\Models\VirtualCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Récupérer tous les comptes de l'utilisateur
        $accounts = $user->bankAccounts()->with('transactions')->get();
        
        // Calculer le solde total (converti en USD pour l'affichage)
        $totalBalance = $accounts->sum('balance');
        
        // Récupérer les transactions récentes
        $recentTransactions = Transaction::whereIn('bank_account_id', $accounts->pluck('id'))
            ->latest()
            ->take(10)
            ->with('bankAccount')
            ->get();
        
        // Récupérer les recharges en attente
        $pendingTopups = $user->topups()->where('status', 'pending')->count();
        
        // Récupérer les cartes actives
        $activeCards = $user->virtualCards()->where('status', 'active')->count();
        
        // Statistiques pour les graphiques
        $monthlyTransactions = Transaction::whereIn('bank_account_id', $accounts->pluck('id'))
            ->whereMonth('created_at', now()->month)
            ->selectRaw('DATE(created_at) as date, SUM(CASE WHEN type = "credit" THEN amount ELSE 0 END) as credit, SUM(CASE WHEN type = "debit" THEN amount ELSE 0 END) as debit')
            ->groupBy('date')
            ->get();
        
        return view('dashboard.index', compact(
            'accounts',
            'totalBalance',
            'recentTransactions',
            'pendingTopups',
            'activeCards',
            'monthlyTransactions'
        ));
    }

    public function accounts()
    {
        $user = auth()->user();
        $accounts = $user->bankAccounts()->with('transactions', 'virtualCards')->get();
        $supportedCurrencies = ['USD', 'EUR', 'GBP', 'CAD', 'XOF'];
        
        return view('dashboard.accounts', compact('accounts', 'supportedCurrencies'));
    }

    public function createAccount(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|in:USD,EUR,GBP,CAD,XOF',
        ]);

        $user = auth()->user();
        
        // Vérifier si l'utilisateur a déjà un compte dans cette devise
        $existingAccount = $user->bankAccounts()->where('currency', $request->currency)->first();
        
        if ($existingAccount) {
            return back()->withErrors(['currency' => 'Vous avez déjà un compte dans cette devise.']);
        }

        DB::beginTransaction();
        
        try {
            $account = BankAccount::create([
                'user_id' => $user->id,
                'account_number' => generateAccountNumber($user->id + 100),
                'iban' => generateIban(),
                'currency' => $request->currency,
                'balance' => 0,
                'status' => 'active',
            ]);

            \App\Models\AuditLog::logAction(
                'account_created',
                $user->id,
                BankAccount::class,
                $account->id,
                ['currency' => $request->currency]
            );

            DB::commit();

            return back()->with('success', 'Nouveau compte créé avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la création du compte.']);
        }
    }

    public function showAccount(BankAccount $account)
    {
        // Vérifier que l'utilisateur est propriétaire du compte
        if ($account->user_id !== auth()->id()) {
            abort(403);
        }

        $transactions = $account->transactions()
            ->latest()
            ->paginate(20);
        
        return view('dashboard.account-details', compact('account', 'transactions'));
    }
}
