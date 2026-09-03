<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftars';

    protected $fillable = [
        'user_id',
        'nomor_pendaftaran',
        'nama_lengkap',
        'nik',
        'nisn',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'no_hp_siswa',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'anak_ke',
        'jumlah_saudara',
        'nama_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'no_hp_ayah',
        'nama_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'no_hp_ibu',
        'penghasilan_orangtua',
        'nama_sekolah',
        'npsn',
        'alamat_sekolah',
        'foto_profil',
        'foto',
        'kk',
        'akte',
        'ijazah',
        'kartu_nisn',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Generate nomor pendaftaran otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pendaftar) {
            if (!$pendaftar->nomor_pendaftaran) {
                $pendaftar->nomor_pendaftaran = 'PPDB-' . date('Y') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Scope untuk status
    public function scopeMenunggu($query)
    {
        return $query->where('status', 'Menunggu');
    }

    public function scopeDiterima($query)
    {
        return $query->where('status', 'Diterima');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'Ditolak');
    }
}
