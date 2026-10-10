@extends('layouts.admin')

@section('title', 'Laporan PPDB/SPMB')
@section('pageTitle', 'Laporan PPDB/SPMB')

@section('content')
    <style>
        @media print {
            @page { size: A4 landscape; margin: 12mm; }
            body { background: #fff !important; }
            aside, header, .report-actions, .report-filters, .report-pagination { display: none !important; }
            .report-shell { margin: 0 !important; max-width: none !important; }
            .report-print-header { display: flex !important; }
            .report-card { border: 1px solid #dbe3ec !important; box-shadow: none !important; break-inside: avoid; }
        }
        .report-print-header { display: none; }
    </style>

    @php
        $statusStyles = [
            'Diterima' => 'bg-green-100 text-green-700',
            'Ditolak' => 'bg-red-100 text-red-700',
            'Dalam Proses' => 'bg-amber-100 text-amber-700',
            'Menunggu' => 'bg-amber-100 text-amber-700',
        ];
        $query = request()->query();
    @endphp

    <div class="report-shell mx-auto max-w-7xl space-y-6">
        <div class="report-print-header items-center gap-4 border-b-2 border-[#0A2540] pb-4">
            <img src="{{ $logoUrl }}" alt="Logo SMP Negeri 1 Pirime" class="h-16 w-16 object-contain">
            <div>
                <h1 class="text-xl font-extrabold text-[#0A2540]">SMP NEGERI 1 PIRIME</h1>
                <p class="text-sm text-slate-600">Cerdas, Mandiri, Berkarakter</p>
                <p class="text-xs text-slate-500">Pirime, Lanny Jaya, Papua Pegunungan</p>
            </div>
        </div>

        <section class="report-card overflow-hidden rounded-2xl bg-[#0A2540] p-6 text-white shadow-lg sm:p-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center gap-4">
                    <img src="{{ $logoUrl }}" alt="Logo SMP Negeri 1 Pirime" class="hidden h-16 w-16 rounded-xl bg-white object-contain p-1 sm:block">
                    <div>
                        <p class="mb-2 text-xs font-bold uppercase tracking-[.2em] text-[#D4AF37]">Administrasi PPDB/SPMB</p>
                        <h1 class="text-2xl font-extrabold sm:text-3xl">Laporan Penerimaan Peserta Didik Baru</h1>
                        <p class="mt-2 text-sm text-slate-200">SMP NEGERI 1 PIRIME · Cerdas, Mandiri, Berkarakter</p>
                    </div>
                </div>
                <div class="report-actions flex flex-wrap gap-3">
                    <a href="{{ route('admin.pendaftar') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 px-4 py-3 text-sm font-bold text-white hover:bg-white/10"><i class="fas fa-plus"></i>Data Siswa</a>
                    <a href="{{ route('admin.laporan.cetak', $query) }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl bg-[#D4AF37] px-4 py-3 text-sm font-bold text-[#0A2540] hover:bg-[#edcf62]"><i class="fas fa-print"></i>Cetak Laporan</a>
                    <a href="{{ route('admin.laporan.cetak', $query) }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl border border-white/30 px-4 py-3 text-sm font-bold text-white hover:bg-white/10"><i class="fas fa-file-pdf"></i>Download PDF</a>
                    <a href="{{ route('admin.laporan.export', $query) }}" class="inline-flex items-center gap-2 rounded-xl bg-green-600 px-4 py-3 text-sm font-bold text-white hover:bg-green-700"><i class="fas fa-file-excel"></i>Backup / Excel</a>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ([['label' => 'Total Pendaftar', 'value' => $report['total'], 'icon' => 'fa-users', 'color' => 'text-[#0A2540]', 'bg' => 'bg-slate-100'], ['label' => 'Diterima', 'value' => $report['diterima'], 'icon' => 'fa-check-circle', 'color' => 'text-green-600', 'bg' => 'bg-green-50'], ['label' => 'Dalam Proses', 'value' => $report['proses'], 'icon' => 'fa-clock', 'color' => 'text-amber-600', 'bg' => 'bg-amber-50'], ['label' => 'Ditolak', 'value' => $report['ditolak'], 'icon' => 'fa-times-circle', 'color' => 'text-red-600', 'bg' => 'bg-red-50']] as $item)
                <div class="report-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><div class="flex items-center justify-between"><div><p class="text-sm font-medium text-slate-500">{{ $item['label'] }}</p><p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $item['value'] }} <span class="text-sm font-medium text-slate-400">Siswa</span></p></div><span class="flex h-12 w-12 items-center justify-center rounded-xl {{ $item['bg'] }} {{ $item['color'] }}"><i class="fas {{ $item['icon'] }} text-xl"></i></span></div></div>
            @endforeach
        </div>

        <section class="report-filters report-card rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="mb-4 flex items-center gap-3"><span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#0A2540] text-white"><i class="fas fa-filter"></i></span><div><h2 class="font-bold text-[#0A2540]">Filter Data</h2><p class="text-xs text-slate-500">Gunakan filter untuk menampilkan data yang diperlukan panitia.</p></div></div>
            <form method="GET" action="{{ route('admin.laporan') }}" class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                <label class="text-sm font-semibold text-slate-700">Tahun Ajaran<select name="tahun" class="mt-2 w-full rounded-xl border-slate-200 text-sm"><option value="">Semua Tahun</option>@foreach ($years as $year)<option value="{{ $year }}" @selected(($filters['tahun'] ?? '') == $year)>{{ $year }}/{{ $year + 1 }}</option>@endforeach</select></label>
                <label class="text-sm font-semibold text-slate-700">Gelombang<select name="gelombang" class="mt-2 w-full rounded-xl border-slate-200 text-sm" @disabled(!$hasGelombang)><option value="">Semua Gelombang</option>@foreach (['1', '2', '3'] as $wave)<option value="{{ $wave }}" @selected(($filters['gelombang'] ?? '') == $wave)>Gelombang {{ $wave }}</option>@endforeach</select>@unless($hasGelombang)<span class="mt-1 block text-xs font-normal text-slate-400">Belum tersedia di database.</span>@endunless</label>
                <label class="text-sm font-semibold text-slate-700">Status<select name="status" class="mt-2 w-full rounded-xl border-slate-200 text-sm"><option value="">Semua Status</option><option value="Diterima" @selected(($filters['status'] ?? '') === 'Diterima')>Diterima</option><option value="Menunggu" @selected(($filters['status'] ?? '') === 'Menunggu')>Dalam Proses / Menunggu</option><option value="Ditolak" @selected(($filters['status'] ?? '') === 'Ditolak')>Ditolak</option></select></label>
                <label class="text-sm font-semibold text-slate-700">Jenis Kelamin<select name="jenis_kelamin" class="mt-2 w-full rounded-xl border-slate-200 text-sm"><option value="">Semua Jenis Kelamin</option><option value="Laki-laki" @selected(($filters['jenis_kelamin'] ?? '') === 'Laki-laki')>Laki-laki</option><option value="Perempuan" @selected(($filters['jenis_kelamin'] ?? '') === 'Perempuan')>Perempuan</option></select></label>
                <label class="text-sm font-semibold text-slate-700">Asal Sekolah<select name="asal_sekolah" class="mt-2 w-full rounded-xl border-slate-200 text-sm"><option value="">Semua Asal Sekolah</option>@foreach ($schools as $school)<option value="{{ $school }}" @selected(($filters['asal_sekolah'] ?? '') === $school)>{{ $school }}</option>@endforeach</select></label>
                <label class="text-sm font-semibold text-slate-700">Tanggal Mulai<input type="date" name="tanggal_mulai" value="{{ $filters['tanggal_mulai'] ?? '' }}" class="mt-2 w-full rounded-xl border-slate-200 text-sm"></label>
                <label class="text-sm font-semibold text-slate-700">Tanggal Akhir<input type="date" name="tanggal_akhir" value="{{ $filters['tanggal_akhir'] ?? '' }}" class="mt-2 w-full rounded-xl border-slate-200 text-sm"></label>
                <label class="text-sm font-semibold text-slate-700 md:col-span-2 xl:col-span-1">Cari data<div class="mt-2 flex gap-2"><input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Nama / NISN / nomor..." class="min-w-0 flex-1 rounded-xl border-slate-200 text-sm"><button class="rounded-xl bg-[#0A2540] px-4 text-sm font-bold text-white hover:bg-[#173A63]" title="Terapkan filter"><i class="fas fa-search"></i></button><a href="{{ route('admin.laporan') }}" class="inline-flex items-center rounded-xl border border-slate-200 px-3 text-slate-600" title="Reset filter"><i class="fas fa-rotate-left"></i></a></div></label>
            </form>
        </section>

        <section class="report-card overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-2 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6"><div><h2 class="text-xl font-bold text-[#0A2540]">Data Siswa Terdaftar</h2><p class="mt-1 text-sm text-slate-500">Menampilkan {{ $pendaftars->firstItem() ?? 0 }}-{{ $pendaftars->lastItem() ?? 0 }} dari {{ $pendaftars->total() }} data.</p></div><span class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tahun Ajaran {{ $report['tahun'] }}</span></div>
            <div class="overflow-x-auto"><table class="min-w-full divide-y divide-slate-200 text-sm"><thead class="bg-[#173A63] text-left text-xs uppercase tracking-wide text-white"><tr><th class="px-4 py-3">No</th><th class="px-4 py-3">No. Pendaftaran</th><th class="px-4 py-3">NISN</th><th class="px-4 py-3">Nama Lengkap</th><th class="px-4 py-3">Tempat/Tgl Lahir</th><th class="px-4 py-3">Jenis Kelamin</th><th class="px-4 py-3">Asal Sekolah</th><th class="px-4 py-3">No. HP</th><th class="px-4 py-3">Tanggal Daftar</th><th class="px-4 py-3">Status</th><th class="report-actions px-4 py-3">Aksi</th></tr></thead><tbody class="divide-y divide-slate-100">
                @forelse ($pendaftars as $index => $pendaftar)
                    @php $label = $pendaftar->status === 'Menunggu' ? 'Dalam Proses' : ($pendaftar->status ?: 'Menunggu'); @endphp
                    <tr class="transition hover:bg-slate-50"><td class="whitespace-nowrap px-4 py-4 text-slate-500">{{ $pendaftars->firstItem() + $index }}</td><td class="whitespace-nowrap px-4 py-4 font-semibold text-[#0A2540]">{{ $pendaftar->nomor_pendaftaran ?: '-' }}</td><td class="whitespace-nowrap px-4 py-4 text-slate-600">{{ $pendaftar->nisn ?: '-' }}</td><td class="whitespace-nowrap px-4 py-4 font-semibold text-slate-800">{{ $pendaftar->nama_lengkap }}</td><td class="whitespace-nowrap px-4 py-4 text-slate-600">{{ $pendaftar->tempat_lahir ?: '-' }}, {{ optional($pendaftar->tanggal_lahir)->format('d/m/Y') ?: '-' }}</td><td class="whitespace-nowrap px-4 py-4 text-slate-600">{{ $pendaftar->jenis_kelamin ?: '-' }}</td><td class="whitespace-nowrap px-4 py-4 text-slate-600">{{ $pendaftar->nama_sekolah ?: '-' }}</td><td class="whitespace-nowrap px-4 py-4 text-slate-600">{{ $pendaftar->no_hp_siswa ?: '-' }}</td><td class="whitespace-nowrap px-4 py-4 text-slate-600">{{ optional($pendaftar->created_at)->format('d/m/Y') }}</td><td class="whitespace-nowrap px-4 py-4"><span class="rounded-full px-3 py-1 text-xs font-bold {{ $statusStyles[$label] ?? 'bg-slate-100 text-slate-700' }}">{{ $label }}</span></td><td class="report-actions whitespace-nowrap px-4 py-4"><a href="{{ route('admin.detail', $pendaftar->id) }}" class="font-semibold text-[#0A2540] hover:text-[#B48712]"><i class="fas fa-eye mr-1"></i>Lihat</a></td></tr>
                @empty
                    <tr><td colspan="11" class="px-5 py-16 text-center text-slate-500"><i class="fas fa-inbox mb-3 text-3xl text-slate-300"></i><p class="font-semibold text-slate-700">Belum ada data peserta didik yang terdaftar.</p><p class="mt-1 text-xs">Statistik tetap menunjukkan data aktual: 0 pendaftar.</p></td></tr>
                @endforelse
            </tbody></table></div>
            <div class="report-pagination border-t border-slate-100 px-5 py-4 sm:px-6">{{ $pendaftars->links() }}</div>
        </section>
    </div>
@endsection
