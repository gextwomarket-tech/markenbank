<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'is_active',
        'config',
        'fees_percentage',
        'fees_fixed',
        'min_amount',
        'max_amount',
    ];

    protected $casts = [
        'config' => 'array',
        'is_active' => 'boolean',
        'fees_percentage' => 'decimal:2',
        'fees_fixed' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
    ];

    /**
     * Scope active payment methods
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Calculate fees for an amount
     */
    public function calculateFees(float $amount): float
    {
        $percentageFee = ($amount * $this->fees_percentage) / 100;
        return $percentageFee + $this->fees_fixed;
    }

    /**
     * Get total amount including fees
     */
    public function getTotalWithFees(float $amount): float
    {
        return $amount + $this->calculateFees($amount);
    }
}
