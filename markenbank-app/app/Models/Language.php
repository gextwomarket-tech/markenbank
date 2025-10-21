<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'flag',
        'is_active',
        'is_default',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    /**
     * Scope active languages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope default language
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Get translation by key
     */
    public function getTranslation(string $key, string $default = '')
    {
        return $this->translations[$key] ?? $default;
    }

    /**
     * Set translation for a key
     */
    public function setTranslation(string $key, string $value)
    {
        $translations = $this->translations ?? [];
        $translations[$key] = $value;
        $this->translations = $translations;
        $this->save();
    }
}
