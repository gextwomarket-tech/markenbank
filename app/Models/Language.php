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
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'translations' => 'array',
    ];

    /**
     * Get the default language.
     */
    public static function getDefault()
    {
        return static::where('is_default', true)->first() ?? static::where('code', 'fr')->first();
    }

    /**
     * Get active languages.
     */
    public static function getActive()
    {
        return static::where('is_active', true)->get();
    }
}
