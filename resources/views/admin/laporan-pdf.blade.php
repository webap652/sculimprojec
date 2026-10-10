@php
    $schoolName = \App\Models\Setting::get('school.identity.name', 'SMP NEGERI 1 PIRIME');
    $slogan = \App\Models\Setting::get('school.identity.slogan', 'Cerdas, Mandiri, Berkarakter');
    $address = \App\Models\Setting::get('school.contact.address', 'Pirime, Lanny Jaya, Papua Pegunungan');
    $email = \App\Models\Setting::get('school.contact.email', '-');
    $phone = \App\Models\Setting::get('school.contact.phone', '-');
    $headName = \App\Models\Setting::get('school.leadership.head_name', '-');
    $headNip = \App\Models\Setting::get('school.leadership.head_nip', '-');
    $committeeName = \App\Models\Setting::get('school.leadership.committee_name', '-');
    $committeeNip = \App\Models\Setting::get('school.leadership.committee_nip', '-');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 24px 28px 42px; }
        * { box-sizing: border-box; }
        body { color: #182333; font-family: DejaVu Sans, sans-serif; font-size: 9px; margin: 0; }
        .header { border-bottom: 3px solid #0A2540; padding-bottom: 10px; }
        .header-inner { display: table; width: 100%; }
        .logo-cell { display: table-cell; vertical-align: middle; width: 76px; }
        .logo { height: 62px; object-fit: contain; width: 62px; }
        .identity { display: table-cell; text-align: center; vertical-align: middle; }
        .school { color: #0A2540; font-size: 17px; font-weight: bold; margin: 0; }
        .slogan, .contact { color: #475569; margin: 3px 0 0; }
        .title { color: #0A2540; font-size: 14px; font-weight: bold; margin: 18px 0 2px; text-align: center; }
        .year { color: #8a6810; font-size: 11px; font-weight: bold; margin: 0; text-align: center; }
        .section { background: #0A2540; color: white; font-size: 9px; font-weight: bold; margin: 14px 0 0; padding: 6px 8px; }
        .info, .summary, .data, .signatures { border-collapse: collapse; width: 100%; }
        .info td { border: 1px solid #dbe3ec; padding: 6px; }
        .info .label { background: #f1f5f9; color: #475569; font-weight: bold; width: 17%; }
        .summary td { border: 1px solid #dbe3ec; padding: 7px; text-align: center; width: 25%; }
        .summary strong { color: #0A2540; display: block; font-size: 15px; margin-top: 3px; }
        .data { font-size: 8px; }
        .data th { background: #173A63; color: white; padding: 6px 4px; text-align: left; }
        .data td { border: 1px solid #dbe3ec; padding: 5px 4px; vertical-align: top; }
        .data tr:nth-child(even) td { background: #f7f9fc; }
        .data th:first-child, .data td:first-child { text-align: center; width: 5%; }
        .data th:nth-child(2) { width: 15%; }
        .data th:nth-child(4) { width: 11%; }
        .data th:nth-child(7) { width: 13%; }
        .data th:nth-child(8) { width: 14%; }
        .signatures { margin-top: 32px; page-break-inside: avoid; }
        .signatures td { text-align: center; vertical-align: top; width: 50%; }
        .signature-space { height: 58px; }
        .footer { border-top: 1px solid #cbd5e1; bottom: -27px; color: #64748b; font-size: 7px; padding-top: 6px; position: fixed; text-align: center; width: 100%; }
        .footer .page:after { content: counter(page); }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <div class="logo-cell">@if ($logoData && $logoMime)<img class="logo" src="data:{{ $logoMime }};base64,{{ $logoData }}" alt="Logo sekolah">@endif</div>
            <div class="identity">
                <h1 class="school">{{ $schoolName }}</h1>
                <p class="slogan">{{ $slogan }}</p>
                <p class="contact">{{ $address }} | {{ $email }} | {{ $phone }}</p>
            </div>
        </div>
    </header>
    <div class="title">LAPORAN PENERIMAAN PESERTA DIDIK BARU (PPDB)</div>
    <p class="year">TAHUN AJARAN {{ $report['tahun'] }}</p>
    <div class="section">INFORMASI LAPORAN</div>
    <table class="info">
        <tr><td class="label">Tanggal Cetak</td><td>{{ now()->format('d/m/Y') }}</td><td class="label">Pukul</td><td>{{ now()->format('H:i') }} WIT</td></tr>
        <tr><td class="label">Dicetak Oleh</td><td>{{ $reporter }}</td><td class="label">Gelombang</td><td>{{ $report['gelombang'] }}</td></tr>
        <tr><td class="label">Status</td><td>{{ $report['status'] }}</td><td class="label">Tahun Ajaran</td><td>{{ $report['tahun'] }}</td></tr>
    </table>
    <div class="section">RINGKASAN PPDB</div>
    <table class="summary"><tr><td>Total Pendaftar<strong>{{ $report['total'] }}</strong></td><td>Diterima<strong>{{ $report['diterima'] }}</strong></td><td>Dalam Proses<strong>{{ $report['proses'] }}</strong></td><td>Ditolak<strong>{{ $report['ditolak'] }}</strong></td></tr></table>
    <div class="section">DATA PESERTA DIDIK</div>
    <table class="data">
        <thead><tr><th>No</th><th>No. Pendaftaran</th><th>Nama Lengkap</th><th>NISN</th><th>Jenis Kelamin</th><th>Asal Sekolah</th><th>Tanggal Daftar</th><th>Status</th></tr></thead>
        <tbody>
            @forelse ($pendaftars as $index => $pendaftar)
                <tr><td>{{ $index + 1 }}</td><td>{{ $pendaftar->nomor_pendaftaran ?: '-' }}</td><td>{{ $pendaftar->nama_lengkap ?: '-' }}</td><td>{{ $pendaftar->nisn ?: '-' }}</td><td>{{ $pendaftar->jenis_kelamin ?: '-' }}</td><td>{{ $pendaftar->nama_sekolah ?: '-' }}</td><td>{{ optional($pendaftar->created_at)->format('d/m/Y') }}</td><td>{{ $pendaftar->status === 'Menunggu' ? 'Dalam Proses' : ($pendaftar->status ?: '-') }}</td></tr>
            @empty
                <tr><td colspan="8" style="text-align:center">Belum ada data pendaftar.</td></tr>
            @endforelse
        </tbody>
    </table>
    <table class="signatures">
        <tr><td>Mengetahui,<br><strong>KEPALA SEKOLAH</strong><br>{{ $schoolName }}<div class="signature-space"></div><strong>{{ $headName }}</strong><br>NIP. {{ $headNip }}</td><td><strong>KETUA PANITIA PPDB</strong><br>{{ $schoolName }}<div class="signature-space"></div><strong>{{ $committeeName }}</strong><br>NIP. {{ $committeeNip }}</td></tr>
    </table>
    <div class="footer">Dokumen resmi laporan PPDB {{ $schoolName }} | Tahun Ajaran {{ $report['tahun'] }} | Halaman <span class="page"></span></div>
</body>
</html>
