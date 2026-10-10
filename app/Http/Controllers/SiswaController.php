<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Pengumuman;
use App\Models\Setting;
use Dompdf\Dompdf;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        $pengumumans = Pengumuman::aktif()->terbaru()->take(3)->get();
        return view('siswa.dashboard', compact('pendaftar', 'pengumumans'));
    }

    public function formPendaftaran()
    {
        if (!Setting::ppdbIsOpen()) {
            return view('siswa.pendaftaran-ditutup', [
                'academicYear' => Setting::ppdbAcademicYear(),
                'closeMessage' => Setting::ppdbCloseMessage(),
            ]);
        }

        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        return view('siswa.form', ['data' => $pendaftar]);
    }

    public function simpanPendaftaran(Request $r)
    {
        if (!Setting::ppdbIsOpen()) {
            return back()->with('error', 'Pendaftaran PPDB/SPMB saat ini telah ditutup.');
        }

        $validated = $r->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'nisn' => 'nullable|string|max:10',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'no_hp_siswa' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'anak_ke' => 'nullable|integer',
            'jumlah_saudara' => 'nullable|integer',
            'nama_ayah' => 'required|string|max:255',
            'pendidikan_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'no_hp_ayah' => 'nullable|string|max:15',
            'nama_ibu' => 'required|string|max:255',
            'pendidikan_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_hp_ibu' => 'nullable|string|max:15',
            'penghasilan_orangtua' => 'nullable|string|max:100',
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'alamat_sekolah' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kk' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'akte' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'ijazah' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'kartu_nisn' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $fileFields = ['foto_profil', 'foto', 'kk', 'akte', 'ijazah', 'kartu_nisn'];
        $pendaftarData = collect($validated)->except($fileFields)->all();

        $pendaftar = Pendaftar::updateOrCreate(
            ['user_id' => auth()->id()],
            $pendaftarData
        );

        // Handle file uploads
        if ($r->hasFile('foto_profil')) {
            $pendaftar->foto_profil = $r->file('foto_profil')->store('berkas', 'public');
        }
        if ($r->hasFile('foto')) {
            $pendaftar->foto = $r->file('foto')->store('berkas', 'public');
        }
        if ($r->hasFile('kk')) {
            $pendaftar->kk = $r->file('kk')->store('berkas', 'public');
        }
        if ($r->hasFile('akte')) {
            $pendaftar->akte = $r->file('akte')->store('berkas', 'public');
        }
        if ($r->hasFile('ijazah')) {
            $pendaftar->ijazah = $r->file('ijazah')->store('berkas', 'public');
        }
        if ($r->hasFile('kartu_nisn')) {
            $pendaftar->kartu_nisn = $r->file('kartu_nisn')->store('berkas', 'public');
        }

        $pendaftar->save();

        return back()->with('sukses', 'Data pendaftaran berhasil disimpan dan sedang menunggu verifikasi dari admin.');
    }

    public function berkas()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        return view('siswa.berkas', compact('pendaftar'));
    }

    public function uploadBerkas(Request $request)
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();

        $request->validate([
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto' => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'kk' => 'nullable|mimes:jpg,png,pdf|max:2048',
            'akte' => 'nullable|mimes:jpg,png,pdf|max:2048',
            'ijazah' => 'nullable|mimes:jpg,png,pdf|max:2048',
            'kartu_nisn' => 'nullable|mimes:jpg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            $pendaftar->foto_profil = $request->file('foto_profil')->store('berkas', 'public');
        }
        if ($request->hasFile('foto')) {
            $pendaftar->foto = $request->file('foto')->store('berkas', 'public');
        }
        if ($request->hasFile('kk')) {
            $pendaftar->kk = $request->file('kk')->store('berkas', 'public');
        }
        if ($request->hasFile('akte')) {
            $pendaftar->akte = $request->file('akte')->store('berkas', 'public');
        }
        if ($request->hasFile('ijazah')) {
            $pendaftar->ijazah = $request->file('ijazah')->store('berkas', 'public');
        }
        if ($request->hasFile('kartu_nisn')) {
            $pendaftar->kartu_nisn = $request->file('kartu_nisn')->store('berkas', 'public');
        }

        $pendaftar->save();

        return back()->with('success', 'Berkas berhasil diupload!');
    }

    public function pengumuman()
    {
        $pengumumans = Pengumuman::aktif()->terbaru()->get();
        return view('siswa.pengumuman', compact('pengumumans'));
    }

    public function status()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        return view('siswa.status', compact('pendaftar'));
    }

    public function cetakPdf()
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();

        $dompdf = new Dompdf();
        $html = view('siswa.cetak', compact('pendaftar'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('bukti-pendaftaran.pdf');
    }
}
