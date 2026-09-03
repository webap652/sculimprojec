<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $sekolahPengumuman = Pengumuman::aktif()
            ->where('jenis', 'informasi')
            ->terbaru()
            ->get();

        $ppdbPengumuman = Pengumuman::aktif()
            ->where('jenis', 'pengumuman')
            ->terbaru()
            ->get();

        // Tidak ada kolom kategori khusus, jadi memakai jenis `penting`.
        $agenda = Pengumuman::aktif()
            ->where('jenis', 'penting')
            ->terbaru()
            ->get();

        // Jadwal Ujian memakai fallback yang sama: jenis=penting.
        $jadwalUjian = Pengumuman::aktif()
            ->where('jenis', 'penting')
            ->terbaru()
            ->get();

        return view('pengumuman.index', [
            'sekolahPengumuman' => $sekolahPengumuman,
            'ppdbPengumuman' => $ppdbPengumuman,
            'agenda' => $agenda,
            'jadwalUjian' => $jadwalUjian,
            'detail'
        ]);
    }


public function show(Pengumuman $pengumuman)
    {
        // $pengumuman sudah otomatis mengambil data dari database berdasarkan ID di URL
        return view('pengumuman.show', compact('pengumuman'));
    }


}