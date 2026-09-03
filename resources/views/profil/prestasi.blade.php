@extends('layouts.app')

@section('title', 'Prestasi - SMP NEGERI 1 PIRIME')
@section('description', 'Prestasi akademik dan non akademik SMP Negeri 1 Pirime.')

@section('hero')
    @php $breadcrumb = ['Beranda', 'Profil', 'Prestasi']; @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'Prestasi',
        'desc' => 'Pencapaian dan prestasi SMP Negeri 1 Pirime di berbagai bidang dan tingkat.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    @php
        $navy = '#0A2540';
        $gold = '#D4AF37';

        // Group prestasi per kategori & tingkat
        $jumlahPrestasi = $prestasis->count();
        $jumlahAkademik = $prestasis->where('kategori', 'akademik')->count();
        $jumlahNonAkademik = $prestasis->where('kategori', 'non_akademik')->count();
        $tahunTerbaru = $prestasis->max('tahun');

        $kategoriIcons = [
            'akademik' => 'fa-book-open',
            'non_akademik' => 'fa-futbol',
            'guru' => 'fa-user-tie',
            'sekolah' => 'fa-school',
        ];

        // Warna badge per tingkat
        $tingkatColors = [
            'internasional' => 'from-purple-600 to-indigo-600',
            'nasional' => 'from-indigo-500 to-blue-600',
            'provinsi' => 'from-blue-500 to-cyan-500',
            'kabupaten' => 'from-emerald-500 to-green-500',
            'distrik' => 'from-amber-500 to-orange-500',
        ];
    @endphp

    <div class="bg-[#F5F7FA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @include('profil.partials.sidebar')

            {{-- Section Heading --}}
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10" data-aos="fade-up">
                <div>
                    <div class="inline-flex items-center gap-2 font-semibold text-sm uppercase tracking-widest mb-2"
                        style="color: {{ $gold }}">
                        <span class="w-10 h-0.5 rounded-full" style="background: {{ $gold }}"></span>
                        Kebanggaan Kami
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0A2540]">Prestasi Sekolah</h2>
                    <p class="text-slate-500 mt-3 max-w-2xl leading-relaxed">
                        Deretan pencapaian membanggakan dari peserta didik, guru, dan sekolah di berbagai bidang serta
                        tingkat.
                    </p>
                </div>
                <div
                    class="hidden md:flex items-center gap-3 bg-white rounded-2xl shadow-sm px-5 py-3 border border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-[#0A2540] text-white flex items-center justify-center">
                        <i class="fas fa-trophy" style="color: {{ $gold }}"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-extrabold text-[#0A2540]">{{ $jumlahPrestasi }}</div>
                        <div class="text-xs text-slate-500">Total Prestasi</div>
                    </div>
                </div>
            </div>

            {{-- Statistics --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-5 mb-10" data-aos="fade-up">
                <div
                    class="relative overflow-hidden rounded-2xl bg-[#0A2540] text-white p-4 sm:p-6 shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="counter text-3xl sm:text-4xl font-extrabold" data-target="{{ $jumlahPrestasi }}">0
                            </div>
                            <p class="text-white/70 text-xs sm:text-sm mt-1 font-medium">Total Prestasi</p>
                        </div>
                        <div
                            class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-white/10 flex items-center justify-center text-xl sm:text-2xl">
                            🏆
                        </div>
                    </div>
                </div>

                <div
                    class="relative overflow-hidden rounded-2xl bg-white text-[#0A2540] p-4 sm:p-6 shadow-lg border border-slate-100 hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full" style="background: {{ $gold }}11">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="counter text-3xl sm:text-4xl font-extrabold" data-target="{{ $jumlahAkademik }}">0
                            </div>
                            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">Akademik</p>
                        </div>
                        <div
                            class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-[#F5F7FA] flex items-center justify-center text-xl sm:text-2xl">
                            📚
                        </div>
                    </div>
                </div>

                <div
                    class="relative overflow-hidden rounded-2xl bg-white text-[#0A2540] p-4 sm:p-6 shadow-lg border border-slate-100 hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full" style="background: {{ $gold }}11">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="counter text-3xl sm:text-4xl font-extrabold" data-target="{{ $jumlahNonAkademik }}">
                                0</div>
                            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">Non Akademik</p>
                        </div>
                        <div
                            class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-[#F5F7FA] flex items-center justify-center text-xl sm:text-2xl">
                            ⚽
                        </div>
                    </div>
                </div>

                <div
                    class="relative overflow-hidden rounded-2xl bg-white text-[#0A2540] p-4 sm:p-6 shadow-lg border border-slate-100 hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full" style="background: {{ $gold }}11">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl sm:text-4xl font-extrabold truncate">
                                {{ $tahunTerbaru ? $tahunTerbaru : '-' }}</div>
                            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">Tahun Aktif</p>
                        </div>
                        <div
                            class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-[#F5F7FA] flex items-center justify-center text-xl sm:text-2xl">
                            📅
                        </div>
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-10" data-aos="fade-up">
                <div class="flex flex-wrap gap-2 items-center">
                    <button onclick="filterPrestasi('all')"
                        class="prestasi-filter active px-4 py-2 rounded-full text-sm font-medium bg-[#0A2540] text-white transition shadow-sm">Semua</button>
                    @foreach ($kategoriList as $k => $v)
                        <button onclick="filterPrestasi('{{ $k }}')"
                            class="prestasi-filter px-4 py-2 rounded-full text-sm font-medium bg-slate-100 text-slate-600 hover:bg-[#F5F7FA] hover:text-[#0A2540] transition">{{ $v }}</button>
                    @endforeach
                </div>
            </div>

            {{-- Prestasi Cards Grid --}}
            @if ($prestasis->count() > 0)
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-5 lg:gap-6" id="prestasiGrid">
                    @foreach ($prestasis as $prestasi)
                        @php
                            $tingWords = $tingkatColors[$prestasi->tingkat] ?? 'from-slate-600 to-slate-800';
                            $badgeTing = $tingkatList[$prestasi->tingkat] ?? $prestasi->tingkat;
                            $badgeKat = $kategoriList[$prestasi->kategori] ?? $prestasi->kategori;
                            $iconKat = $kategoriIcons[$prestasi->kategori] ?? 'fa-medal';
                            $medalColor =
                                $prestasi->juara == 1
                                    ? 'text-yellow-400'
                                    : ($prestasi->juara == 2
                                        ? 'text-slate-400'
                                        : ($prestasi->juara == 3
                                            ? 'text-amber-600'
                                            : 'text-[#D4AF37]'));
                        @endphp
                        <div class="prestasi-card group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300"
                            data-kategori="{{ $prestasi->kategori }}" data-aos="fade-up">
                            {{-- Foto / Header --}}
                            <div class="relative h-40 sm:h-52 overflow-hidden">
                                @if ($prestasi->foto)
                                    <img src="{{ asset('storage/' . $prestasi->foto) }}"
                                        alt="{{ $prestasi->nama_prestasi }}"
                                        class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500"
                                        loading="lazy">
                                @else
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br {{ $tingWords }} flex items-center justify-center">
                                        <div
                                            class="w-14 h-14 sm:w-20 sm:h-20 rounded-full bg-white/15 border-2 border-white/30 flex items-center justify-center">
                                            <i class="fas fa-trophy text-2xl sm:text-4xl"
                                                style="color: {{ $gold }}"></i>
                                        </div>
                                    </div>
                                @endif

                                {{-- Badge Tingkat --}}
                                <div class="absolute top-2 sm:top-3 left-2 sm:left-3">
                                    <span
                                        class="px-2 sm:px-3 py-1 rounded-full text-[9px] sm:text-xs font-bold text-white shadow bg-black/40 backdrop-blur-sm">
                                        <i class="fas fa-map-marker-alt mr-1"></i>{{ $badgeTing }}
                                    </span>
                                </div>

                                {{-- Tahun --}}
                                @if ($prestasi->tahun)
                                    <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                                        <span
                                            class="px-2 sm:px-3 py-1 rounded-full text-[9px] sm:text-xs font-extrabold text-[#0A2540] shadow"
                                            style="background: {{ $gold }}">
                                            {{ $prestasi->tahun }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="p-3 sm:p-5">
                                <div class="flex items-center gap-2 mb-2">
                                    <span
                                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-[#F5F7FA] flex items-center justify-center flex-shrink-0">
                                        <i class="fas {{ $iconKat }} text-xs sm:text-base"
                                            style="color: {{ $gold }}"></i>
                                    </span>
                                    <span
                                        class="text-[9px] sm:text-xs font-bold uppercase tracking-wide px-2 sm:px-3 py-1 rounded-full bg-[#F5F7FA] text-slate-600">
                                        {{ $badgeKat }}
                                    </span>
                                    @if ($prestasi->juara)
                                        <span class="ml-auto flex items-center gap-1">
                                            <i class="fas fa-medal {{ $medalColor }} text-sm sm:text-lg"></i>
                                            <span class="text-[10px] sm:text-sm font-extrabold text-[#0A2540]">Juara
                                                {{ $prestasi->juara }}</span>
                                        </span>
                                    @endif
                                </div>

                                <h3
                                    class="font-bold text-[#0A2540] text-xs sm:text-sm lg:text-base leading-snug mb-2 line-clamp-2">
                                    {{ $prestasi->nama_prestasi }}
                                </h3>

                                @if ($prestasi->deskripsi)
                                    <p class="text-[10px] sm:text-xs text-slate-500 line-clamp-2">
                                        {{ $prestasi->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center" data-aos="fade-up">
                    <div class="w-20 h-20 mx-auto rounded-2xl bg-[#F5F7FA] flex items-center justify-center mb-4">
                        <i class="fas fa-trophy text-3xl" style="color: {{ $gold }}"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#0A2540]">Data Prestasi Belum Tersedia</h3>
                    <p class="text-slate-400 mt-2">Admin sekolah akan segera melengkapi informasi prestasi.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function filterPrestasi(kategori) {
            document.querySelectorAll('.prestasi-filter').forEach(btn => {
                btn.classList.remove('bg-[#0A2540]', 'text-white', 'shadow-sm');
                btn.classList.add('bg-slate-100', 'text-slate-600');
            });
            const target = event.target;
            target.classList.add('bg-[#0A2540]', 'text-white', 'shadow-sm');
            target.classList.remove('bg-slate-100', 'text-slate-600');
            document.querySelectorAll('.prestasi-card').forEach(card => {
                if (kategori === 'all' || card.dataset.kategori === kategori) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
@endpush
</content>
