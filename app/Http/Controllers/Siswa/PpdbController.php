<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ppdb;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class PpdbController extends Controller
{
    // ============================
    // 1. Halaman Formulir PPDB
    // ============================
    public function index()
    {
        $data = Ppdb::where('user_id', Auth::id())->first();

        return view('siswa.ppdb.form', compact('data'));
    }

    // ============================
    // 2. Simpan Data PPDB
    // ============================
    public function store(Request $r)
    {
        $r->validate([
            'nama' => 'required',
            'nisn' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',

            // Orang tua
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',

            // Sekolah asal
            'sekolah_asal' => 'required',

            // Berkas
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'kk' => 'nullable|mimes:pdf,jpg,png|max:4096',
        ]);

        // Upload foto
        $foto = null;
        if ($r->foto) {
            $foto = $r->foto->store('foto-siswa', 'public');
        }

        // Upload KK
        $kk = null;
        if ($r->kk) {
            $kk = $r->kk->store('kk-siswa', 'public');
        }

        Ppdb::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'nama' => $r->nama,
                'nisn' => $r->nisn,
                'jenis_kelamin' => $r->jenis_kelamin,
                'tempat_lahir' => $r->tempat_lahir,
                'tanggal_lahir' => $r->tanggal_lahir,
                'alamat' => $r->alamat,

                // Orang tua
                'nama_ayah' => $r->nama_ayah,
                'nama_ibu' => $r->nama_ibu,
                'pekerjaan_ayah' => $r->pekerjaan_ayah,
                'pekerjaan_ibu' => $r->pekerjaan_ibu,

                // Sekolah asal
                'sekolah_asal' => $r->sekolah_asal,
                'alamat_sekolah_asal' => $r->alamat_sekolah_asal,

                // Upload
                'foto' => $foto,
                'kk' => $kk,

                // Status
                'status' => 'Menunggu Verifikasi'
            ]
        );

        return back()->with('success', 'Data berhasil disimpan!');
    }

    // ============================
    // 3. Halaman Status PPDB
    // ============================
    public function status()
    {
        $data = Ppdb::where('user_id', Auth::id())->first();
        return view('siswa.ppdb.status', compact('data'));
    }

    // ============================
    // 4. Cetak Bukti Pendaftaran
    // ============================
    public function cetak()
    {
        $data = Ppdb::where('user_id', Auth::id())->first();
        $pdf = PDF::loadView('siswa.ppdb.cetak', compact('data'));

        return $pdf->download('Bukti-Pendaftaran.pdf');
    }
}
