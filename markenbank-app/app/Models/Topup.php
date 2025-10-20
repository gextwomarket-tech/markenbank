<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_account_id',
        'method',
        'amount',
        'currency',
        'crypto_currency',
        'wallet_address',
        'status',
        'admin_note',
        'proof_path',
    ];

    protected $casts = [
        'amount' => 'decimal:8',
    ];

    /**
     * Get the user that owns the topup.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bank account that owns the topup.
     */
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    /**
     * Check if topup is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Approve topup.
     */
    public function approve(string $note = null): void
    {
        $this->status = 'approved';
        $this->admin_note = $note;
        $this->save();
    }

    /**
     * Reject topup.
     */
    public function reject(string $note): void
    {
        $this->status = 'rejected';
        $this->admin_note = $note;
        $this->save();
    }
}
