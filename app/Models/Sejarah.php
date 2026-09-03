<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    protected $table = 'sejarahs';

    protected $fillable = [
        'judul', 'deskripsi', 'tahun', 'galeri', 'is_active', 'urutan'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tahun' => 'integer',
        'galeri' => 'array',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('tahun')->orderBy('urutan');
    }
}

