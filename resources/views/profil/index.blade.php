@extends('layouts.app')

@section('title', 'Profil Sekolah - SMP NEGERI 1 PIRIME')
@section('description',
    'Informasi lengkap SMP Negeri 1 Pirime: identitas sekolah, visi misi, program unggulan,
    statistik, dan lokasi.')

@section('hero')
    @php
        $breadcrumb = ['Beranda', 'Profil', 'Profil Sekolah'];
    @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'PROFIL SEKOLAH',
        'desc' =>
            'Mengenal lebih dekat SMP Negeri 1 Pirime: identitas, visi, misi, tujuan, program unggulan, dan statistik sekolah.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    @php
        $navy = '#0A2540';
        $gold = '#D4AF37';
    @endphp

    <div class="bg-[#F5F7FA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- Sub Navigation Horizontal --}}
            @include('profil.partials.sidebar')

            {{-- Section Heading --}}
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10" data-aos="fade-up">
                <div>
                    <div class="inline-flex items-center gap-2 font-semibold text-sm uppercase tracking-widest mb-2"
                        style="color: {{ $gold }}">
                        <span class="w-10 h-0.5 rounded-full" style="background: {{ $gold }}"></span>
                        Tentang Kami
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0A2540]">Profil SMP Negeri 1 Pirime</h2>
                    <p class="text-slate-500 mt-3 max-w-2xl leading-relaxed">
                        Mengenal lebih dekat identitas, visi, misi, tujuan, serta program unggulan sekolah kami.
                    </p>
                </div>
                <div
                    class="hidden md:flex items-center gap-3 bg-white rounded-2xl shadow-sm px-5 py-3 border border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-[#0A2540] text-white flex items-center justify-center">
                        <i class="fas fa-medal" style="color: {{ $gold }}"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-extrabold text-[#0A2540]">{{ $data['akreditasi'] }}</div>
                        <div class="text-xs text-slate-500">Akreditasi</div>
                    </div>
                </div>
            </div>

            {{-- Tentang Sekolah --}}
            <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 mb-8" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-[#0A2540] text-white flex items-center justify-center">
                        <i class="fas fa-info-circle" style="color: {{ $gold }}"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-[#0A2540]">Tentang SMP Negeri 1 Pirime</h2>
                        <div class="w-16 h-1 rounded-full mt-2" style="background: {{ $gold }}"></div>
                    </div>
                </div>
                <p class="text-slate-600 leading-relaxed text-base sm:text-lg">
                    {{ $data['nama'] }} merupakan sekolah menengah pertama yang berlokasi di
                    <strong>{{ $data['alamat'] }}</strong>,
                    {{ $data['kabupaten'] }}, {{ $data['provinsi'] }}. Berdiri sejak tahun
                    <strong>{{ $data['tahun_berdiri'] }}</strong>,
                    sekolah ini telah berkomitmen untuk mencetak generasi muda yang beriman, berilmu, berkarakter, dan
                    peduli lingkungan.
                </p>
            </section>

            {{-- Identitas Sekolah --}}
            <section class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8" data-aos="fade-up">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-[#0A2540] text-white flex items-center justify-center">
                            <i class="fas fa-id-card" style="color: {{ $gold }}"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-[#0A2540]">Identitas Sekolah</h2>
                            <div class="w-16 h-1 rounded-full mt-2" style="background: {{ $gold }}"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 lg:gap-4">
                        @php
                            $identitas = [
                                ['label' => 'Nama Sekolah', 'value' => $data['nama'], 'icon' => 'fa-school'],
                                ['label' => 'NPSN', 'value' => $data['npsn'], 'icon' => 'fa-id-card'],
                                ['label' => 'Jenis Sekolah', 'value' => $data['jenis'], 'icon' => 'fa-graduation-cap'],
                                ['label' => 'Akreditasi', 'value' => $data['akreditasi'], 'icon' => 'fa-award'],
                                [
                                    'label' => 'Tahun Berdiri',
                                    'value' => $data['tahun_berdiri'],
                                    'icon' => 'fa-calendar-alt',
                                ],
                                ['label' => 'Status', 'value' => $data['nama'] ? 'Negeri' : '-', 'icon' => 'fa-flag'],
                                ['label' => 'Alamat', 'value' => $data['alamat'], 'icon' => 'fa-map-marker-alt'],
                                ['label' => 'Kabupaten', 'value' => $data['kabupaten'], 'icon' => 'fa-city'],
                                ['label' => 'Provinsi', 'value' => $data['provinsi'], 'icon' => 'fa-location-dot'],
                                ['label' => 'Email', 'value' => $data['email'], 'icon' => 'fa-envelope'],
                                ['label' => 'Telepon', 'value' => $data['telepon'], 'icon' => 'fa-phone'],
                                [
                                    'label' => 'Kepala Sekolah',
                                    'value' => $data['kepala_sekolah'],
                                    'icon' => 'fa-user-tie',
                                ],
                            ];
                        @endphp

                        @foreach ($identitas as $item)
                            <div
                                class="flex flex-col items-center text-center gap-2 p-3 sm:p-4 rounded-xl bg-[#F5F7FA] border border-slate-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                                <div
                                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-[#0A2540] text-white flex items-center justify-center flex-shrink-0">
                                    <i class="fas {{ $item['icon'] }} text-xs sm:text-sm"
                                        style="color: {{ $gold }}"></i>
                                </div>
                                <div class="min-w-0 w-full">
                                    <p
                                        class="text-[9px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wider truncate">
                                        {{ $item['label'] }}
                                    </p>
                                    <p class="text-[10px] sm:text-sm font-bold text-[#0A2540] mt-0.5 truncate">
                                        {{ $item['value'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Visi & Misi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-8" data-aos="fade-up">
                <div class="bg-[#0A2540] rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-28 h-28 rounded-full bg-white/5"></div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                            <i class="fas fa-eye" style="color: {{ $gold }}"></i>
                        </div>
                        <h3 class="text-lg font-bold">Visi</h3>
                    </div>
                    <p class="text-blue-100/80 leading-relaxed italic">"{{ $data['visi'] }}"</p>
                </div>

                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-[#F5F7FA] flex items-center justify-center">
                            <i class="fas fa-bullseye" style="color: {{ $gold }}"></i>
                        </div>
                        <h3 class="text-lg font-bold text-[#0A2540]">Misi Singkat</h3>
                    </div>
                    @if (count($data['misi']) > 0)
                        <ul class="space-y-2">
                            @foreach (array_slice($data['misi'], 0, 3) as $m)
                                <li class="flex items-start gap-2 text-slate-600 text-sm">
                                    <i class="fas fa-check-circle mt-0.5 flex-shrink-0"
                                        style="color: {{ $gold }}"></i>
                                    <span>{{ $m }}</span>
                                </li>
                            @endforeach
                            @if (count($data['misi']) > 3)
                                <li class="text-slate-400 text-sm italic">... dan {{ count($data['misi']) - 3 }} misi
                                    lainnya</li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>

            {{-- Tujuan Sekolah --}}
            @if (!empty($goals ?? []))
                <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 mb-8" data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-[#0A2540] text-white flex items-center justify-center">
                            <i class="fas fa-flag-checkered" style="color: {{ $gold }}"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-[#0A2540]">Tujuan Sekolah</h2>
                            <div class="w-16 h-1 rounded-full mt-2" style="background: {{ $gold }}"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach ($goals as $index => $goal)
                            <div
                                class="flex items-start gap-3 p-3 rounded-xl bg-[#F5F7FA] border border-slate-100 hover:shadow-md transition-all">
                                <span
                                    class="w-8 h-8 rounded-full bg-[#0A2540] text-white flex items-center justify-center text-sm font-bold flex-shrink-0">
                                    <span style="color: {{ $gold }}">{{ $index + 1 }}</span>
                                </span>
                                <span class="text-sm text-slate-700 leading-relaxed">{{ $goal }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Moto Sekolah --}}
            <div class="bg-[#0A2540] rounded-2xl p-8 md:p-12 text-center relative overflow-hidden mb-8" data-aos="fade-up">
                <div class="absolute top-0 right-0 w-48 h-48 rounded-full opacity-5 -mr-16 -mt-16"
                    style="background: {{ $gold }}"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 rounded-full opacity-5 -ml-12 -mb-12"
                    style="background: {{ $gold }}"></div>
                <div class="relative z-10">
                    <i class="fas fa-quote-left text-3xl mb-4 block" style="color: {{ $gold }}"></i>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-2">Moto Sekolah</h3>
                    <p class="text-xl md:text-2xl font-bold" style="color: {{ $gold }}">"{{ $data['moto'] }}"</p>
                    <div class="mt-6 w-20 h-1 mx-auto rounded-full" style="background: {{ $gold }}"></div>
                </div>
            </div>

            {{-- Nilai Sekolah --}}
            @if (!empty($values))
                <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 mb-8" data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-[#0A2540] text-white flex items-center justify-center">
                            <i class="fas fa-heart" style="color: {{ $gold }}"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-[#0A2540]">Nilai-Nilai Sekolah</h2>
                            <div class="w-16 h-1 rounded-full mt-2" style="background: {{ $gold }}"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 lg:gap-4">
                        @foreach ($values as $v)
                            <div
                                class="p-3 sm:p-4 rounded-xl bg-[#F5F7FA] border border-slate-100 text-center hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                                <div
                                    class="w-10 h-10 sm:w-12 sm:h-12 mx-auto rounded-full bg-[#0A2540] flex items-center justify-center mb-2">
                                    <i class="fas fa-{{ $v['icon'] }} text-sm sm:text-lg"
                                        style="color: {{ $gold }}"></i>
                                </div>
                                <h4 class="font-bold text-[#0A2540] text-xs sm:text-sm mb-1">{{ $v['name'] }}</h4>
                                <p class="text-[9px] sm:text-xs text-slate-500 line-clamp-2">{{ $v['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Program Unggulan --}}
            @if (!empty($programs))
                <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 mb-8"
                    data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-[#0A2540] text-white flex items-center justify-center">
                            <i class="fas fa-star" style="color: {{ $gold }}"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-[#0A2540]">Program Unggulan</h2>
                            <div class="w-16 h-1 rounded-full mt-2" style="background: {{ $gold }}"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 lg:gap-4">
                        @foreach ($programs as $p)
                            <div
                                class="p-3 sm:p-5 rounded-xl bg-gradient-to-br from-[#F5F7FA] to-white border border-slate-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                                <div
                                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-[#0A2540] flex items-center justify-center mb-2">
                                    <i class="fas fa-{{ $p['icon'] }} text-sm sm:text-lg"
                                        style="color: {{ $gold }}"></i>
                                </div>
                                <h4 class="font-bold text-[#0A2540] text-xs sm:text-sm mb-1">{{ $p['name'] }}</h4>
                                <p class="text-[9px] sm:text-xs text-slate-500 line-clamp-2">{{ $p['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Statistik --}}
            <section class="bg-[#0A2540] rounded-2xl p-6 sm:p-8 mb-8 relative overflow-hidden" data-aos="fade-up">
                <div class="absolute -right-10 -top-10 w-48 h-48 rounded-full opacity-5"
                    style="background: {{ $gold }}"></div>
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white">Statistik Sekolah</h2>
                    <div class="w-16 h-1 mx-auto rounded-full mt-2" style="background: {{ $gold }}"></div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                    @php
                        $stats = [
                            ['icon' => 'fa-users', 'label' => 'Siswa', 'value' => $statistics['siswa'] ?? '0'],
                            ['icon' => 'fa-chalkboard-user', 'label' => 'Guru', 'value' => $statistics['guru'] ?? '0'],
                            [
                                'icon' => 'fa-door-open',
                                'label' => 'Kelas',
                                'value' => \App\Models\Setting::get('school.statistics.jumlah_kelas', '0'),
                            ],
                            [
                                'icon' => 'fa-book-open',
                                'label' => 'Rombel',
                                'value' => \App\Models\Setting::get('school.statistics.jumlah_rombel', '0'),
                            ],
                        ];
                    @endphp
                    @foreach ($stats as $s)
                        <div class="text-center p-3 sm:p-4 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                            <i class="fas {{ $s['icon'] }} text-2xl sm:text-3xl mb-2 block"
                                style="color: {{ $gold }}"></i>
                            <div class="text-2xl sm:text-3xl font-extrabold text-white"><span class="counter"
                                    data-target="{{ $s['value'] }}">0</span></div>
                            <div class="text-xs text-blue-100/70 mt-1">{{ $s['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Lokasi --}}
            <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 mb-8" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-[#0A2540] text-white flex items-center justify-center">
                        <i class="fas fa-map-marked-alt" style="color: {{ $gold }}"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-[#0A2540]">Lokasi Sekolah</h2>
                        <div class="w-16 h-1 rounded-full mt-2" style="background: {{ $gold }}"></div>
                    </div>
                </div>

                <div class="rounded-xl overflow-hidden border border-slate-200 mb-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.0!2d138.5!3d-3.5!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMzAnMDAuMCJTIDEzOMKwMzAnMDAuMCJF!5e0!3m2!1sid!2sid!4v1"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="bg-[#F5F7FA] rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt mt-1" style="color: {{ $gold }}"></i>
                        <div>
                            <p class="font-semibold text-[#0A2540]">Alamat</p>
                            <p class="text-slate-600 text-sm">{{ $data['alamat'] }}, {{ $data['kabupaten'] }},
                                {{ $data['provinsi'] }}</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- CTA PPDB --}}
            <div data-aos="fade-up">
                @include('profil.partials.cta-ppdb')
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 600
        });
    </script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush
