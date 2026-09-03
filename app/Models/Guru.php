<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';

    protected $fillable = [
        'foto', 'nama_lengkap', 'nip', 'mapel', 'pendidikan',
        'status', 'no_hp', 'email', 'jabatan', 'urutan', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('nama_lengkap');
    }
}

