@extends('siswa.layout')
@section('title', 'Dashboard Siswa')
@section('pageTitle', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">

        @if ($pendaftar)
            {{-- ===== WELCOME BANNER ===== --}}
            <div
                class="relative bg-gradient-to-r from-indigo-700 via-indigo-600 to-brand-700 rounded-2xl shadow-sm p-6 sm:p-8 overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-72 h-72 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl -translate-x-1/2 translate-y-1/2">
                </div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-5">
                    <div class="flex items-center gap-4">
                        @if ($pendaftar->foto_profil)
                            <div
                                class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden border-4 border-white/30 shadow-xl shrink-0">
                                <img src="{{ asset('storage/' . $pendaftar->foto_profil) }}" alt="Foto Profil"
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div
                                class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white/20 border-4 border-white/30 flex items-center justify-center shrink-0">
                                <i class="fas fa-user text-3xl sm:text-4xl text-white"></i>
                            </div>
                        @endif
                        <div>
                            <p class="text-indigo-100 text-sm font-medium mb-1">Selamat Datang 👋</p>
                            <h1 class="text-xl sm:text-2xl font-extrabold text-white mb-1 leading-tight">
                                {{ $pendaftar->nama_lengkap }}</h1>
                            <p class="text-indigo-100 text-xs sm:text-sm">Nomor Pendaftaran:
                                <span
                                    class="font-bold text-white bg-white/20 px-2 py-0.5 rounded">{{ $pendaftar->nomor_pendaftaran ?? 'Belum ada' }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 shrink-0">
                        <div class="bg-white/10 backdrop-blur rounded-xl px-4 py-2.5 text-center">
                            <div class="text-white font-bold">{{ \Carbon\Carbon::now()->format('d M Y') }}</div>
                            <div class="text-[11px] text-indigo-100">Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== STATUS ALERT ===== --}}
            @if ($pendaftar->status == 'Menunggu' || !$pendaftar->status)
                <div class="flex items-start gap-3 bg-amber-50 border border-amber-200 rounded-2xl p-4 sm:p-5">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-amber-800 text-sm sm:text-base">Pendaftaran Sedang Diproses</h3>
                        <p class="text-amber-700 text-sm mt-1">Data pendaftaran Anda telah tersimpan dan sedang menunggu
                            verifikasi admin. Pastikan semua berkas diupload dengan lengkap.</p>
                    </div>
                </div>
            @elseif($pendaftar->status == 'Diterima')
                <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 rounded-2xl p-4 sm:p-5">
                    <div
                        class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-emerald-800 text-sm sm:text-base">Selamat! Pendaftaran Diterima 🎉</h3>
                        <p class="text-emerald-700 text-sm mt-1">Silakan cetak bukti pendaftaran dan bawa ke sekolah untuk
                            proses pendaftaran ulang.</p>
                    </div>
                </div>
            @elseif($pendaftar->status == 'Ditolak')
                <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 rounded-2xl p-4 sm:p-5">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-rose-800 text-sm sm:text-base">Pendaftaran Ditolak</h3>
                        <p class="text-rose-700 text-sm mt-1">Mohon maaf, pendaftaran Anda tidak dapat diterima. Silakan
                            periksa halaman status untuk informasi lebih lanjut.</p>
                        <a href="{{ route('siswa.status') }}"
                            class="inline-flex items-center mt-3 text-sm font-semibold text-rose-700 hover:text-rose-900">
                            <i class="fas fa-arrow-right mr-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @endif

            {{-- ===== KPI CARDS ===== --}}
            @php
                $berkasFields = ['foto_profil', 'foto', 'kk', 'akte', 'ijazah', 'kartu_nisn'];
                $berkasDone = collect($berkasFields)->filter(fn($f) => $pendaftar->$f)->count();
                $progress = $berkasDone > 0 ? round(($berkasDone / 6) * 100) : 0;
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                {{-- Status --}}
                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between group hover:shadow-md transition-all hover:-translate-y-0.5 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-indigo-50 rounded-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-2">
                            <div
                                class="w-11 h-11 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <span
                                class="text-xs font-bold px-2.5 py-1 rounded-md
                            @if ($pendaftar->status == 'Diterima') bg-emerald-50 text-emerald-600
                            @elseif($pendaftar->status == 'Ditolak') bg-rose-50 text-rose-600
                            @else bg-amber-50 text-amber-600 @endif">
                                {{ $pendaftar->status ?? 'Menunggu' }}
                            </span>
                        </div>
                        <h3 class="text-sm font-medium text-slate-500 mt-4">Status Pendaftaran</h3>
                        <p class="text-2xl font-black text-slate-800 mt-1">
                            @if ($pendaftar->status == 'Diterima')
                                Diterima
                            @elseif($pendaftar->status == 'Ditolak')
                                Ditolak
                            @else
                                Menunggu
                            @endif
                        </p>
                    </div>
                    <a href="{{ route('siswa.status') }}"
                        class="relative z-10 mt-4 inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                        Lihat Detail <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                {{-- Berkas Progress --}}
                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between group hover:shadow-md transition-all hover:-translate-y-0.5 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-emerald-50 rounded-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-2">
                            <div
                                class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                                <i class="fas fa-file-upload"></i>
                            </div>
                            <span
                                class="text-xs font-bold px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-600">{{ $berkasDone }}/6</span>
                        </div>
                        <h3 class="text-sm font-medium text-slate-500 mt-4">Kelengkapan Berkas</h3>
                        <div class="flex items-center gap-3 mt-1">
                            <p class="text-2xl font-black text-slate-800">{{ $progress }}%</p>
                            <div class="flex-1 h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600"
                                    style="width: {{ $progress }}%"></div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('siswa.ppdb.berkas') }}"
                        class="relative z-10 mt-4 inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-800">
                        Kelola Berkas <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                {{-- Info Sekolah --}}
                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between group hover:shadow-md transition-all hover:-translate-y-0.5 relative overflow-hidden sm:col-span-2 lg:col-span-1">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-brand-50 rounded-full"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-2">
                            <div class="w-11 h-11 rounded-xl bg-brand-100 flex items-center justify-center text-brand-700">
                                <i class="fas fa-school"></i>
                            </div>
                        </div>
                        <h3 class="text-sm font-medium text-slate-500 mt-4">Sekolah Asal</h3>
                        <p class="text-xl font-black text-slate-800 mt-1 leading-snug">{{ $pendaftar->nama_sekolah }}</p>
                        <p class="text-xs text-slate-400 mt-1">NISN: {{ $pendaftar->nisn ?? '-' }}</p>
                    </div>
                    <a href="{{ route('siswa.pendaftaran') }}"
                        class="relative z-10 mt-4 inline-flex items-center text-sm font-semibold text-brand-700 hover:text-brand-900">
                        Edit Data <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            {{-- ===== QUICK ACTIONS ===== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Aksi Cepat</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Menu utama untuk mengelola pendaftaran Anda</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 p-6">
                    <a href="{{ route('siswa.pendaftaran') }}"
                        class="group bg-gradient-to-br from-indigo-50 to-indigo-100 border border-indigo-200 rounded-xl p-5 hover:shadow-lg transition-all hover:-translate-y-1">
                        <div
                            class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-lg shadow-indigo-600/20">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm group-hover:text-indigo-700 transition-colors">Edit
                            Pendaftaran</h3>
                        <p class="text-gray-500 text-xs mt-1">Ubah data pendaftaran</p>
                    </a>

                    <a href="{{ route('siswa.ppdb.berkas') }}"
                        class="group bg-gradient-to-br from-emerald-50 to-emerald-100 border border-emerald-200 rounded-xl p-5 hover:shadow-lg transition-all hover:-translate-y-1">
                        <div
                            class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-lg shadow-emerald-600/20">
                            <i class="fas fa-file-upload text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm group-hover:text-emerald-700 transition-colors">Upload
                            Berkas</h3>
                        <p class="text-gray-500 text-xs mt-1">Kelola dokumen</p>
                    </a>

                    <a href="{{ route('siswa.status') }}"
                        class="group bg-gradient-to-br from-amber-50 to-amber-100 border border-amber-200 rounded-xl p-5 hover:shadow-lg transition-all hover:-translate-y-1">
                        <div
                            class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-lg shadow-amber-500/20">
                            <i class="fas fa-clipboard-check text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm group-hover:text-amber-700 transition-colors">Status
                        </h3>
                        <p class="text-gray-500 text-xs mt-1">Pantau progress</p>
                    </a>

                    <a href="{{ route('siswa.cetak') }}"
                        class="group bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-5 hover:shadow-lg transition-all hover:-translate-y-1">
                        <div
                            class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-lg shadow-purple-600/20">
                            <i class="fas fa-print text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm group-hover:text-purple-700 transition-colors">Cetak
                            Bukti</h3>
                        <p class="text-gray-500 text-xs mt-1">Download bukti</p>
                    </a>
                </div>
            </div>

            {{-- ===== BERKAS PROGRESS + INFO ===== --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Berkas checklist --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h2 class="font-bold text-slate-800 mb-4 flex items-center">
                        <i class="fas fa-folder-open text-slate-400 mr-2"></i> Status Berkas
                    </h2>
                    <div class="space-y-3">
                        @php
                            $berkasList = [
                                'foto_profil' => 'Foto Profil',
                                'foto' => 'Pas Foto',
                                'kk' => 'Kartu Keluarga',
                                'akte' => 'Akta Kelahiran',
                                'ijazah' => 'Ijazah',
                                'kartu_nisn' => 'Kartu NISN',
                            ];
                        @endphp
                        @foreach ($berkasList as $field => $label)
                            <div
                                class="flex items-center justify-between p-3 rounded-xl border {{ $pendaftar->$field ? 'border-emerald-200 bg-emerald-50/50' : 'border-slate-200 bg-slate-50' }}">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg flex items-center justify-center {{ $pendaftar->$field ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400' }}">
                                        <i
                                            class="fas {{ $pendaftar->$field ? 'fa-check' : 'fa-circle-xmark' }} text-sm"></i>
                                    </div>
                                    <span
                                        class="text-sm font-medium {{ $pendaftar->$field ? 'text-slate-800' : 'text-slate-500' }}">{{ $label }}</span>
                                </div>
                                <span
                                    class="text-xs font-bold {{ $pendaftar->$field ? 'text-emerald-600' : 'text-slate-400' }}">{{ $pendaftar->$field ? 'Lengkap' : 'Belum' }}</span>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('siswa.ppdb.berkas') }}"
                        class="mt-4 inline-flex items-center justify-center w-full px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors">
                        <i class="fas fa-upload mr-2"></i> Upload Berkas
                    </a>
                </div>

                {{-- Info pendaftaran --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex items-center">
                        <i class="fas fa-user-circle text-slate-400 mr-2"></i>
                        <h2 class="font-bold text-slate-800">Informasi Pendaftaran</h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                        <div class="flex justify-between border-b border-slate-50 pb-3">
                            <span class="text-slate-500 text-sm">Nama Lengkap</span>
                            <span
                                class="font-semibold text-slate-800 text-sm text-right">{{ $pendaftar->nama_lengkap }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-50 pb-3">
                            <span class="text-slate-500 text-sm">NISN</span>
                            <span class="font-semibold text-slate-800 text-sm">{{ $pendaftar->nisn ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-50 pb-3">
                            <span class="text-slate-500 text-sm">Jenis Kelamin</span>
                            <span class="font-semibold text-slate-800 text-sm">{{ $pendaftar->jenis_kelamin }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-50 pb-3">
                            <span class="text-slate-500 text-sm">Sekolah Asal</span>
                            <span
                                class="font-semibold text-slate-800 text-sm text-right">{{ $pendaftar->nama_sekolah }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-50 pb-3">
                            <span class="text-slate-500 text-sm">Tempat Lahir</span>
                            <span class="font-semibold text-slate-800 text-sm">{{ $pendaftar->tempat_lahir }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-50 pb-3">
                            <span class="text-slate-500 text-sm">Tanggal Lahir</span>
                            <span
                                class="font-semibold text-slate-800 text-sm">{{ $pendaftar->tanggal_lahir ? \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d/m/Y') : '-' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-50 pb-3">
                            <span class="text-slate-500 text-sm">No. HP</span>
                            <span class="font-semibold text-slate-800 text-sm">{{ $pendaftar->no_hp_siswa ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-50 pb-3">
                            <span class="text-slate-500 text-sm">Nomor Pendaftaran</span>
                            <span
                                class="font-semibold text-slate-800 text-sm">{{ $pendaftar->nomor_pendaftaran ?? 'Belum ada' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- ===== NO REGISTRATION ===== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 sm:p-12 text-center">
                <div class="mx-auto w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mb-5">
                    <i class="fas fa-clipboard-list text-3xl text-indigo-600"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-800 mb-2">Belum Ada Data Pendaftaran</h2>
                <p class="text-slate-500 max-w-md mx-auto mb-6">Anda belum mengisi formulir pendaftaran PPDB. Lengkapi
                    formulir pendaftaran untuk mulai menggunakan dashboard siswa.</p>
                <a href="{{ route('siswa.pendaftaran') }}"
                    class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transition-all hover:-translate-y-0.5">
                    <i class="fas fa-plus mr-2"></i> Mulai Pendaftaran
                </a>
            </div>

            {{-- Steps info --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-all">
                    <div class="w-14 h-14 mx-auto bg-indigo-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-clipboard-list text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-1">Isi Formulir</h3>
                    <p class="text-slate-500 text-sm">Lengkapi data pribadi dan orang tua</p>
                </div>
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-all">
                    <div class="w-14 h-14 mx-auto bg-emerald-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-file-upload text-emerald-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-1">Upload Berkas</h3>
                    <p class="text-slate-500 text-sm">Upload dokumen persyaratan</p>
                </div>
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-all">
                    <div class="w-14 h-14 mx-auto bg-amber-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-clock text-amber-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-1">Tunggu Verifikasi</h3>
                    <p class="text-slate-500 text-sm">Admin akan memverifikasi data Anda</p>
                </div>
            </div>
        @endif

        {{-- ===== PENGUMUMAN ===== --}}
        @if ($pengumumans->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center mr-3">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-800">Pengumuman Terbaru</h2>
                            <p class="text-xs text-slate-500">Informasi terkini dari sekolah</p>
                        </div>
                    </div>
                    <a href="{{ route('siswa.pengumuman') }}"
                        class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 whitespace-nowrap hidden sm:inline-flex">
                        Lihat Semua <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <div class="divide-y divide-slate-50">
                    @foreach ($pengumumans as $pengumuman)
                        <div class="p-5 flex items-start gap-4 hover:bg-slate-50/60 transition-colors">
                            @if ($pengumuman->gambar)
                                <img src="{{ asset('storage/pengumuman/' . $pengumuman->gambar) }}"
                                    alt="{{ $pengumuman->judul }}"
                                    class="w-16 h-16 object-cover rounded-xl border border-slate-100 shrink-0 hidden sm:block">
                            @else
                                <div
                                    class="w-16 h-16 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 hidden sm:flex">
                                    <i class="fas fa-bullhorn text-slate-400"></i>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold
                                    @if ($pengumuman->jenis == 'penting') bg-rose-100 text-rose-700
                                    @elseif($pengumuman->jenis == 'pengumuman') bg-indigo-100 text-indigo-700
                                    @else bg-emerald-100 text-emerald-700 @endif">
                                        {{ $pengumuman->jenis ?? 'Informasi' }}
                                    </span>
                                    <span class="text-xs text-slate-400">
                                        {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y') : $pengumuman->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-slate-800 text-sm sm:text-base">{{ $pengumuman->judul }}</h3>
                                <p class="text-slate-500 text-sm mt-1 line-clamp-2">
                                    {{ Str::limit($pengumuman->isi, 120) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
