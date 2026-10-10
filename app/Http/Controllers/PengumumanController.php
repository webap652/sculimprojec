<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::aktif()->terbaru()->get();

        return view('pengumuman.index', compact('pengumumans'));
    }

    public function show(Pengumuman $pengumuman)
    {
        abort_unless($pengumuman->aktif, 404);

        return view('pengumuman.show', compact('pengumuman'));
    }
}