<?php

if (!function_exists('generateIban')) {
    function generateIban(string $prefix = 'FR76', int $length = 20): string
    {
        $digits = substr(str_shuffle(str_repeat('0123456789', $length)), 0, $length);
        return $prefix . $digits;
    }
}

if (!function_exists('generateAccountNumber')) {
    function generateAccountNumber(int $userId, string $prefix = 'ACC'): string
    {
        return $prefix . str_pad((string)$userId, 10, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('generateTransactionRef')) {
    function generateTransactionRef(string $prefix = 'TXN'): string
    {
        return strtoupper($prefix . '-' . bin2hex(random_bytes(6)));
    }
}

if (!function_exists('generateSwift')) {
    function generateSwift(): string
    {
        $letters = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ', 8)), 0, 8);
        return $letters;
    }
}

if (!function_exists('generateCardNumber')) {
    function generateCardNumber(): string
    {
        $number = '';
        for ($i = 0; $i < 16; $i++) {
            $number .= rand(0, 9);
        }
        return $number;
    }
}

if (!function_exists('maskCardNumber')) {
    function maskCardNumber(string $cardNumber): string
    {
        return '**** **** **** ' . substr($cardNumber, -4);
    }
}

if (!function_exists('formatCurrency')) {
    function formatCurrency(float $amount, string $currency = 'USD'): string
    {
        $symbols = [
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'XOF' => 'CFA',
            'CAD' => 'C$',
        ];
        
        $symbol = $symbols[$currency] ?? $currency;
        $formatted = number_format($amount, 2, '.', ' ');
        
        return in_array($currency, ['USD', 'GBP', 'CAD']) 
            ? $symbol . $formatted 
            : $formatted . ' ' . $symbol;
    }
}

if (!function_exists('getCurrencySymbol')) {
    function getCurrencySymbol(string $currency): string
    {
        return match($currency) {
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'XOF' => 'CFA',
            'CAD' => 'C$',
            'BTC' => '₿',
            'ETH' => 'Ξ',
            default => $currency
        };
    }
}

if (!function_exists('getTransactionIcon')) {
    function getTransactionIcon(string $type): string
    {
        return match($type) {
            'credit' => 'fa-arrow-down text-success',
            'debit' => 'fa-arrow-up text-danger',
            'transfer' => 'fa-exchange-alt text-info',
            'topup' => 'fa-plus-circle text-success',
            'fee' => 'fa-minus-circle text-warning',
            default => 'fa-circle text-secondary'
        };
    }
}

if (!function_exists('getStatusBadge')) {
    function getStatusBadge(string $status): string
    {
        return match($status) {
            'active' => '<span class="badge bg-success">Actif</span>',
            'pending' => '<span class="badge bg-warning">En attente</span>',
            'approved' => '<span class="badge bg-success">Approuvé</span>',
            'rejected' => '<span class="badge bg-danger">Rejeté</span>',
            'completed' => '<span class="badge bg-success">Complété</span>',
            'failed' => '<span class="badge bg-danger">Échoué</span>',
            'blocked' => '<span class="badge bg-danger">Bloqué</span>',
            'closed' => '<span class="badge bg-secondary">Fermé</span>',
            'frozen' => '<span class="badge bg-info">Gelé</span>',
            'cancelled' => '<span class="badge bg-secondary">Annulé</span>',
            default => '<span class="badge bg-secondary">' . ucfirst($status) . '</span>'
        };
    }
}
