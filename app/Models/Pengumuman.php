<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumans';

    protected $fillable = [
        'judul',
        'isi',
        'jenis',
        'aktif',
        'tanggal_publish',
        'gambar',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'tanggal_publish' => 'datetime',
    ];

    // Scope untuk pengumuman aktif
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    // Scope untuk pengumuman terbaru
    public function scopeTerbaru($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
