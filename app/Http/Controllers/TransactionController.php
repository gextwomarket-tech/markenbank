<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $accounts = $user->bankAccounts;
        
        $query = Transaction::whereIn('bank_account_id', $accounts->pluck('id'))
            ->with('bankAccount');
        
        // Filtres
        if ($request->filled('account_id')) {
            $query->where('bank_account_id', $request->account_id);
        }
        
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $transactions = $query->latest()->paginate(20);
        
        return view('dashboard.transactions', compact('transactions', 'accounts'));
    }

    public function show(Transaction $transaction)
    {
        $user = auth()->user();
        
        // Vérifier que la transaction appartient à un compte de l'utilisateur
        if ($transaction->bankAccount->user_id !== $user->id) {
            abort(403);
        }
        
        return view('dashboard.transaction-details', compact('transaction'));
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'from_account_id' => 'required|exists:bank_accounts,id',
            'to_account_number' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();
        
        // Vérifier que le compte source appartient à l'utilisateur
        $fromAccount = BankAccount::where('id', $request->from_account_id)
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->firstOrFail();
        
        // Trouver le compte destinataire
        $toAccount = BankAccount::where('account_number', $request->to_account_number)
            ->where('status', 'active')
            ->first();
        
        if (!$toAccount) {
            return back()->withErrors(['to_account_number' => 'Compte destinataire introuvable.']);
        }
        
        if ($fromAccount->id === $toAccount->id) {
            return back()->withErrors(['to_account_number' => 'Impossible de transférer vers le même compte.']);
        }
        
        // Vérifier le solde
        if ($fromAccount->balance < $request->amount) {
            return back()->withErrors(['amount' => 'Solde insuffisant.']);
        }

        DB::beginTransaction();
        
        try {
            $reference = generateTransactionRef();
            
            // Débit du compte source
            $fromAccount->deductBalance($request->amount);
            
            Transaction::create([
                'bank_account_id' => $fromAccount->id,
                'type' => 'debit',
                'amount' => $request->amount,
                'currency' => $fromAccount->currency,
                'status' => 'completed',
                'reference' => $reference,
                'meta' => [
                    'description' => $request->description ?? 'Transfert',
                    'to_account' => $toAccount->account_number,
                    'to_user' => $toAccount->user->name,
                ],
            ]);
            
            // Crédit du compte destinataire
            $toAccount->addBalance($request->amount);
            
            Transaction::create([
                'bank_account_id' => $toAccount->id,
                'type' => 'credit',
                'amount' => $request->amount,
                'currency' => $toAccount->currency,
                'status' => 'completed',
                'reference' => $reference,
                'meta' => [
                    'description' => $request->description ?? 'Transfert reçu',
                    'from_account' => $fromAccount->account_number,
                    'from_user' => $fromAccount->user->name,
                ],
            ]);
            
            \App\Models\AuditLog::logAction(
                'transfer_completed',
                $user->id,
                Transaction::class,
                null,
                [
                    'from' => $fromAccount->account_number,
                    'to' => $toAccount->account_number,
                    'amount' => $request->amount,
                    'reference' => $reference,
                ]
            );
            
            DB::commit();
            
            return back()->with('success', 'Transfert effectué avec succès ! Référence : ' . $reference);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Une erreur est survenue lors du transfert.']);
        }
    }

    public function exportCsv(Request $request)
    {
        $user = auth()->user();
        $accounts = $user->bankAccounts;
        
        $transactions = Transaction::whereIn('bank_account_id', $accounts->pluck('id'))
            ->with('bankAccount')
            ->latest()
            ->get();
        
        $csv = "Date,Type,Montant,Devise,Statut,Référence,Compte\n";
        
        foreach ($transactions as $transaction) {
            $csv .= sprintf(
                "%s,%s,%s,%s,%s,%s,%s\n",
                $transaction->created_at->format('Y-m-d H:i:s'),
                $transaction->type,
                $transaction->amount,
                $transaction->currency,
                $transaction->status,
                $transaction->reference,
                $transaction->bankAccount->account_number
            );
        }
        
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="transactions_' . now()->format('Y-m-d') . '.csv"',
        ]);
    }
}
