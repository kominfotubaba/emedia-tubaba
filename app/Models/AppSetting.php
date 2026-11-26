<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'boolean',
    ];

    public static function enabled(string $key, bool $default = false): bool
    {
        $setting = static::where('key', $key)->first();

        return $setting ? (bool) $setting->value : $default;
    }
}
