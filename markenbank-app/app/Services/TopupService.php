<?php

namespace App\Services;

use App\Models\Topup;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class TopupService
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Create a topup request
     */
    public function createTopup(
        int $userId,
        int $bankAccountId,
        string $method,
        float $amount,
        string $currency,
        array $data = []
    ): Topup {
        return Topup::create([
            'user_id' => $userId,
            'bank_account_id' => $bankAccountId,
            'method' => $method,
            'amount' => $amount,
            'currency' => $currency,
            'crypto_currency' => $data['crypto_currency'] ?? null,
            'wallet_address' => $data['wallet_address'] ?? null,
            'transaction_hash' => $data['transaction_hash'] ?? null,
            'proof_path' => $data['proof_path'] ?? null,
            'status' => 'pending',
        ]);
    }

    /**
     * Approve a topup request
     */
    public function approveTopup(int $topupId, int $adminId, ?string $note = null): Topup
    {
        return DB::transaction(function () use ($topupId, $adminId, $note) {
            $topup = Topup::findOrFail($topupId);
            
            if ($topup->status !== 'pending') {
                throw new \Exception('Cette recharge a déjà été traitée');
            }
            
            // Update topup status
            $topup->update([
                'status' => 'approved',
                'approved_by' => $adminId,
                'approved_at' => now(),
                'admin_note' => $note,
            ]);
            
            // Credit the account
            $this->transactionService->creditAccount(
                $topup->bank_account_id,
                $topup->amount,
                "Recharge {$topup->method} - #{$topup->id}"
            );
            
            // Send notification (implement later)
            // TODO: Send email to user
            
            // Log activity
            logActivity('topup_approved', $topup, [
                'admin_id' => $adminId,
                'amount' => $topup->amount,
                'method' => $topup->method,
            ]);
            
            return $topup->fresh();
        });
    }

    /**
     * Reject a topup request
     */
    public function rejectTopup(int $topupId, int $adminId, string $note): Topup
    {
        $topup = Topup::findOrFail($topupId);
        
        if ($topup->status !== 'pending') {
            throw new \Exception('Cette recharge a déjà été traitée');
        }
        
        // Update topup status
        $topup->update([
            'status' => 'rejected',
            'approved_by' => $adminId,
            'approved_at' => now(),
            'admin_note' => $note,
        ]);
        
        // Send notification (implement later)
        // TODO: Send email to user
        
        // Log activity
        logActivity('topup_rejected', $topup, [
            'admin_id' => $adminId,
            'reason' => $note,
        ]);
        
        return $topup->fresh();
    }
}
