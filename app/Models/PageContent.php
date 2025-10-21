<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_key',
        'title',
        'slug',
        'description',
        'content',
        'sections',
        'metadata',
        'is_published',
        'order',
    ];

    protected $casts = [
        'sections' => 'array',
        'metadata' => 'array',
        'is_published' => 'boolean',
    ];

    /**
     * Get page by key.
     */
    public static function getByKey($key)
    {
        return static::where('page_key', $key)->where('is_published', true)->first();
    }

    /**
     * Get published pages.
     */
    public static function getPublished()
    {
        return static::where('is_published', true)->orderBy('order')->get();
    }
}
