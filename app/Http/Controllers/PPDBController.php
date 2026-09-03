<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Pengumuman;
use App\Models\Setting;
use App\Models\Guru;
use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\Sejarah;
use App\Models\StrukturOrganisasi;
use App\Models\Galeri as GaleriModel;
use Illuminate\Support\Facades\DB;

class PPDBController extends Controller
{
    public function home()
    {
        $pengumumans = Pengumuman::aktif()->terbaru()->take(6)->get();
        $schoolName = Setting::get('school.identity.name', 'SMP NEGERI 1 PIRIME');
        return view('home.index', compact('pengumumans', 'schoolName'));
    }

    public function profil()
    {
        $data = $this->getSchoolData();
        $programs = $this->parsePrograms();
        $values = $this->parseValues();
        $goals = $this->parseGoals();
        $statistics = $this->getStatistics();

        return view('profil.index', compact('data', 'programs', 'values', 'goals', 'statistics'));
    }

    public function visiMisi()
    {
        $data = $this->getSchoolData();
        $goals = $this->parseGoals();

        return view('profil.visi-misi', compact('data', 'goals'));
    }

    public function sambutan()
    {
        $data = $this->getSchoolData();

        return view('profil.sambutan', compact('data'));
    }

    public function sejarah()
    {
        $data = $this->getSchoolData();
        $sejarahs = Sejarah::aktif()->urut()->get();

        return view('profil.sejarah', compact('data', 'sejarahs'));
    }

    public function strukturOrganisasi()
    {
        $data = $this->getSchoolData();
        // Load flat collection to avoid recursive N+1 / infinite loop
        $tree = StrukturOrganisasi::aktif()->urut()->get();

        return view('profil.struktur-organisasi', compact('data', 'tree'));
    }

    public function guruStaff()
    {
        $data = $this->getSchoolData();
        $gurus = Guru::aktif()->urut()->get();
        $mapelList = Guru::aktif()->whereNotNull('mapel')->distinct()->pluck('mapel')->sort()->values();

        $jumlahGuru = $gurus->count();
        $jumlahAsn = $gurus->where('status', 'ASN')->count();
        $jumlahHonorer = $gurus->where('status', 'Honorer')->count();

        return view('profil.guru-staff', compact('data', 'gurus', 'mapelList', 'jumlahGuru', 'jumlahAsn', 'jumlahHonorer'));
    }

    public function fasilitas()
    {
        $data = $this->getSchoolData();
        $fasilitasList = Fasilitas::aktif()->urut()->get()->groupBy('kategori');
        $kategoriList = Fasilitas::kategoriList();

        return view('profil.fasilitas', compact('data', 'fasilitasList', 'kategoriList'));
    }

    public function prestasi()
    {
        $data = $this->getSchoolData();
        $prestasis = Prestasi::aktif()->latest('tahun')->get();
        $kategoriList = Prestasi::kategoriList();
        $tingkatList = Prestasi::tingkatList();

        return view('profil.prestasi', compact('data', 'prestasis', 'kategoriList', 'tingkatList'));
    }

    // Menu publik: Kesiswaan
    public function kesiswaan()
    {
        return view('kesiswaan.index');
    }

    // Menu publik: Kontak
    public function kontak()
    {
        $data = [
            'telepon' => Setting::get('school.contact.phone', '-'),
            'email' => Setting::get('school.contact.email', '-'),
            'alamat' => Setting::get('school.contact.address', '-'),
            'facebook' => Setting::get('school.social.facebook', '#'),
            'instagram' => Setting::get('school.social.instagram', '#'),
            'youtube' => Setting::get('school.social.youtube', '#'),
            'twitter' => Setting::get('school.social.twitter', '#'),
            'whatsapp' => Setting::get('school.social.whatsapp', '#'),
            'jam_operasional' => Setting::get('school.contact.jam_operasional', '07:00 - 15:00 WIT'),
        ];
        return view('kontak.index', compact('data'));
    }

    // Menu publik: Guru
    public function guru()
    {
        $gurus = Guru::aktif()->urut()->get();
        $mapelList = Guru::aktif()->whereNotNull('mapel')->distinct()->pluck('mapel')->sort()->values();
        $jumlahGuru = $gurus->count();
        $jumlahAsn = $gurus->where('status', 'ASN')->count();
        $jumlahHonorer = $gurus->where('status', 'Honorer')->count();
        
        $data = [
            'gurus' => $gurus,
            'mapelList' => $mapelList,
            'jumlahGuru' => $jumlahGuru,
            'jumlahAsn' => $jumlahAsn,
            'jumlahHonorer' => $jumlahHonorer,
        ];
        return view('guru.index', compact('data'));
    }

    public function ppdb()
    {
        $data = [
            'ppdb_online' => Setting::get('ppdb.online_url', '#'),
        ];

        return view('ppdb.index', compact('data'));
    }

    public function pengumuman()
    {
        $pengumumans = Pengumuman::aktif()->terbaru()->get();
        return view('pengumuman.index', compact('pengumumans'));
    }

    public function galeri()
    {
        $galeris = GaleriModel::aktif()->latest()->paginate(12);
        $kategoriList = GaleriModel::aktif()->whereNotNull('kategori')->distinct()->pluck('kategori')->sort()->values();
        
        return view('galeri.index', compact('galeris', 'kategoriList'));
    }

    /**
     * Helper: Get all school data from settings
     */
    private function getSchoolData(): array
    {
        $data = [
            'nama' => Setting::get('school.identity.name', '-'),
            'npsn' => Setting::get('school.identity.npsn', '-'),
            'jenis' => Setting::get('school.identity.jenis', '-'),
            'akreditasi' => Setting::get('school.identity.akreditasi', '-'),
            'tahun_berdiri' => Setting::get('school.identity.tahun_berdiri', '-'),
            'kabupaten' => Setting::get('school.identity.kabupaten', '-'),
            'provinsi' => Setting::get('school.identity.provinsi', '-'),
            'slogan' => Setting::get('school.identity.slogan', '-'),
            'kepala_sekolah' => Setting::get('school.leadership.head_name', '-'),
            'nip_kepsek' => Setting::get('school.leadership.head_nip', '-'),
            'foto_kepsek' => Setting::get('school.leadership.head_photo', ''),
            'alamat' => Setting::get('school.contact.address', '-'),
            'email' => Setting::get('school.contact.email', '-'),
            'telepon' => Setting::get('school.contact.phone', '-'),
            'sambutan' => Setting::get('school.leadership.head_welcome', '-'),
            'harapan' => Setting::get('school.leadership.head_harapan', '-'),
            'visi' => Setting::get('school.leadership.vision', '-'),
            'misi_raw' => Setting::get('school.leadership.mission', ''),
            'moto' => Setting::get('school.leadership.motto', '-'),
            'goals_raw' => Setting::get('school.leadership.goals', ''),
            'programs_raw' => Setting::get('school.programs', ''),
            'values_raw' => Setting::get('school.values', ''),
            'facebook' => Setting::get('school.social.facebook', '#'),
            'instagram' => Setting::get('school.social.instagram', '#'),
            'youtube' => Setting::get('school.social.youtube', '#'),
        ];

        // Parse misi
        if (is_string($data['misi_raw'])) {
            $data['misi'] = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|;/', $data['misi_raw']))));
        } else {
            $data['misi'] = [];
        }

        return $data;
    }

    /**
     * Parse programs from pipe-delimited format
     */
    private function parsePrograms(): array
    {
        $raw = Setting::get('school.programs', '');
        $programs = [];

        if (is_string($raw) && !empty($raw)) {
            $lines = array_filter(explode("\n", $raw));
            foreach ($lines as $line) {
                $parts = explode('|', $line);
                $programs[] = [
                    'name' => trim($parts[0] ?? ''),
                    'icon' => trim($parts[1] ?? 'star'),
                    'desc' => trim($parts[2] ?? ''),
                ];
            }
        }

        return $programs;
    }

    /**
     * Parse values from pipe-delimited format
     */
    private function parseValues(): array
    {
        $raw = Setting::get('school.values', '');
        $values = [];

        if (is_string($raw) && !empty($raw)) {
            $lines = array_filter(explode("\n", $raw));
            foreach ($lines as $line) {
                $parts = explode('|', $line);
                $values[] = [
                    'name' => trim($parts[0] ?? ''),
                    'icon' => trim($parts[1] ?? 'star'),
                    'desc' => trim($parts[2] ?? ''),
                ];
            }
        }

        return $values;
    }

    /**
     * Parse goals from newline-delimited text
     */
    private function parseGoals(): array
    {
        $raw = Setting::get('school.leadership.goals', '');
        $goals = [];

        if (is_string($raw) && !empty($raw)) {
            $goals = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $raw))));
        }

        return $goals;
    }

    /**
     * Get school statistics
     */
    private function getStatistics(): array
    {
        return [
            'siswa' => Pendaftar::diterima()->count(),
            'guru' => Guru::aktif()->count(),
        ];
    }

    public function cekStatusPendaftaran(Request $request)
    {
        $nama = $request->query('nama');

        if (!$nama) {
            return response()->json([
                'success' => false,
                'message' => 'Jeneng siswa kudu dilebokake'
            ]);
        }

        $pendaftar = Pendaftar::where(DB::raw('LOWER(nama_lengkap)'), 'LIKE', '%' . strtolower($nama) . '%')
            ->first();

        if (!$pendaftar) {
            return response()->json([
                'success' => false,
                'message' => 'Data pendaftaran karo jeneng "' . $nama . '" ora ditemokake. Pastikan jeneng sing dilebokake wis bener.'
            ]);
        }

        $statusInfo = [
            'nama' => $pendaftar->nama_lengkap,
            'nomor_pendaftaran' => $pendaftar->nomor_pendaftaran,
            'status' => $pendaftar->status,
            'tanggal_daftar' => $pendaftar->created_at->format('d M Y'),
        ];

        $message = '';

        switch ($pendaftar->status) {
            case 'Diterima':
                $message = "🎉 Sugeng! Pendaftaran sampeyan wis DITERIMA.\n\n" .
                          "📋 Nomor Pendaftaran: {$pendaftar->nomor_pendaftaran}\n" .
                          "👤 Jeneng: {$pendaftar->nama_lengkap}\n" .
                          "📅 Tanggal Pendaftaran: {$pendaftar->created_at->format('d M Y')}\n\n" .
                          "Mangga teka sekolah kanggo ngrampungake administrasi luwih lanjut.";
                break;

            case 'Ditolak':
                $message = "❌ Nyuwun sewu, pendaftaran sampeyan durung bisa ditampa saiki.\n\n" .
                          "📋 Nomor Pendaftaran: {$pendaftar->nomor_pendaftaran}\n" .
                          "👤 Jeneng: {$pendaftar->nama_lengkap}\n" .
                          "📅 Tanggal Pendaftaran: {$pendaftar->created_at->format('d M Y')}\n\n" .
                          "Kanggo informasi luwih lanjut, mangga hubungi pihak sekolah.";
                if ($pendaftar->catatan_admin) {
                    $message .= "\n\n📝 Cathetan: {$pendaftar->catatan_admin}";
                }
                break;

            case 'Menunggu':
            default:
                $message = "⏳ Pendaftaran sampeyan lagi proses verifikasi.\n\n" .
                          "📋 Nomor Pendaftaran: {$pendaftar->nomor_pendaftaran}\n" .
                          "👤 Jeneng: {$pendaftar->nama_lengkap}\n" .
                          "📅 Tanggal Pendaftaran: {$pendaftar->created_at->format('d M Y')}\n\n" .
                          "Nyuwun sabar ngenteni asil verifikasi saka admin sekolah.";
                break;
        }

        return response()->json([
            'success' => true,
            'data' => $statusInfo,
            'message' => $message
        ]);
    }
}

