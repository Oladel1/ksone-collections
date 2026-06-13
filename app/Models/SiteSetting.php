<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type', 'label', 'sort_order'];

    /**
     * Get a setting value by key, with optional default.
     */
    public static function get(string $key, $default = null): ?string
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, ?string $value): void
    {
        static::where('key', $key)->update(['value' => $value]);
        Cache::forget('site_settings');
    }

    /**
     * Get all settings as key-value array.
     */
    public static function allCached(): array
    {
        return Cache::remember('site_settings', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get settings grouped.
     */
    public static function allGrouped()
    {
        return static::orderBy('sort_order')->get()->groupBy('group');
    }
}
