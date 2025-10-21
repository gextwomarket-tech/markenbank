<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    /**
     * Create a transaction
     */
    public function createTransaction(
        int $bankAccountId,
        string $type,
        float $amount,
        string $description = '',
        array $meta = []
    ): Transaction {
        return Transaction::create([
            'bank_account_id' => $bankAccountId,
            'type' => $type,
            'amount' => $amount,
            'currency' => BankAccount::find($bankAccountId)->currency,
            'status' => 'completed',
            'reference' => generateTransactionRef(),
            'description' => $description,
            'meta' => $meta,
        ]);
    }

    /**
     * Credit an account
     */
    public function creditAccount(int $bankAccountId, float $amount, string $description = ''): Transaction
    {
        return DB::transaction(function () use ($bankAccountId, $amount, $description) {
            $account = BankAccount::findOrFail($bankAccountId);
            
            // Update balance
            $account->increment('balance', $amount);
            
            // Create transaction
            return $this->createTransaction(
                $bankAccountId,
                'credit',
                $amount,
                $description
            );
        });
    }

    /**
     * Debit an account
     */
    public function debitAccount(int $bankAccountId, float $amount, string $description = ''): Transaction
    {
        return DB::transaction(function () use ($bankAccountId, $amount, $description) {
            $account = BankAccount::findOrFail($bankAccountId);
            
            // Check sufficient balance
            if ($account->balance < $amount) {
                throw new \Exception('Solde insuffisant');
            }
            
            // Update balance
            $account->decrement('balance', $amount);
            
            // Create transaction
            return $this->createTransaction(
                $bankAccountId,
                'debit',
                $amount,
                $description
            );
        });
    }

    /**
     * Transfer between accounts
     */
    public function transfer(
        int $fromAccountId,
        int $toAccountId,
        float $amount,
        string $description = ''
    ): array {
        return DB::transaction(function () use ($fromAccountId, $toAccountId, $amount, $description) {
            $fromAccount = BankAccount::findOrFail($fromAccountId);
            $toAccount = BankAccount::findOrFail($toAccountId);
            
            // Check same currency
            if ($fromAccount->currency !== $toAccount->currency) {
                throw new \Exception('Les comptes doivent avoir la même devise');
            }
            
            // Debit from source
            $debitTxn = $this->debitAccount($fromAccountId, $amount, 'Transfert vers ' . $toAccount->account_number);
            
            // Credit to destination
            $creditTxn = $this->creditAccount($toAccountId, $amount, 'Transfert depuis ' . $fromAccount->account_number);
            
            return [
                'debit' => $debitTxn,
                'credit' => $creditTxn,
            ];
        });
    }
}
