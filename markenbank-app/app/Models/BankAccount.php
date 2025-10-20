<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'iban',
        'currency',
        'balance',
        'status',
        'metadata',
    ];

    protected $casts = [
        'balance' => 'decimal:8',
        'metadata' => 'array',
    ];

    /**
     * Get the user that owns the bank account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions for the bank account.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the virtual cards for the bank account.
     */
    public function virtualCards()
    {
        return $this->hasMany(VirtualCard::class);
    }

    /**
     * Check if account is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Add balance to account.
     */
    public function addBalance(float $amount): void
    {
        $this->balance += $amount;
        $this->save();
    }

    /**
     * Deduct balance from account.
     */
    public function deductBalance(float $amount): void
    {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            $this->save();
        }
    }
}
