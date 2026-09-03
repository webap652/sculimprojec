<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    protected $fillable = [
        'foto', 'nama', 'deskripsi', 'jumlah', 'status',
        'kategori', 'is_active', 'urutan'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'jumlah' => 'integer',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('nama');
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public static function kategoriList(): array
    {
        return [
            'ruang_kelas' => 'Ruang Kelas',
            'perpustakaan' => 'Perpustakaan',
            'laboratorium' => 'Laboratorium',
            'lapangan' => 'Lapangan',
            'toilet' => 'Toilet',
            'uks' => 'UKS',
            'ruang_guru' => 'Ruang Guru',
            'kantor' => 'Kantor',
            'internet' => 'Internet',
            'air_bersih' => 'Air Bersih',
            'listrik' => 'Listrik',
            'ibadah' => 'Tempat Ibadah',
            'lainnya' => 'Lainnya',
        ];
    }
}

