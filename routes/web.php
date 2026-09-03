<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Https\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\GaleriController;
/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK (Dengan middleware maintenance)
|--------------------------------------------------------------------------
*/

Route::middleware('maintenance')->group(function () {

    // Halaman Home
    Route::get('/', [PPDBController::class, 'home'])->name('home');

    // Profil Sekolah
    Route::get('/profil', [PPDBController::class, 'profil'])->name('profil');

    // Submenu Profil
    Route::get('/profil/visi-misi', [PPDBController::class, 'visiMisi'])->name('profil.visi-misi');
    Route::get('/profil/sambutan-kepala-sekolah', [PPDBController::class, 'sambutan'])->name('profil.sambutan');
    Route::get('/profil/sejarah', [PPDBController::class, 'sejarah'])->name('profil.sejarah');
    Route::get('/profil/struktur-organisasi', [PPDBController::class, 'strukturOrganisasi'])->name('profil.struktur');
    Route::get('/profil/guru-staff', [PPDBController::class, 'guruStaff'])->name('profil.guru-staff');
    Route::get('/profil/fasilitas', [PPDBController::class, 'fasilitas'])->name('profil.fasilitas');
    Route::get('/profil/prestasi', [PPDBController::class, 'prestasi'])->name('profil.prestasi');

    // Kesiswaan
    Route::get('/kesiswaan', [PPDBController::class, 'kesiswaan'])->name('kesiswaan');

    // Berita (Pengumuman)
    Route::get('/berita', [PPDBController::class, 'pengumuman'])->name('berita');
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.show');
    Route::get('/pengumuman/download/{file}', [PengumumanController::class, 'download'])->name('pengumuman.download');
    // Galeri
    Route::get('/galeri', [PPDBController::class, 'galeri'])->name('galeri');

    // Kontak
    Route::get('/kontak', [PPDBController::class, 'kontak'])->name('kontak');

    // Guru
    Route::get('/guru', [PPDBController::class, 'guru'])->name('guru');

    // PPDB
    Route::get('/ppdb', [PPDBController::class, 'ppdb'])->name('ppdb');
});


/*
|--------------------------------------------------------------------------
| AUTH (Login, Register, Logout)
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD SISWA
|--------------------------------------------------------------------------
*/

// Halaman pendaftaran boleh diakses oleh siswa meskipun belum memiliki data pendaftaran
Route::middleware(['auth', 'role:siswa'])->group(function () {

    Route::get('/siswa/pendaftaran', [SiswaController::class, 'formPendaftaran'])
        ->name('siswa.pendaftaran');

    Route::post('/siswa/pendaftaran/simpan', [SiswaController::class, 'simpanPendaftaran'])
        ->name('siswa.pendaftaran.simpan');
});

// Halaman lain hanya bisa diakses setelah siswa mengisi formulir pendaftaran
Route::middleware(['auth', 'role:siswa', 'cek.pendaftar'])->group(function () {

    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])
        ->name('siswa.dashboard');

    Route::get('/siswa/ppdb/berkas', [SiswaController::class, 'berkas'])
        ->name('siswa.ppdb.berkas');

    Route::post('/siswa/ppdb/berkas/upload', [SiswaController::class, 'uploadBerkas'])
        ->name('siswa.ppdb.berkas.upload');

    Route::get('/siswa/pengumuman', [SiswaController::class, 'pengumuman'])
        ->name('siswa.pengumuman');

    Route::get('/siswa/status', [SiswaController::class, 'status'])
        ->name('siswa.status');

    Route::get('/siswa/cetak', [SiswaController::class, 'cetakPdf'])
        ->name('siswa.cetak');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard-admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // System Settings
    Route::get('/admin/system-settings', [\App\Http\Controllers\Admin\SystemSettingsController::class, 'edit'])
        ->name('admin.system-settings.edit');
    Route::put('/admin/system-settings', [\App\Http\Controllers\Admin\SystemSettingsController::class, 'update'])
        ->name('admin.system-settings.update');

    // Guru CRUD
    Route::get('/admin/guru', [\App\Http\Controllers\Admin\GuruController::class, 'index'])
        ->name('admin.guru.index');
    Route::get('/admin/guru/create', [\App\Http\Controllers\Admin\GuruController::class, 'create'])
        ->name('admin.guru.create');
    Route::post('/admin/guru', [\App\Http\Controllers\Admin\GuruController::class, 'store'])
        ->name('admin.guru.store');
    Route::get('/admin/guru/{guru}/edit', [\App\Http\Controllers\Admin\GuruController::class, 'edit'])
        ->name('admin.guru.edit');
    Route::put('/admin/guru/{guru}', [\App\Http\Controllers\Admin\GuruController::class, 'update'])
        ->name('admin.guru.update');
    Route::delete('/admin/guru/{guru}', [\App\Http\Controllers\Admin\GuruController::class, 'destroy'])
        ->name('admin.guru.destroy');
    Route::post('/admin/guru/{guru}/toggle', [\App\Http\Controllers\Admin\GuruController::class, 'toggle'])
        ->name('admin.guru.toggle');

    // Fasilitas CRUD
    Route::get('/admin/fasilitas', [\App\Http\Controllers\Admin\FasilitasController::class, 'index'])
        ->name('admin.fasilitas.index');
    Route::get('/admin/fasilitas/create', [\App\Http\Controllers\Admin\FasilitasController::class, 'create'])
        ->name('admin.fasilitas.create');
    Route::post('/admin/fasilitas', [\App\Http\Controllers\Admin\FasilitasController::class, 'store'])
        ->name('admin.fasilitas.store');
    Route::get('/admin/fasilitas/{fasilitas}/edit', [\App\Http\Controllers\Admin\FasilitasController::class, 'edit'])
        ->name('admin.fasilitas.edit');
    Route::put('/admin/fasilitas/{fasilitas}', [\App\Http\Controllers\Admin\FasilitasController::class, 'update'])
        ->name('admin.fasilitas.update');
    Route::delete('/admin/fasilitas/{fasilitas}', [\App\Http\Controllers\Admin\FasilitasController::class, 'destroy'])
        ->name('admin.fasilitas.destroy');

    // Prestasi CRUD
    Route::get('/admin/prestasi', [\App\Http\Controllers\Admin\PrestasiController::class, 'index'])
        ->name('admin.prestasi.index');
    Route::get('/admin/prestasi/create', [\App\Http\Controllers\Admin\PrestasiController::class, 'create'])
        ->name('admin.prestasi.create');
    Route::post('/admin/prestasi', [\App\Http\Controllers\Admin\PrestasiController::class, 'store'])
        ->name('admin.prestasi.store');
    Route::get('/admin/prestasi/{prestasi}/edit', [\App\Http\Controllers\Admin\PrestasiController::class, 'edit'])
        ->name('admin.prestasi.edit');
    Route::put('/admin/prestasi/{prestasi}', [\App\Http\Controllers\Admin\PrestasiController::class, 'update'])
        ->name('admin.prestasi.update');
    Route::delete('/admin/prestasi/{prestasi}', [\App\Http\Controllers\Admin\PrestasiController::class, 'destroy'])
        ->name('admin.prestasi.destroy');

    // Sejarah CRUD
    Route::get('/admin/sejarah', [\App\Http\Controllers\Admin\SejarahController::class, 'index'])
        ->name('admin.sejarah.index');
    Route::get('/admin/sejarah/create', [\App\Http\Controllers\Admin\SejarahController::class, 'create'])
        ->name('admin.sejarah.create');
    Route::post('/admin/sejarah', [\App\Http\Controllers\Admin\SejarahController::class, 'store'])
        ->name('admin.sejarah.store');
    Route::get('/admin/sejarah/{sejarah}/edit', [\App\Http\Controllers\Admin\SejarahController::class, 'edit'])
        ->name('admin.sejarah.edit');
    Route::put('/admin/sejarah/{sejarah}', [\App\Http\Controllers\Admin\SejarahController::class, 'update'])
        ->name('admin.sejarah.update');
    Route::delete('/admin/sejarah/{sejarah}', [\App\Http\Controllers\Admin\SejarahController::class, 'destroy'])
        ->name('admin.sejarah.destroy');

    // Struktur Organisasi CRUD
    Route::get('/admin/struktur-organisasi', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'index'])
        ->name('admin.struktur-organisasi.index');
    Route::get('/admin/struktur-organisasi/create', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'create'])
        ->name('admin.struktur-organisasi.create');
    Route::post('/admin/struktur-organisasi', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'store'])
        ->name('admin.struktur-organisasi.store');
    Route::get('/admin/struktur-organisasi/{strukturOrganisasi}/edit', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'edit'])
        ->name('admin.struktur-organisasi.edit');
    Route::put('/admin/struktur-organisasi/{strukturOrganisasi}', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'update'])
        ->name('admin.struktur-organisasi.update');
    Route::delete('/admin/struktur-organisasi/{strukturOrganisasi}', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'destroy'])
        ->name('admin.struktur-organisasi.destroy');
    Route::post('/admin/struktur-organisasi/{strukturOrganisasi}/toggle', [\App\Http\Controllers\Admin\StrukturOrganisasiController::class, 'toggle'])
        ->name('admin.struktur-organisasi.toggle');

    // Galeri CRUD
    Route::get('/admin/galeri', [\App\Http\Controllers\Admin\GaleriController::class, 'index'])
        ->name('admin.galeri.index');
    Route::get('/admin/galeri/create', [\App\Http\Controllers\Admin\GaleriController::class, 'create'])
        ->name('admin.galeri.create');
    Route::post('/admin/galeri', [\App\Http\Controllers\Admin\GaleriController::class, 'store'])
        ->name('admin.galeri.store');
    Route::get('/admin/galeri/{galeri}/edit', [\App\Http\Controllers\Admin\GaleriController::class, 'edit'])
        ->name('admin.galeri.edit');
    Route::put('/admin/galeri/{galeri}', [\App\Http\Controllers\Admin\GaleriController::class, 'update'])
        ->name('admin.galeri.update');
    Route::delete('/admin/galeri/{galeri}', [\App\Http\Controllers\Admin\GaleriController::class, 'destroy'])
        ->name('admin.galeri.destroy');

    // Semua data pendaftar
    Route::get('/admin/pendaftar', [AdminController::class, 'pendaftar'])
        ->name('admin.pendaftar');

    // Detail pendaftar
    Route::get('/admin/detail/{id}', [AdminController::class, 'detailPendaftar'])
        ->name('admin.detail');

    // Verifikasi data
    Route::post('/admin/verifikasi/{id}', [AdminController::class, 'verifikasi'])
        ->name('admin.verifikasi');

    // Menu lain (opsional)
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])
        ->name('admin.laporan');

    // Pengumuman Management
    Route::get('/admin/pengumuman', [AdminController::class, 'pengumuman'])
        ->name('admin.pengumuman');
    Route::get('/admin/pengumuman/buat', [AdminController::class, 'buatPengumuman'])
        ->name('admin.pengumuman.buat');
    Route::post('/admin/pengumuman/simpan', [AdminController::class, 'simpanPengumuman'])
        ->name('admin.pengumuman.simpan');
    Route::get('/admin/pengumuman/edit/{id}', [AdminController::class, 'editPengumuman'])
        ->name('admin.pengumuman.edit');
    Route::put('/admin/pengumuman/update/{id}', [AdminController::class, 'updatePengumuman'])
        ->name('admin.pengumuman.update');
    Route::delete('/admin/pengumuman/hapus/{id}', [AdminController::class, 'hapusPengumuman'])
        ->name('admin.pengumuman.hapus');
    Route::post('/admin/pengumuman/toggle/{id}', [AdminController::class, 'togglePengumuman'])
        ->name('admin.pengumuman.toggle');
});

// API Routes for Chatbot
Route::prefix('api')->group(function () {
    Route::get('/cek-status-pendaftaran', [PPDBController::class, 'cekStatusPendaftaran'])
        ->name('api.cek-status-pendaftaran');
});


