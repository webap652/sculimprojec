<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'nisn', 'nama_lengkap', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat',
        'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu',
        'no_hp_ortu', 'sekolah_asal', 'tahun_lulus',
        'foto', 'kk', 'akte', 'ijazah', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
