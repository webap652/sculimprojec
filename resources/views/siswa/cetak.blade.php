@php
    use App\Models\Setting;
    use Illuminate\Support\Facades\Storage;

    $schoolName = Setting::get('school.identity.name', 'SMP NEGERI 1 PIRIME') . ' KABUPATEN LANNY JAYA PROVINSI PAPUA PEGUNUNGAN';
    $academicYear = Setting::ppdbAcademicYear();
    $logoSetting = Setting::get('school.assets.logo', 'images/logo sekolah.png');
    $logoRelativePath = str_replace('storage/', '', ltrim($logoSetting, '/'));
    $logoPath = str_starts_with($logoRelativePath, 'images/')
        ? public_path($logoRelativePath)
        : Storage::disk('public')->path($logoRelativePath);
    $logoData = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
    $logoMime = file_exists($logoPath) ? mime_content_type($logoPath) : null;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran PPDB - {{ $pendaftar->nama_lengkap ?? $schoolName }}</title>
    <style>
        @page { margin: 28px 34px; }
        * { box-sizing: border-box; }
        body { color: #172033; font-family: DejaVu Sans, sans-serif; font-size: 10px; line-height: 1.45; margin: 0; }
        .header { border-bottom: 3px solid #173a63; padding-bottom: 12px; position: relative; text-align: center; }
        .header:after { background: #c59b27; bottom: -6px; content: ''; height: 3px; left: 18%; position: absolute; right: 18%; }
        .logo { height: 64px; margin-bottom: 5px; width: 64px; }
        .school { color: #173a63; font-size: 17px; font-weight: bold; letter-spacing: 1px; margin: 0; }
        .document-title { color: #334155; font-size: 13px; font-weight: bold; margin: 3px 0; }
        .academic-year { color: #64748b; font-size: 10px; margin: 0; }
        .intro { color: #475569; margin: 23px 0 12px; text-align: center; }
        .section-title { background: #173a63; color: #fff; font-size: 10px; font-weight: bold; letter-spacing: .5px; padding: 7px 9px; }
        table { border-collapse: collapse; margin: 0 0 15px; width: 100%; }
        td { border: 1px solid #dbe3ec; padding: 7px 9px; vertical-align: top; }
        td.label { background: #f4f7fa; color: #475569; font-weight: bold; width: 31%; }
        .status { background: #ecfdf5; color: #047857; font-weight: bold; }
        .signature { margin-top: 24px; text-align: right; }
        .signature-space { height: 48px; }
        .footer { border-top: 1px solid #cbd5e1; color: #64748b; font-size: 8px; margin-top: 22px; padding-top: 8px; text-align: center; }
        .empty { color: #64748b; padding: 30px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        @if ($logoData && $logoMime)
            <img class="logo" src="data:{{ $logoMime }};base64,{{ $logoData }}" alt="Logo sekolah">
        @endif
        <h1 class="school">{{ $schoolName }}</h1>
        <div class="document-title">BUKTI PENDAFTARAN PPDB</div>
        <p class="academic-year">Tahun Ajaran {{ $academicYear }}</p>
    </div>

    @if ($pendaftar)
        <p class="intro">Dokumen resmi ini merupakan bukti bahwa data pendaftaran peserta didik telah tersimpan dalam sistem PPDB.</p>

        <div class="section-title">DATA PENDAFTAR</div>
        <table>
            <tr><td class="label">Nomor Pendaftaran</td><td>{{ $pendaftar->nomor_pendaftaran ?? '-' }}</td></tr>
            <tr><td class="label">Nama Lengkap</td><td>{{ $pendaftar->nama_lengkap ?? '-' }}</td></tr>
            <tr><td class="label">NISN</td><td>{{ $pendaftar->nisn ?? '-' }}</td></tr>
            <tr><td class="label">NIK</td><td>{{ $pendaftar->nik ?? '-' }}</td></tr>
            <tr><td class="label">Jenis Kelamin</td><td>{{ $pendaftar->jenis_kelamin ?? '-' }}</td></tr>
            <tr><td class="label">Tempat, Tanggal Lahir</td><td>{{ $pendaftar->tempat_lahir ?? '-' }}, {{ $pendaftar->tanggal_lahir?->format('d-m-Y') ?? '-' }}</td></tr>
            <tr><td class="label">Agama</td><td>{{ $pendaftar->agama ?? '-' }}</td></tr>
            <tr><td class="label">Alamat</td><td>{{ $pendaftar->alamat ?? '-' }}</td></tr>
        </table>

        <div class="section-title">DATA SEKOLAH ASAL</div>
        <table>
            <tr><td class="label">Nama Sekolah</td><td>{{ $pendaftar->nama_sekolah ?? '-' }}</td></tr>
            <tr><td class="label">NPSN</td><td>{{ $pendaftar->npsn ?? '-' }}</td></tr>
            <tr><td class="label">Alamat Sekolah</td><td>{{ $pendaftar->alamat_sekolah ?? '-' }}</td></tr>
        </table>

        <div class="section-title">DATA ORANG TUA</div>
        <table>
            <tr><td class="label">Nama Ayah</td><td>{{ $pendaftar->nama_ayah ?? '-' }}</td></tr>
            <tr><td class="label">Pekerjaan Ayah</td><td>{{ $pendaftar->pekerjaan_ayah ?? '-' }}</td></tr>
            <tr><td class="label">Nama Ibu</td><td>{{ $pendaftar->nama_ibu ?? '-' }}</td></tr>
            <tr><td class="label">Pekerjaan Ibu</td><td>{{ $pendaftar->pekerjaan_ibu ?? '-' }}</td></tr>
            <tr><td class="label">No. HP Orang Tua</td><td>{{ $pendaftar->no_hp_ayah ?: ($pendaftar->no_hp_ibu ?? '-') }}</td></tr>
        </table>

        <div class="section-title">STATUS PENDAFTARAN</div>
        <table>
            <tr><td class="label">Status</td><td class="status">{{ $pendaftar->status ?? 'Menunggu' }}</td></tr>
            <tr><td class="label">Tanggal Pendaftaran</td><td>{{ $pendaftar->created_at?->format('d-m-Y H:i') ?? '-' }}</td></tr>
        </table>

        <div class="signature">
            Pirime, {{ now()->format('d F Y') }}<br>
            Panitia PPDB {{ $schoolName }}
            <div class="signature-space"></div>
            <strong>(____________________________)</strong>
        </div>
    @else
        <div class="empty">Data pendaftaran belum tersedia.</div>
    @endif

    <div class="footer">Bukti pendaftaran ini dicetak otomatis dari sistem PPDB {{ $schoolName }}.</div>
</body>
</html>