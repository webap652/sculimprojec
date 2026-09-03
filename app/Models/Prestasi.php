<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';

    protected $fillable = [
        'foto', 'nama_prestasi', 'tahun', 'tingkat',
        'juara', 'deskripsi', 'kategori', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tahun' => 'integer',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function scopeByTingkat($query, $tingkat)
    {
        return $query->where('tingkat', $tingkat);
    }

    public static function tingkatList(): array
    {
        return [
            'distrik' => 'Distrik',
            'kabupaten' => 'Kabupaten',
            'provinsi' => 'Provinsi',
            'nasional' => 'Nasional',
            'internasional' => 'Internasional',
        ];
    }

    public static function kategoriList(): array
    {
        return [
            'akademik' => 'Akademik',
            'non_akademik' => 'Non Akademik',
            'guru' => 'Guru',
            'sekolah' => 'Sekolah',
        ];
    }
}

