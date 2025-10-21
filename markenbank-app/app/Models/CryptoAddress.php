<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency',
        'address',
        'network',
        'qr_code_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope active addresses
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope by currency
     */
    public function scopeByCurrency($query, string $currency)
    {
        return $query->where('currency', $currency);
    }

    /**
     * Get QR code URL
     */
    public function getQrCodeUrlAttribute()
    {
        if ($this->qr_code_path) {
            return asset('storage/' . $this->qr_code_path);
        }
        // Generate QR code URL dynamically
        return 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($this->address);
    }
}
