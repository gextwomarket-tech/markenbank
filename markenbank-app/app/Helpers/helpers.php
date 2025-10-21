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

if (!function_exists('__t')) {
    /**
     * Get translation from database or JSON file
     */
    function __t(string $key, string $default = ''): string
    {
        $locale = session('locale', config('app.locale', 'fr'));
        
        // Try to get from database
        $language = \App\Models\Language::where('code', $locale)
            ->where('is_active', true)
            ->first();
        
        if ($language && isset($language->translations[$key])) {
            return $language->translations[$key];
        }
        
        // Fallback to JSON file
        $jsonPath = resource_path("lang/{$locale}.json");
        if (file_exists($jsonPath)) {
            $translations = json_decode(file_get_contents($jsonPath), true);
            if (isset($translations[$key])) {
                return $translations[$key];
            }
        }
        
        return $default ?: $key;
    }
}

if (!function_exists('logActivity')) {
    /**
     * Log an activity in audit logs
     */
    function logActivity(string $action, $auditable = null, array $meta = []): void
    {
        \App\Models\AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'auditable_type' => $auditable ? get_class($auditable) : null,
            'auditable_id' => $auditable ? $auditable->id : null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'meta' => $meta,
        ]);
    }
}

if (!function_exists('logUserVisit')) {
    /**
     * Log user page visit
     */
    function logUserVisit(string $pageUrl, string $pageName): void
    {
        if (!auth()->check()) {
            return;
        }
        
        \App\Models\UserActivityLog::create([
            'user_id' => auth()->id(),
            'page_url' => $pageUrl,
            'page_name' => $pageName,
            'ip_address' => request()->ip(),
            'visited_at' => now(),
        ]);
    }
}

if (!function_exists('getCurrencies')) {
    /**
     * Get available currencies
     */
    function getCurrencies(): array
    {
        return [
            'USD' => ['name' => 'US Dollar', 'symbol' => '$', 'flag' => '🇺🇸'],
            'EUR' => ['name' => 'Euro', 'symbol' => '€', 'flag' => '🇪🇺'],
            'GBP' => ['name' => 'British Pound', 'symbol' => '£', 'flag' => '🇬🇧'],
            'XOF' => ['name' => 'Franc CFA', 'symbol' => 'CFA', 'flag' => '🇸🇳'],
            'XAF' => ['name' => 'Franc CFA Central', 'symbol' => 'FCFA', 'flag' => '🇨🇲'],
            'CAD' => ['name' => 'Canadian Dollar', 'symbol' => 'C$', 'flag' => '🇨🇦'],
            'CHF' => ['name' => 'Swiss Franc', 'symbol' => 'CHF', 'flag' => '🇨🇭'],
            'JPY' => ['name' => 'Japanese Yen', 'symbol' => '¥', 'flag' => '🇯🇵'],
        ];
    }
}

if (!function_exists('getCountries')) {
    /**
     * Get available countries with codes
     */
    function getCountries(): array
    {
        return [
            'FR' => ['name' => 'France', 'flag' => '🇫🇷'],
            'US' => ['name' => 'United States', 'flag' => '🇺🇸'],
            'GB' => ['name' => 'United Kingdom', 'flag' => '🇬🇧'],
            'SN' => ['name' => 'Sénégal', 'flag' => '🇸🇳'],
            'CI' => ['name' => 'Côte d\'Ivoire', 'flag' => '🇨🇮'],
            'CM' => ['name' => 'Cameroun', 'flag' => '🇨🇲'],
            'CA' => ['name' => 'Canada', 'flag' => '🇨🇦'],
            'DE' => ['name' => 'Germany', 'flag' => '🇩🇪'],
            'ES' => ['name' => 'Spain', 'flag' => '🇪🇸'],
            'IT' => ['name' => 'Italy', 'flag' => '🇮🇹'],
        ];
    }
}
