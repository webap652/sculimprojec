<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Pendaftar;
use App\Models\Pengumuman;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
            'ppdbOpen' => Setting::ppdbIsOpen(),
            'ppdbAcademicYear' => Setting::ppdbAcademicYear(),
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
        $filters = request()->only(['tahun', 'gelombang', 'status', 'jenis_kelamin', 'asal_sekolah', 'tanggal_mulai', 'tanggal_akhir', 'q']);
        $query = $this->reportQuery($filters);
        $pendaftars = (clone $query)->latest()->paginate(15)->withQueryString();

        return view('admin.laporan', $this->reportViewData($pendaftars, $filters));
    }

    public function cetakLaporan()
    {
        $filters = request()->only(['tahun', 'gelombang', 'status', 'jenis_kelamin', 'asal_sekolah', 'tanggal_mulai', 'tanggal_akhir', 'q']);
        $pendaftars = $this->reportQuery($filters)->latest()->get();
        $report = $this->reportMeta($pendaftars, $filters);
        $logoPath = $this->reportLogoPath();
        $logoData = $logoPath && is_file($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
        $logoMime = $logoPath && is_file($logoPath) ? mime_content_type($logoPath) : null;
        $reporter = auth()->user()?->name ?? '-';

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('admin.laporan-pdf', compact('pendaftars', 'logoData', 'logoMime', 'report', 'reporter'))->render());
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream('Laporan_PPDB_SMP_Negeri_1_Pirime_' . str_replace('/', '_', $report['tahun']) . '.pdf');
    }

    public function cetakBuktiPendaftar($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('siswa.cetak', compact('pendaftar'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('Bukti-Pendaftaran-' . $pendaftar->id . '.pdf');
    }

    public function exportLaporan()
    {
        $filters = request()->only(['tahun', 'gelombang', 'status', 'jenis_kelamin', 'asal_sekolah', 'tanggal_mulai', 'tanggal_akhir', 'q']);
        $pendaftars = $this->reportQuery($filters)->latest()->get();
        $report = $this->reportMeta($pendaftars, $filters);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data PPDB');

        $headers = [
            'No', 'No. Pendaftaran', 'NISN', 'Nama Lengkap', 'Tempat Lahir', 'Tanggal Lahir',
            'Jenis Kelamin', 'Asal Sekolah', 'Alamat', 'No. HP', 'Tanggal Daftar', 'Status',
        ];

        $sheet->mergeCells('A1:L1');
        $sheet->setCellValue('A1', 'SMP NEGERI 1 PIRIME');
        $sheet->mergeCells('A2:L2');
        $sheet->setCellValue('A2', 'Cerdas, Mandiri, Berkarakter');
        $sheet->mergeCells('A3:L3');
        $sheet->setCellValue('A3', 'BACKUP DATA PENERIMAAN PESERTA DIDIK BARU');
        $sheet->mergeCells('A4:L4');
        $sheet->setCellValue('A4', 'TAHUN AJARAN ' . $report['tahun']);
        $sheet->fromArray(['Total Pendaftar', $report['total'], 'Diterima', $report['diterima'], 'Dalam Proses', $report['proses'], 'Ditolak', $report['ditolak']], null, 'A6');
        $sheet->fromArray($headers, null, 'A8');

        foreach ($pendaftars as $index => $pendaftar) {
            $row = $index + 9;
            $sheet->fromArray([[
                $index + 1, $pendaftar->nomor_pendaftaran ?: '-', $pendaftar->nisn ?: '-', $pendaftar->nama_lengkap,
                $pendaftar->tempat_lahir ?: '-', optional($pendaftar->tanggal_lahir)->format('d/m/Y') ?: '-',
                $pendaftar->jenis_kelamin ?: '-', $pendaftar->nama_sekolah ?: '-', $pendaftar->alamat ?: '-',
                $pendaftar->no_hp_siswa ?: '-', optional($pendaftar->created_at)->format('d/m/Y'), $this->reportStatusLabel($pendaftar->status),
            ]], null, 'A' . $row);
        }

        $lastRow = max(8, $pendaftars->count() + 8);
        $sheet->getStyle('A1:L4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:L1')->getFont()->setBold(true)->setSize(16)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle('A2:L4')->getFont()->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle('A1:L4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF0A2540');
        $sheet->getStyle('A6:L6')->getFont()->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle('A6:L6')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF173A63');
        $sheet->getStyle('A8:L' . $lastRow)->getAlignment()->setVertical(Alignment::VERTICAL_TOP)->setWrapText(true);
        $sheet->getStyle('A8:L' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFD9E2EC');
        $sheet->getStyle('A8:L8')->getFont()->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle('A8:L8')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF173A63');
        $sheet->getAutoFilter()->setRange('A8:L' . $lastRow);
        $sheet->freezePane('A9');
        $sheet->getPageSetup()->setOrientation('landscape')->setFitToWidth(1)->setFitToHeight(0);
        $sheet->getPageMargins()->setTop(0.3)->setRight(0.25)->setLeft(0.25)->setBottom(0.3)->setHeader(0.15)->setFooter(0.15);
        $sheet->getPageSetup()->setHorizontalCentered(true)->setPrintArea('A1:L' . $lastRow)->setRowsToRepeatAtTopByStartAndEnd(8, 8);
        $sheet->getHeaderFooter()->setOddHeader('&C SMP NEGERI 1 PIRIME')->setOddFooter('&C PPDB Tahun Ajaran ' . $report['tahun'] . ' | Halaman &P dari &N');

        foreach (['A' => 7, 'B' => 20, 'C' => 16, 'D' => 28, 'E' => 18, 'F' => 15, 'G' => 16, 'H' => 26, 'I' => 30, 'J' => 18, 'K' => 16, 'L' => 18] as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }
        $sheet->getRowDimension(8)->setRowHeight(30);

        $logoPath = $this->reportLogoPath();
        if ($logoPath && is_file($logoPath)) {
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Logo Sekolah')->setDescription('Logo SMP Negeri 1 Pirime')->setPath($logoPath)->setHeight(45)->setCoordinates('A1')->setOffsetX(8)->setOffsetY(5)->setWorksheet($sheet);
        }

        $rekap = $spreadsheet->createSheet()->setTitle('Rekap PPDB');
        $rekap->fromArray([
            ['REKAPITULASI PPDB SMP NEGERI 1 PIRIME'],
            ['Tahun Ajaran', '2026/2027'],
            [],
            ['Status', 'Jumlah'],
            ['Diterima', $report['diterima']],
            ['Dalam Proses', $report['proses']],
            ['Ditolak', $report['ditolak']],
            ['Total Pendaftar', $report['total']],
            [],
            ['Jenis Kelamin', 'Jumlah'],
            ['Laki-laki', $pendaftars->where('jenis_kelamin', 'Laki-laki')->count()],
            ['Perempuan', $pendaftars->where('jenis_kelamin', 'Perempuan')->count()],
        ], null, 'A1');
        $rekap->getStyle('A1:B1')->getFont()->setBold(true)->setSize(14)->getColor()->setARGB('FFFFFFFF');
        $rekap->getStyle('A1:B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF0A2540');
        $rekap->getStyle('A4:B4')->getFont()->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $rekap->getStyle('A4:B4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF173A63');
        $rekap->getStyle('A10:B10')->getFont()->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $rekap->getStyle('A10:B10')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF173A63');
        $rekap->getStyle('A4:B12')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFD9E2EC');
        $rekap->getColumnDimension('A')->setWidth(28);
        $rekap->getColumnDimension('B')->setWidth(18);
        $rekap->getPageSetup()->setOrientation('portrait')->setFitToWidth(1)->setFitToHeight(1)->setPrintArea('A1:B12');
        $rekap->getHeaderFooter()->setOddHeader('&C SMP NEGERI 1 PIRIME')->setOddFooter('&C PPDB Tahun Ajaran ' . $report['tahun'] . ' | Halaman &P dari &N');

        $path = tempnam(sys_get_temp_dir(), 'laporan-ppdb-') . '.xlsx';
        (new Xlsx($spreadsheet))->save($path);

        return response()->download($path, 'Backup_Data_PPDB_SMP_Negeri_1_Pirime_' . str_replace('/', '_', $report['tahun']) . '.xlsx')->deleteFileAfterSend(true);
    }

    private function reportQuery(array $filters)
    {
        $query = Pendaftar::query();

        if (!empty($filters['tahun']) && preg_match('/^\d{4}$/', $filters['tahun'])) {
            $query->whereYear('created_at', $filters['tahun']);
        }
        if (!empty($filters['status']) && in_array($filters['status'], ['Menunggu', 'Diterima', 'Ditolak'], true)) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['gelombang']) && Schema::hasColumn('pendaftars', 'gelombang')) {
            $query->where('gelombang', $filters['gelombang']);
        }
        if (!empty($filters['q'])) {
            $search = trim($filters['q']);
            $query->where(function ($builder) use ($search) {
                $builder->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nisn', 'like', '%' . $search . '%')
                    ->orWhere('nomor_pendaftaran', 'like', '%' . $search . '%');
            });
        }
        if (!empty($filters['jenis_kelamin'])) {
            $query->where('jenis_kelamin', $filters['jenis_kelamin']);
        }
        if (!empty($filters['asal_sekolah'])) {
            $query->where('nama_sekolah', $filters['asal_sekolah']);
        }
        if (!empty($filters['tanggal_mulai'])) {
            $query->whereDate('created_at', '>=', $filters['tanggal_mulai']);
        }
        if (!empty($filters['tanggal_akhir'])) {
            $query->whereDate('created_at', '<=', $filters['tanggal_akhir']);
        }

        return $query;
    }

    private function reportViewData($pendaftars, array $filters): array
    {
        $all = $this->reportQuery($filters)->get(['status', 'jenis_kelamin']);
        $years = Pendaftar::query()->whereNotNull('created_at')->pluck('created_at')->map(fn ($date) => $date->format('Y'))->unique()->sortDesc()->values();
        $schools = Pendaftar::query()->whereNotNull('nama_sekolah')->where('nama_sekolah', '!=', '')->distinct()->orderBy('nama_sekolah')->pluck('nama_sekolah');

        return [
            'pendaftars' => $pendaftars,
            'filters' => $filters,
            'years' => $years,
            'schools' => $schools,
            'hasGelombang' => Schema::hasColumn('pendaftars', 'gelombang'),
            'report' => $this->reportMeta($all, $filters),
            'logoUrl' => Setting::getAssetUrl('school.assets.logo', 'images/logo sekolah.png'),
        ];
    }

    private function reportMeta($pendaftars, array $filters): array
    {
        $configuredYear = Setting::get('ppdb_academic_year', Setting::get('school.academic_year', '2026/2027'));

        return [
            'total' => $pendaftars->count(),
            'diterima' => $pendaftars->where('status', 'Diterima')->count(),
            'proses' => $pendaftars->where('status', 'Menunggu')->count(),
            'ditolak' => $pendaftars->where('status', 'Ditolak')->count(),
            'tahun' => !empty($filters['tahun']) ? $filters['tahun'] . '/' . ((int) $filters['tahun'] + 1) : $configuredYear,
            'gelombang' => $filters['gelombang'] ?? 'Semua Gelombang',
            'status' => !empty($filters['status']) ? $this->reportStatusLabel($filters['status']) : 'Semua Status',
        ];
    }

    private function reportStatusLabel(?string $status): string
    {
        return $status === 'Menunggu' ? 'Dalam Proses' : ($status ?: '-');
    }

    private function reportLogoPath(): ?string
    {
        $logo = Setting::get('school.assets.logo', 'images/logo sekolah.png');
        $logo = ltrim(str_replace('storage/', '', $logo), '/');

        return str_starts_with($logo, 'images/')
            ? public_path($logo)
            : Storage::disk('public')->path($logo);
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
            Storage::disk('public')->putFileAs('pengumuman', $file, $filename);
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
            if ($pengumuman->gambar && Storage::disk('public')->exists('pengumuman/' . $pengumuman->gambar)) {
                Storage::disk('public')->delete('pengumuman/' . $pengumuman->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_.]/', '_', $file->getClientOriginalName());
            Storage::disk('public')->putFileAs('pengumuman', $file, $filename);
            $data['gambar'] = $filename;
        }

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function hapusPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        // Delete image file if exists
        if ($pengumuman->gambar && Storage::disk('public')->exists('pengumuman/' . $pengumuman->gambar)) {
            Storage::disk('public')->delete('pengumuman/' . $pengumuman->gambar);
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
