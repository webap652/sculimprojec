@extends('layouts.app')

@section('title', 'Pengumuman - SMP NEGERI 1 PIRIME')

@section('hero')
    @php
        $breadcrumb = ['Beranda', 'Pengumuman'];
    @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'PENGUMUMAN',
        'desc' => 'Pusat informasi resmi SMP Negeri 1 Pirime.',
        'bg' => '', // Dikosongkan agar tidak ada gambar background bertumpuk
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    <style>
        /* Custom Scrollbar Minimalis */
        .custom-scroll::-webkit-scrollbar { height: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        
        /* Tab Navigation Minimalis */
        #pengumumanTabs .nav-link {
            color: #64748b;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.75rem 1.5rem;
            border-bottom: 2px solid transparent;
            border-radius: 0;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        #pengumumanTabs .nav-link:hover {
            color: #3b82f6;
            border-bottom-color: #cbd5e1;
        }
        #pengumumanTabs .nav-link.active {
            color: #2563eb !important;
            background: transparent !important;
            border-bottom-color: #2563eb !important;
        }
    </style>

    <div class="w-full bg-slate-50 pb-16">
        
        <!-- Hero Section Clean & Minimalist -->
        <div class="bg-white border-b border-slate-200 pt-16 pb-12 px-6">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 tracking-tight mb-4">
                    Pusat Informasi & Pengumuman
                </h1>
                <p class="text-slate-500 max-w-2xl mx-auto text-base md:text-lg mb-8">
                    Temukan semua pengumuman resmi, agenda kegiatan, dan jadwal penting sekolah dengan mudah dan cepat.
                </p>

                <!-- Search Box Clean -->
                <div class="max-w-xl mx-auto relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="searchPengumuman" placeholder="Cari pengumuman..."
                        class="w-full py-3.5 pl-12 pr-4 bg-slate-50 border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl text-slate-700 placeholder-slate-400 outline-none transition-all"
                        onkeyup="filterPengumuman(this.value)">
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Kiri: Konten Pengumuman -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                        
                        <!-- Tabs -->
                        <div class="border-b border-slate-100 bg-white px-2">
                            <ul class="nav nav-pills flex flex-nowrap overflow-x-auto custom-scroll" id="pengumumanTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="tab-sekolah" data-bs-toggle="pill" data-bs-target="#pane-sekolah" type="button" role="tab">Sekolah</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab-ppdb" data-bs-toggle="pill" data-bs-target="#pane-ppdb" type="button" role="tab">PPDB</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab-agenda" data-bs-toggle="pill" data-bs-target="#pane-agenda" type="button" role="tab">Agenda</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab-jadwal" data-bs-toggle="pill" data-bs-target="#pane-jadwal" type="button" role="tab">Jadwal Ujian</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab-download" data-bs-toggle="pill" data-bs-target="#pane-download" type="button" role="tab">Unduhan</button>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div class="p-6">
                            <div class="tab-content" id="pengumumanTabContent">
                                <div class="tab-pane fade show active" id="pane-sekolah" role="tabpanel">
                                    @include('pengumuman._list', ['items' => $sekolahPengumuman])
                                </div>
                                <div class="tab-pane fade" id="pane-ppdb" role="tabpanel">
                                    @include('pengumuman._list', ['items' => $ppdbPengumuman])
                                </div>
                                <div class="tab-pane fade" id="pane-agenda" role="tabpanel">
                                    @include('pengumuman._list', ['items' => $agenda])
                                </div>
                                <div class="tab-pane fade" id="pane-jadwal" role="tabpanel">
                                    @include('pengumuman._list', ['items' => $jadwalUjian])
                                </div>
                                <div class="tab-pane fade" id="pane-download" role="tabpanel">
                                    @include('pengumuman._download', [
                                        'items' => $sekolahPengumuman->concat($ppdbPengumuman)->concat($agenda)->concat($jadwalUjian),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Sidebar Clean -->
                <div class="space-y-6">
                    
                    <!-- Pengumuman Penting Minimalis -->
                    @php $pengumumanPenting = $agenda->first(); @endphp
                    <div class="bg-red-50 rounded-2xl p-6 border border-red-100">
                        <div class="flex items-center gap-2 mb-3 text-red-600 font-bold text-sm uppercase tracking-wide">
                            <i class="fa-solid fa-circle-exclamation"></i> Info Penting
                        </div>
                        <h3 class="font-bold text-slate-800 text-lg mb-2 leading-tight">
                            {{ $pengumumanPenting ? $pengumumanPenting->judul : 'Belum ada info penting' }}
                        </h3>
                        <p class="text-sm text-slate-600 mb-4 line-clamp-3">
                            {{ $pengumumanPenting ? Str::limit(strip_tags($pengumumanPenting->isi), 100) : 'Saat ini belum ada pengumuman darurat atau penting.' }}
                        </p>
                        <a href="{{ $pengumumanPenting ? '#' : '/ppdb' }}" class="text-red-600 font-semibold text-sm hover:underline flex items-center gap-1">
                            Baca selengkapnya <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>

                    <!-- Agenda Terbaru -->
                    @if ($agenda->count() > 0)
                        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                            <h3 class="font-bold text-slate-800 mb-4">Agenda Mendatang</h3>
                            <div class="space-y-4">
                                @foreach ($agenda->take(4) as $a)
                                    <div class="flex items-start gap-3 pb-4 border-b border-slate-50 last:border-0 last:pb-0">
                                        <div class="bg-slate-50 text-slate-600 rounded-lg p-2 text-center min-w-[3rem] border border-slate-100">
                                            <div class="text-sm font-bold">{{ optional($a->tanggal_publish)->format('d') ?: '01' }}</div>
                                            <div class="text-[10px] uppercase">{{ optional($a->tanggal_publish)->format('M') ?: 'JAN' }}</div>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-semibold text-slate-800 line-clamp-1">{{ $a->judul }}</h4>
                                            <span class="text-[11px] text-slate-500">{{ ucfirst($a->jenis) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection