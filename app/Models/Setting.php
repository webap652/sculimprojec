<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public static function ppdbAcademicYear(): string
    {
        return (string) static::get('ppdb_academic_year', '2026/2027');
    }

    public static function ppdbCloseMessage(): string
    {
        return (string) static::get(
            'ppdb_close_message',
            'Pendaftaran PPDB/SPMB Tahun Ajaran ' . static::ppdbAcademicYear() . ' saat ini telah ditutup. Mohon menunggu informasi pendaftaran peserta didik baru berikutnya. Terima kasih atas perhatian dan pengertiannya.'
        );
    }

    public static function ppdbIsOpen(): bool
    {
        if (!filter_var(static::get('ppdb_open', true), FILTER_VALIDATE_BOOLEAN)) {
            return false;
        }

        $now = now();
        $startDate = static::get('ppdb_start_date');
        $endDate = static::get('ppdb_end_date');

        if ($startDate && $now->lt(Carbon::parse($startDate)->startOfDay())) {
            return false;
        }

        if ($endDate && $now->gt(Carbon::parse($endDate)->endOfDay())) {
            return false;
        }

        return true;
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

