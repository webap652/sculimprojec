<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran PPDB</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .content { margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 50px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SMP YPK KOTARAJA</h2>
        <h3>Bukti Pendaftaran PPDB</h3>
        <p>Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
    </div>

    <div class="content">
        @if($pendaftar)
        <table>
            <tr>
                <th colspan="2">DATA PENDAFTAR</th>
            </tr>
            <tr>
                <td>Nomor Pendaftaran</td>
                <td>: {{ $pendaftar->nomor_pendaftaran ?? 'Belum ada' }}</td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>: {{ $pendaftar->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>: {{ $pendaftar->nisn }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $pendaftar->nik }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $pendaftar->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>: {{ $pendaftar->tempat_lahir }}, {{ $pendaftar->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: {{ $pendaftar->agama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $pendaftar->alamat }}</td>
            </tr>
            <tr>
                <td>Sekolah Asal</td>
                <td>: {{ $pendaftar->nama_sekolah }}</td>
            </tr>
            <tr>
                <td>NPSN Sekolah</td>
                <td>: {{ $pendaftar->npsn }}</td>
            </tr>
            <tr>
                <td>Alamat Sekolah</td>
                <td>: {{ $pendaftar->alamat_sekolah }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2">DATA ORANG TUA</th>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>: {{ $pendaftar->nama_ayah }}</td>
            </tr>
            <tr>
                <td>Pekerjaan Ayah</td>
                <td>: {{ $pendaftar->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td>No. HP Ayah</td>
                <td>: {{ $pendaftar->no_hp_ayah }}</td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>: {{ $pendaftar->nama_ibu }}</td>
            </tr>
            <tr>
                <td>Pekerjaan Ibu</td>
                <td>: {{ $pendaftar->pekerjaan_ibu }}</td>
            </tr>
            <tr>
                <td>No. HP Ibu</td>
                <td>: {{ $pendaftar->no_hp_ibu }}</td>
            </tr>
            <tr>
                <td>Penghasilan Orang Tua</td>
                <td>: {{ $pendaftar->penghasilan_orangtua }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="2">STATUS PENDAFTARAN</th>
            </tr>
            <tr>
                <td>Status</td>
                <td>: {{ $pendaftar->status }}</td>
            </tr>
            <tr>
                <td>Tanggal Pendaftaran</td>
                <td>: {{ $pendaftar->created_at->format('d F Y') }}</td>
            </tr>
        </table>
        @endif
    </div>

    <div class="footer">
        <p>Bukti pendaftaran ini dicetak secara otomatis pada {{ date('d F Y H:i:s') }}</p>
        <p>Harap simpan bukti pendaftaran ini sebagai referensi.</p>
    </div>
</body>
</html>
