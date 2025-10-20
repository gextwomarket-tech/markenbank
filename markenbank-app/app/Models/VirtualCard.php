<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_account_id',
        'card_number_masked',
        'card_expiry',
        'card_cvv_masked',
        'status',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Get the user that owns the virtual card.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bank account that owns the virtual card.
     */
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    /**
     * Generate a masked card number.
     */
    public static function generateMaskedNumber(): string
    {
        return '**** **** **** ' . rand(1000, 9999);
    }

    /**
     * Check if card is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
