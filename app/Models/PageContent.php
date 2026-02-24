<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'key',
        'label',
        'value',
    ];

    /**
     * Retrieve a value by key with optional fallback.
     */
    public static function get(string $key, string $default = ''): string
    {
        $record = static::where('key', $key)->first();
        return $record?->value ?? $default;
    }
}
