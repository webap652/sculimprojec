@extends('layouts.app')

@php
    // Dummy data for demonstration if $pengumuman is not passed.
    // In a real scenario, this will be passed from the controller.
    $pengumuman =
        $pengumuman ??
        (object) [
            'judul' => 'Contoh Judul Pengumuman yang Cukup Panjang dan Informatif',
            'isi' =>
                '<h1>Heading 1</h1><p>Ini adalah paragraf pembuka untuk isi pengumuman. Dibuat dengan <strong>teks tebal</strong> dan juga <em>teks miring</em> untuk menyorot informasi penting. Konten ini akan diformat secara otomatis menggunakan kelas `prose` dari Tailwind CSS untuk memastikan keterbacaan yang maksimal.</p><h2>Heading 2</h2><p>Kelas `prose` juga menangani berbagai elemen HTML lainnya dengan sangat baik, seperti daftar:</p><ul><li>Item daftar pertama yang menjelaskan poin penting.</li><li>Item daftar kedua dengan detail tambahan.</li><li>Item daftar ketiga sebagai penutup.</li></ul><blockquote>Ini adalah contoh blockquote yang bisa digunakan untuk mengutip pernyataan penting dari kepala sekolah atau sumber lainnya.</blockquote><p>Paragraf penutup yang memberikan kesimpulan atau langkah selanjutnya bagi pembaca. Terima kasih telah membaca pengumuman ini.</p>',
            'gambar' => 'images/hero-bg/hero bg (2).png', // Example image path
            'tanggal_publish' => now(),
            'created_at' => now(),
            'jenis' => 'Sekolah',
        ];
    $breadcrumb = ['Beranda', 'Pengumuman', Str::limit($pengumuman->judul, 25)];
@endphp

@section('title', $pengumuman->judul . ' - SMP NEGERI 1 PIRIME')

@section('hero')
    <!-- Hero Section Modern dengan Nuansa Hijau -->
    <div class="relative bg-gradient-to-br from-emerald-500 to-teal-600 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-24 text-center">
            <p class="text-sm font-semibold text-emerald-200 uppercase tracking-wider mb-2">Detail Pengumuman</p>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight max-w-4xl mx-auto">
                {{ $pengumuman->judul }}
            </h1>
            <div class="mt-8">
                <!-- Breadcrumb -->
                <nav class="flex justify-center" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ url('/') }}"
                                class="inline-flex items-center text-sm font-medium text-emerald-100 hover:text-white">
                                <i class="fas fa-home mr-2.5"></i>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-emerald-300 text-xs mx-1"></i>
                                <a href="{{ route('pengumuman.index') }}"
                                    class="text-sm font-medium text-emerald-100 hover:text-white">Pengumuman</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-emerald-300 text-xs mx-1"></i>
                                <span class="text-sm font-medium text-white">Detail</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="w-full bg-slate-50 py-12 md:py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Tombol Kembali Elegan -->
            <div class="mb-6">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors group">
                    <i
                        class="fas fa-arrow-left text-xs p-2 bg-white border border-slate-200 rounded-full group-hover:border-blue-300 group-hover:shadow-sm"></i>
                    Kembali ke Daftar Pengumuman
                </a>
            </div>

            <!-- Card Konten Utama -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                <!-- Hero Image (Gambar Utama) -->
                @if ($pengumuman->gambar)
                    <div class="w-full h-56 md:h-80 bg-slate-100">
                        <img src="{{ asset('storage/pengumuman/' . $pengumuman->gambar) }}"
                            alt="Gambar Pengumuman: {{ $pengumuman->judul }}"
                            class="w-full h-full object-cover object-center">
                    </div>
                @endif

                <div class="p-6 md:p-10">
                    <!-- Meta Data Modern -->
                    <div class="flex items-center gap-4 mb-4 text-xs font-medium text-slate-500">
                        <div class="flex items-center gap-1.5">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ ($pengumuman->tanggal_publish ?? $pengumuman->created_at)->format('d F Y') }}</span>
                        </div>
                        @if ($pengumuman->jenis)
                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                            <div class="flex items-center gap-1.5">
                                <i class="far fa-folder-open"></i>
                                <span
                                    class="font-semibold text-blue-600 uppercase tracking-wider">{{ $pengumuman->jenis }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Tipografi Premium (Judul & Isi) -->
                    <h1 class="text-2xl md:text-4xl font-extrabold text-slate-800 leading-tight tracking-tight mb-6">
                        {{ $pengumuman->judul }}
                    </h1>

                    <div
                        class="prose prose-slate max-w-none prose-p:leading-relaxed prose-headings:font-bold prose-headings:text-slate-800 prose-a:text-blue-600 hover:prose-a:text-blue-700 prose-strong:text-slate-700 prose-blockquote:border-l-blue-500 prose-blockquote:bg-blue-50 prose-blockquote:text-slate-700">
                        {!! $pengumuman->isi !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
