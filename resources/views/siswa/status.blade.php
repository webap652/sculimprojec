@extends('siswa.layout')
@section('title', 'Status Pendaftaran')
@section('pageTitle', 'Status Pendaftaran')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header --}}
        <div
            class="relative bg-gradient-to-r from-indigo-700 via-indigo-600 to-brand-700 rounded-2xl shadow-sm p-6 sm:p-8 overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
            </div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-white">Status Pendaftaran</h1>
                    <p class="text-indigo-100 text-sm">Pantau status pendaftaran PPDB Anda</p>
                </div>
            </div>
        </div>

        @if ($pendaftar)
            {{-- Status Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50">
                    <h2 class="font-bold text-slate-800 flex items-center">
                        <i class="fas fa-info-circle text-slate-400 mr-2"></i> Detail Pendaftaran
                    </h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div class="flex justify-between border-b border-slate-50 pb-3">
                        <span class="text-slate-500 text-sm">Nomor Pendaftaran</span>
                        <span
                            class="font-semibold text-slate-800 text-sm">{{ $pendaftar->nomor_pendaftaran ?? 'Belum ada' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-50 pb-3">
                        <span class="text-slate-500 text-sm">Status</span>
                        <span
                            class="px-3 py-1 rounded-full text-sm font-medium
                        @if ($pendaftar->status == 'Diterima') bg-emerald-100 text-emerald-700
                        @elseif($pendaftar->status == 'Ditolak') bg-rose-100 text-rose-700
                        @else bg-amber-100 text-amber-700 @endif">
                            {{ $pendaftar->status ?? 'Menunggu' }}
                        </span>
                    </div>
                    <div class="flex justify-between border-b border-slate-50 pb-3">
                        <span class="text-slate-500 text-sm">Nama Lengkap</span>
                        <span class="font-semibold text-slate-800 text-sm text-right">{{ $pendaftar->nama_lengkap }}</span>
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
                        <span class="font-semibold text-slate-800 text-sm text-right">{{ $pendaftar->nama_sekolah }}</span>
                    </div>
                </div>

                @if ($pendaftar->catatan_admin)
                    <div class="p-6 border-t border-slate-50 bg-slate-50/60">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Catatan Admin</p>
                        <p class="text-slate-700 text-sm">{{ $pendaftar->catatan_admin }}</p>
                    </div>
                @endif
            </div>

            {{-- Status Notification --}}
            @if ($pendaftar->status == 'Menunggu' || !$pendaftar->status)
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-amber-800">Menunggu Verifikasi Admin</h3>
                            <div class="text-amber-700 text-sm mt-1 space-y-2">
                                <p>Data pendaftaran Anda telah tersimpan dan sedang menunggu verifikasi dari admin. Proses
                                    verifikasi biasanya memakan waktu 1-3 hari kerja.</p>
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Admin akan memverifikasi data dan berkas yang Anda upload</li>
                                    <li>Anda akan menerima notifikasi jika ada perubahan status</li>
                                    <li>Silakan cek status secara berkala atau hubungi admin</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($pendaftar->status == 'Diterima')
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-emerald-800">Selamat! Pendaftaran Diterima 🎉</h3>
                            <p class="text-emerald-700 text-sm mt-1">Pendaftaran Anda telah diterima. Silakan cetak bukti
                                pendaftaran dan bawa ke sekolah untuk proses selanjutnya.</p>
                            <a href="{{ route('siswa.cetak') }}"
                                class="inline-flex items-center mt-4 px-4 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">
                                <i class="fas fa-print mr-2"></i> Cetak Bukti Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($pendaftar->status == 'Ditolak')
                <div class="bg-rose-50 border border-rose-200 rounded-2xl p-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-rose-800">Pendaftaran Ditolak</h3>
                            <p class="text-rose-700 text-sm mt-1">Mohon maaf, pendaftaran Anda tidak dapat diterima. Silakan
                                periksa catatan admin untuk informasi lebih lanjut.</p>
                            <a href="{{ route('siswa.pendaftaran') }}"
                                class="inline-flex items-center mt-4 px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors">
                                <i class="fas fa-edit mr-2"></i> Edit Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('siswa.pendaftaran') }}"
                    class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all hover:-translate-y-0.5 text-center group">
                    <div
                        class="w-12 h-12 mx-auto bg-indigo-100 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-edit text-indigo-600"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Edit Pendaftaran</h3>
                    <p class="text-slate-500 text-xs mt-1">Ubah data pendaftaran Anda</p>
                </a>
                <a href="{{ route('siswa.ppdb.berkas') }}"
                    class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all hover:-translate-y-0.5 text-center group">
                    <div
                        class="w-12 h-12 mx-auto bg-emerald-100 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-file-upload text-emerald-600"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Upload Berkas</h3>
                    <p class="text-slate-500 text-xs mt-1">Kelola berkas persyaratan</p>
                </a>
                <a href="{{ route('siswa.cetak') }}"
                    class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all hover:-translate-y-0.5 text-center group">
                    <div
                        class="w-12 h-12 mx-auto bg-purple-100 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-print text-purple-600"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Cetak Bukti</h3>
                    <p class="text-slate-500 text-xs mt-1">Download bukti pendaftaran</p>
                </a>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 text-center">
                <div class="mx-auto w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-amber-600"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Data Pendaftaran</h3>
                <p class="text-slate-500 text-sm mb-5">Anda belum mengisi formulir pendaftaran PPDB. Silakan lengkapi
                    formulir pendaftaran terlebih dahulu.</p>
                <a href="{{ route('siswa.pendaftaran') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Isi Formulir Pendaftaran
                </a>
            </div>
        @endif
    </div>
@endsection
