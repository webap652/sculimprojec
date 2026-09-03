@extends('layouts.app')

@section('title', 'Beranda - ' . ($schoolName ?? 'SMP NEGERI 1 PIRIME'))

@section('hero')
    @php
        use App\Models\Setting;
        $heroTitle = Setting::get(
            'school.hero.title',
            'MEMBANGUN GENERASI <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-400 to-amber-300">EMAS LANNY JAYA</span>',
        );
        $heroSubtitle = Setting::get(
            'school.hero.subtitle',
            'Mewujudkan peserta didik yang Beriman, Berilmu, Berkarakter, dan Peduli Lingkungan demi kemajuan bangsa dan budaya lokal.',
        );
        $heroButton = Setting::get('school.hero.button_text', 'Daftar PPDB');
        $heroButtonUrl = Setting::get('school.hero.button_url', route('register.form'));
        $heroButton2 = Setting::get('school.hero.button_2_text', 'Visi & Misi Kami');
        $heroButton2Url = Setting::get('school.hero.button_2_url', route('profil.visi-misi'));
        $heroBg = asset('images/hero-bg/hero bg (2).png');
        $heroTag = Setting::get('school.hero.tag', 'Selamat Datang di Website');

        $pengumumans = $pengumumans ?? collect();
        $statistics = [
            'guru' => \App\Models\Guru::aktif()->count(),
            'siswa' => \App\Models\Pendaftar::diterima()->count(),
            'kelas' => Setting::get('school.statistics.jumlah_kelas', '9'),
            'prestasi' => \App\Models\Prestasi::aktif()->count(),
            'fasilitas' => \App\Models\Fasilitas::aktif()->count(),
            'galeri' => \App\Models\Galeri::aktif()->count() ?: '45',
            'pengumuman' => \App\Models\Pengumuman::aktif()->count() ?: '30',
        ];

        $galeris = \App\Models\Galeri::aktif()->latest()->take(4)->get();
    @endphp

    <section class="relative bg-primary-950 overflow-hidden pb-10 md:pb-16 min-h-[520px] flex items-center">
        {{-- Background Image Full Coverage --}}
        <div class="absolute inset-0 z-0">
            <img class="h-full w-full object-cover object-center" src="{{ $heroBg }}"
                onerror="this.src='https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop'"
                alt="{{ $schoolName ?? 'SMP Negeri 1 Pirime' }}">
            {{-- Navy premium overlay --}}
            <div
                class="absolute inset-0 bg-gradient-to-r from-primary-950/95 via-primary-900/85 to-primary-800/50 sm:via-primary-900/70">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-primary-950/60 via-transparent to-transparent"></div>
        </div>

        <style>
            @keyframes heroFloatUpDown {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-18px);
                }
            }

            .hero-float-updown {
                animation: heroFloatUpDown 3.6s ease-in-out infinite;
                will-change: transform;
            }

            @keyframes heroFadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(24px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .hero-fade-in-up {
                opacity: 0;
                animation: heroFadeInUp 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            }
        </style>

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-16 pb-10 md:pt-24 md:pb-20 lg:pt-28 lg:pb-28 w-full">
            <div class="max-w-2xl">
                <div class="mb-3">
                    <p class="text-sm sm:text-base font-semibold text-gold-400 bg-white/10 border border-white/20 backdrop-blur-sm inline-flex items-center px-4 py-2 rounded-full shadow-sm hero-fade-in-up"
                        style="animation-delay: 0.1s;">
                        <i class="fas fa-hand-holding-heart mr-2 text-gold-400"></i>
                        {{ $heroTag }}
                    </p>
                </div>

                <h5 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white drop-shadow-lg leading-tight mb-4 hero-fade-in-up"
                    style="animation-delay: 0.2s;">
                    {!! $heroTitle !!}
                </h5>
                <p class="text-base sm:text-lg text-slate-200 mb-10 max-w-lg leading-relaxed hero-fade-in-up"
                    style="animation-delay: 0.3s;">
                    {{ $heroSubtitle }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 hero-fade-in-up" style="animation-delay: 0.4s;">
                    <a href="{{ $heroButtonUrl }}"
                        class="bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-600 hover:to-gold-700 text-primary-900 px-8 py-4 rounded-full font-bold flex items-center justify-center transition-all shadow-lg shadow-gold-500/30 hover:-translate-y-1">
                        <i
                            class="fas {{ Str::contains($heroButtonUrl, 'register') ? 'fa-user-plus' : 'fa-arrow-right' }} mr-2"></i>
                        {{ $heroButton }}
                    </a>
                    <a href="{{ $heroButton2Url }}"
                        class="bg-white/10 hover:bg-white/20 text-white border border-white/30 hover:border-gold-400 backdrop-blur-sm px-8 py-4 rounded-full font-bold flex items-center justify-center transition-all hover:-translate-y-1">
                        <i class="far fa-eye mr-2 text-gold-400"></i> {{ $heroButton2 }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <main id="main-content">

        <!-- Floating Stats Cards -->
        <div class="relative z-20 px-4 sm:px-6 lg:px-8 -mt-12 md:-mt-16 max-w-7xl mx-auto mb-16">
            <div class="bg-primary-900 rounded-2xl shadow-2xl p-6 md:p-8 text-white border border-primary-700">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center hover-lift">
                        <div class="text-3xl md:text-4xl font-extrabold text-accent-500"><span class="counter"
                                data-target="{{ $statistics['siswa'] }}">0</span></div>
                        <p class="text-xs text-blue-200 mt-1 uppercase tracking-wider">Siswa</p>
                    </div>
                    <div class="text-center hover-lift">
                        <div class="text-3xl md:text-4xl font-extrabold text-accent-500"><span class="counter"
                                data-target="{{ $statistics['guru'] }}">0</span></div>
                        <p class="text-xs text-blue-200 mt-1 uppercase tracking-wider">Guru & Staff</p>
                    </div>
                    <div class="text-center hover-lift">
                        <div class="text-3xl md:text-4xl font-extrabold text-accent-500"><span class="counter"
                                data-target="{{ $statistics['prestasi'] }}">0</span></div>
                        <p class="text-xs text-blue-200 mt-1 uppercase tracking-wider">Prestasi</p>
                    </div>
                    <div class="text-center hover-lift">
                        <div class="text-3xl md:text-4xl font-extrabold text-accent-500"><span class="counter"
                                data-target="{{ $statistics['fasilitas'] }}">0</span></div>
                        <p class="text-xs text-blue-200 mt-1 uppercase tracking-wider">Fasilitas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Home Info Sections -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Column 1: Pengumuman -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col h-full hover:shadow-md transition">
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center">
                            <i class="fas fa-bullhorn text-primary-600 mr-2"></i> Pengumuman
                        </h2>
                        <a href="{{ route('pengumuman') }}"
                            class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
                    </div>
                    <div class="flex-1 space-y-6">
                        @forelse($pengumumans as $pengumuman)
                            <div class="flex space-x-4 group cursor-pointer"
                                onclick="window.location.href='{{ route('pengumuman') }}'">
                                <div
                                    class="flex-shrink-0 w-14 h-16 bg-blue-50 rounded-lg flex flex-col items-center justify-center border border-blue-100 group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                                    <span
                                        class="text-xl font-bold text-primary-600 group-hover:text-white leading-none">{{ optional($pengumuman->tanggal_publish ?? $pengumuman->created_at)->format('d') ?? '01' }}</span>
                                    <span
                                        class="text-xs font-semibold text-gray-500 group-hover:text-blue-100 uppercase mt-1">{{ optional($pengumuman->tanggal_publish ?? $pengumuman->created_at)->format('M') ?? 'JAN' }}</span>
                                </div>
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 mb-1 group-hover:text-primary-600 transition-colors">
                                        {{ $pengumuman->judul }}</h3>
                                    <p class="text-sm text-gray-500 line-clamp-2">
                                        {{ $pengumuman->isi ? Str::limit(strip_tags($pengumuman->isi), 90) : '' }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fas fa-inbox text-4xl text-slate-300 mb-3"></i>
                                <p class="text-slate-500 text-sm">Belum ada pengumuman</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Column 2: Galeri -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col h-full hover:shadow-md transition">
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center">
                            <i class="far fa-images text-primary-600 mr-2"></i> Galeri
                        </h2>
                        <a href="{{ route('galeri') }}"
                            class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
                    </div>
                    <div class="grid grid-cols-2 gap-3 flex-1 content-start cursor-pointer"
                        onclick="window.location.href='{{ route('galeri') }}'">
                        @forelse($galeris as $g)
                            <div class="rounded-xl overflow-hidden aspect-[4/3] relative group">
                                <img src="{{ asset('storage/' . $g->gambar) }}"
                                    onerror="this.src='https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=300'"
                                    class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                                    loading="lazy" alt="{{ $g->judul }}">
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-8 text-slate-500">
                                <i class="far fa-images text-4xl text-slate-300 mb-3"></i>
                                <p class="text-sm">Belum ada galeri</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Column 3: Banner PPDB -->
                <div
                    class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl shadow-lg relative overflow-hidden flex flex-col h-full min-h-[300px] hover-lift">
                    <div
                        class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=800')] opacity-20 mix-blend-overlay bg-cover bg-center">
                    </div>
                    <div class="relative z-10 p-8 flex flex-col h-full text-white justify-between">
                        <div>
                            <span
                                class="bg-accent-500 text-white font-bold text-xs uppercase px-3 py-1 rounded-full mb-3 inline-block shadow-sm">Generasi
                                Emas</span>
                            <h2 class="text-2xl font-black mb-2 mt-2 leading-tight text-white">Bergabung Bersama Kami</h2>
                            <p class="text-blue-100 text-sm leading-relaxed mb-6">Mempersiapkan generasi muda yang mandiri,
                                berkarakter, dan mampu menghadapi tantangan masa depan.</p>
                        </div>
                        <a href="{{ route('register.form') }}"
                            class="w-full bg-white hover:bg-blue-50 text-primary-700 px-6 py-4 rounded-xl font-bold text-center transition flex justify-center items-center group shadow-md">
                            <i class="fas fa-user-plus mr-2"></i> Daftar PPDB
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
