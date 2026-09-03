<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    public static function get(string $key, $default = null): mixed
    {
        $setting = static::query()->where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        $value = $setting->value;

        // value bisa berupa array/boolean/number jika type disimpan berbeda.
        // Untuk keamanan, jika bukan array, kembalikan apa adanya.
        return is_array($value) ? ($value['value'] ?? $default) : $value;
    }

    public static function set(string $key, mixed $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => ['value' => $value]]
        );
    }

    /**
     * Get asset URL from settings, supports both public/ and storage/ paths
     */
    public static function getAssetUrl(string $key, $default = null): string
    {
        $path = static::get($key, $default);

        if (empty($path)) {
            return asset($default ?? '');
        }

        // If path starts with 'images/' or 'storage/' already, return as is
        if (str_starts_with($path, 'images/') || str_starts_with($path, 'admin-assets/')) {
            return asset($path);
        }

        // If path starts with 'storage/', it's already full URL
        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        // Default: asset with storage prefix for uploaded files
        return asset('storage/' . $path);
    }
}

