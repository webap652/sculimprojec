<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Pendaftar;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $now = now();

        // Ambil tren pendaftaran dari database (7 hari terakhir)
        $trendLast7Days = Pendaftar::query()
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->whereDate('created_at', '>=', $now->copy()->subDays(6))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $trendLabels7 = [];
        $trendData7 = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = $now->copy()->subDays($i)->format('D'); // Mon, Tue, ... (English)
            $trendLabels7[] = $now->copy()->subDays($i)->translatedFormat('D');
            $trendData7[] = (int) ($trendLast7Days->firstWhere('day', $now->copy()->subDays($i)->toDateString())->total ?? 0);
        }

        // Tren bulan ini (per minggu dalam bulan berjalan)
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Hitung 4 minggu (atau 5 minggu) berdasarkan week-of-month sederhana
        $weeksInMonth = 5;
        $trendLabelsMonth = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Minggu 5'];
        $trendDataMonth = array_fill(0, $weeksInMonth, 0);

        $monthData = Pendaftar::query()
            ->selectRaw('created_at')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get();

        foreach ($monthData as $row) {
            $created = $row->created_at->copy();
            // week index dalam bulan: 0..4
            $weekIndex = (int) floor($created->diffInDays($startOfMonth) / 7);
            $weekIndex = min(max($weekIndex, 0), $weeksInMonth - 1);
            $trendDataMonth[$weekIndex]++;
        }

        return view('admin.dashboard', [
            'jumlahPendaftar' => Pendaftar::count(),
            'belumVerifikasi' => Pendaftar::where('status', 'Menunggu')->count(),
            'sudahDiverifikasi' => Pendaftar::where('status', '!=', 'Menunggu')->count(),
            'diterima' => Pendaftar::where('status', 'Diterima')->count(),
            'ditolak' => Pendaftar::where('status', 'Ditolak')->count(),
            'pendaftarTerbaru' => Pendaftar::with('user')->latest()->take(5)->get(),
            'notifPendaftarBaru' => Pendaftar::with('user')
                ->where('status', 'Menunggu')
                ->latest()
                ->limit(5)
                ->get(),
            'notifCountPendaftarBaru' => Pendaftar::where('status', 'Menunggu')->count(),
            'trendLabels7' => $trendLabels7,
            'trendData7' => $trendData7,
            'trendLabelsMonth' => array_slice($trendLabelsMonth, 0, $weeksInMonth),
            'trendDataMonth' => $trendDataMonth,
        ]);

    }

    public function pendaftar()
    {
        $pendaftars = Pendaftar::with('user')->get();
        return view('admin.pendaftar', compact('pendaftars'));
    }

    public function detailPendaftar($id)
    {
        $pendaftar = Pendaftar::with('user')->findOrFail($id);
        return view('admin.detail', compact('pendaftar'));
    }

    public function verifikasi(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = $request->status;
        $pendaftar->catatan_admin = $request->catatan_admin;
        $pendaftar->save();

        return back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    public function laporan()
    {
        $pendaftars = Pendaftar::all();
        return view('admin.laporan', compact('pendaftars'));
    }

    public function pengumuman()
    {
        $pengumumans = Pengumuman::terbaru()->get();
        return view('admin.pengumuman', compact('pengumumans'));
    }

    public function buatPengumuman()
    {
        return view('admin.buat-pengumuman');
    }

    public function simpanPengumuman(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|in:informasi,pengumuman,penting',
            'aktif' => 'boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Additional check to ensure isi is not empty
        if (empty(trim($request->isi))) {
            return back()->withErrors(['isi' => 'Isi pengumuman tidak boleh kosong.'])->withInput();
        }

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'jenis' => $request->jenis,
            'aktif' => $request->has('aktif'),
            'tanggal_publish' => now(),
        ];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_.]/', '_', $file->getClientOriginalName());
            $file->move(public_path('storage/pengumuman'), $filename);
            $data['gambar'] = $filename;
        }

        Pengumuman::create($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function editPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.edit-pengumuman', compact('pengumuman'));
    }

    public function updatePengumuman(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|in:informasi,pengumuman,penting',
            'aktif' => 'boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Additional check to ensure isi is not empty
        if (empty(trim($request->isi))) {
            return back()->withErrors(['isi' => 'Isi pengumuman tidak boleh kosong.'])->withInput();
        }

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'jenis' => $request->jenis,
            'aktif' => $request->has('aktif'),
        ];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($pengumuman->gambar && file_exists(public_path('storage/pengumuman/' . $pengumuman->gambar))) {
                unlink(public_path('storage/pengumuman/' . $pengumuman->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_.]/', '_', $file->getClientOriginalName());
            $file->move(public_path('storage/pengumuman'), $filename);
            $data['gambar'] = $filename;
        }

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function hapusPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        // Delete image file if exists
        if ($pengumuman->gambar && file_exists(public_path('storage/pengumuman/' . $pengumuman->gambar))) {
            unlink(public_path('storage/pengumuman/' . $pengumuman->gambar));
        }

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function togglePengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->aktif = !$pengumuman->aktif;
        $pengumuman->save();

        $status = $pengumuman->aktif ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil ' . $status . '.');
    }
}
