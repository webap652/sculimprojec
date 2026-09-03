<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftar;

class CekPendaftarSudahAda
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }

        $pendaftar = Pendaftar::where('user_id', Auth::id())->first();

        // Jika belum isi formulir pendaftaran (record belum ada), arahkan ke halaman pendaftaran
        if (!$pendaftar) {
            return redirect()->route('siswa.pendaftaran')
                ->with('info', 'Anda belum mengisi formulir pendaftaran. Silakan lengkapi formulir terlebih dahulu.');
        }

        return $next($request);
    }
}

