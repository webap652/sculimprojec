@extends('layouts.app')

@section('title', 'Fasilitas - SMP NEGERI 1 PIRIME')
@section('description', 'Fasilitas dan sarana prasarana SMP Negeri 1 Pirime.')

@section('hero')
    @php $breadcrumb = ['Beranda', 'Profil', 'Fasilitas']; @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'FASILITAS',
        'desc' => 'Sarana dan prasarana pendukung kegiatan belajar mengajar di SMP Negeri 1 Pirime.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @include('profil.partials.sidebar')

        @if ($fasilitasList->count() > 0)
            @foreach ($fasilitasList as $kategori => $items)
                <section class="mb-10" data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center text-primary-600">
                            @php
                                $icons = [
                                    'ruang_kelas' => 'fa-chalkboard',
                                    'perpustakaan' => 'fa-book',
                                    'laboratorium' => 'fa-flask',
                                    'lapangan' => 'fa-futbol',
                                    'toilet' => 'fa-toilet',
                                    'uks' => 'fa-heartbeat',
                                    'ruang_guru' => 'fa-users',
                                    'kantor' => 'fa-building',
                                    'internet' => 'fa-wifi',
                                    'air_bersih' => 'fa-water',
                                    'listrik' => 'fa-bolt',
                                    'ibadah' => 'fa-pray',
                                    'lainnya' => 'fa-circle',
                                ];
                            @endphp
                            <i class="fas {{ $icons[$kategori] ?? 'fa-circle' }} text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">{{ $kategoriList[$kategori] ?? $kategori }}</h3>
                            <div class="w-12 h-0.5 bg-primary-500 rounded-full mt-1"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($items as $fasil)
                            <div
                                class="group bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <div
                                    class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary-600 to-gold-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                @if ($fasil->foto)
                                    <div class="h-40 overflow-hidden">
                                        <img src="{{ asset('storage/' . $fasil->foto) }}" alt="{{ $fasil->nama }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                            loading="lazy">
                                    </div>
                                @else
                                    <div
                                        class="h-40 bg-gradient-to-br from-primary-50 to-blue-50 flex items-center justify-center">
                                        <div
                                            class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center text-primary-600">
                                            <i class="fas {{ $icons[$kategori] ?? 'fa-building' }} text-2xl"></i>
                                        </div>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h4 class="font-bold text-primary-900">{{ $fasil->nama }}</h4>
                                    @if ($fasil->deskripsi)
                                        <p class="text-xs text-slate-500 mt-1">{{ $fasil->deskripsi }}</p>
                                    @endif
                                    <div class="mt-3 flex items-center justify-between">
                                        <span class="text-sm font-semibold text-slate-600"><i
                                                class="fas fa-cubes mr-1 text-gold-500"></i> {{ $fasil->jumlah }}</span>
                                        <span
                                            class="px-2 py-0.5 rounded-full text-xs font-medium {{ $fasil->status == 'Baik' ? 'bg-emerald-100 text-emerald-700' : ($fasil->status == 'Rusak Ringan' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">{{ $fasil->status }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center" data-aos="fade-up">
                <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 flex items-center justify-center mb-4">
                    <i class="fas fa-building text-3xl text-slate-400"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-600">Data Fasilitas Belum Tersedia</h3>
                <p class="text-slate-400 mt-2">Admin sekolah akan segera melengkapi informasi fasilitas sekolah.</p>
            </div>
        @endif
    </div>
@endsection
