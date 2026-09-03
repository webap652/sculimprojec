<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftar;

class PPDBSiswaController extends Controller
{
    // Tampilkan Formulir
    public function create()
    {
        return view('siswa.ppdb.create');
    }

    // Simpan Data Pendaftaran
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'sekolah_asal' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png',
            'kk' => 'required|mimes:jpg,jpeg,png,pdf',
        ]);

        // Upload Foto
        $foto = $request->file('foto');
        $namaFoto = time() . '_foto.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('uploads/foto'), $namaFoto);

        // Upload KK
        $kk = $request->file('kk');
        $namaKK = time() . '_kk.' . $kk->getClientOriginalExtension();
        $kk->move(public_path('uploads/kk'), $namaKK);

        // Simpan ke database
        Pendaftar::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,

            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,

            'sekolah_asal' => $request->sekolah_asal,
            'alamat_sekolah_asal' => $request->alamat_sekolah_asal,

            'foto' => $namaFoto,
            'kk' => $namaKK,

            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
    }

public function dashboard()
{
    $pendaftar = Pendaftar::where('user_id', Auth::id())->first();
    return view('siswa.dashboard', compact('pendaftar'));
}
public function berkas()
{
    $pendaftar = Pendaftar::where('user_id', Auth::id())->first();
    return view('siswa.berkas', compact('pendaftar'));
}

public function uploadBerkas(Request $request)
{
    $pendaftar = Pendaftar::where('user_id', Auth::id())->first();

    // Validasi file
    $request->validate([
        'foto' => 'nullable|mimes:jpg,png,jpeg|max:2048',
        'kk' => 'nullable|mimes:jpg,png,pdf|max:2048',
        'akta' => 'nullable|mimes:jpg,png,pdf|max:2048',
        'skl' => 'nullable|mimes:jpg,png,pdf|max:2048',
        'rapor' => 'nullable|mimes:pdf|max:5120',
    ]);

    // Simpan file
    if ($request->hasFile('foto')) {
        $pendaftar->foto = $request->file('foto')->store('ppdb', 'public');
    }
    if ($request->hasFile('kk')) {
        $pendaftar->kk = $request->file('kk')->store('ppdb', 'public');
    }
    if ($request->hasFile('akta')) {
        $pendaftar->akta = $request->file('akta')->store('ppdb', 'public');
    }
    if ($request->hasFile('skl')) {
        $pendaftar->skl = $request->file('skl')->store('ppdb', 'public');
    }
    if ($request->hasFile('rapor')) {
        $pendaftar->rapor = $request->file('rapor')->store('ppdb', 'public');
    }

    $pendaftar->save();

    return back()->with('success', 'Berkas berhasil diupload!');
}
}
?>