@extends('layouts.app')

@section('title', 'Kesiswaan - SMP NEGERI 1 PIRIME')
@section('description', 'Informasi lengkap tentang kegiatan dan program kesiswaan SMP Negeri 1 Pirime.')

@section('hero')
    @php $breadcrumb = ['Beranda', 'Kesiswaan']; @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'KESISWAAN',
        'desc' => 'Informasi lengkap tentang kegiatan dan program kesiswaan SMP Negeri 1 Pirime.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    @php
        $programsRaw = \App\Models\Setting::get('school.programs', '');
        $programs = [];
        if (is_string($programsRaw) && !empty($programsRaw)) {
            $lines = array_filter(explode("\n", $programsRaw));
            foreach ($lines as $line) {
                $parts = explode('|', $line);
                $programs[] = [
                    'name' => trim($parts[0] ?? ''),
                    'icon' => trim($parts[1] ?? 'star'),
                    'desc' => trim($parts[2] ?? ''),
                ];
            }
        }

        $prestasis = \App\Models\Prestasi::aktif()->latest('tahun')->take(6)->get();
    @endphp

    <section class="py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-14" data-aos="fade-up">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold border border-primary-100 mb-4">
                    <i class="fas fa-users text-gold-500"></i>
                    <span>Pengembangan Siswa</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900">Program Kesiswaan</h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-primary-500 to-gold-500 mx-auto rounded-full mt-4"></div>
                <p class="mt-4 text-slate-500 max-w-2xl mx-auto">Berbagai program unggulan pengembangan karakter, bakat, dan
                    minat siswa SMP Negeri 1 Pirime.</p>
            </div>

            @if (count($programs) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up">
                    @foreach ($programs as $prog)
                        <div
                            class="group bg-white rounded-2xl shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300 border border-slate-100 p-8">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-700 to-primary-900 text-gold-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-primary-900/20">
                                <i class="fas fa-{{ $prog['icon'] }} text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary-900 mb-2">{{ $prog['name'] }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $prog['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up">
                    @php
                        $defaultPrograms = [
                            [
                                'icon' => 'users',
                                'title' => 'OSIS',
                                'desc' => 'Organisasi Siswa Intra Sekolah sebagai wadah pengembangan kepemimpinan.',
                            ],
                            [
                                'icon' => 'campground',
                                'title' => 'Pramuka',
                                'desc' => 'Kegiatan kepramukaan untuk membentuk karakter dan kemandirian.',
                            ],
                            [
                                'icon' => 'music',
                                'title' => 'Ekstrakurikuler',
                                'desc' => 'Berbagai kegiatan pengembangan bakat dan minat siswa.',
                            ],
                            [
                                'icon' => 'book',
                                'title' => 'Literasi',
                                'desc' => 'Program pembiasaan membaca dan menulis setiap pagi.',
                            ],
                            [
                                'icon' => 'leaf',
                                'title' => 'Adiwiyata',
                                'desc' => 'Program sekolah berwawasan lingkungan dan pelestarian alam.',
                            ],
                            [
                                'icon' => 'pray',
                                'title' => 'Kerohanian',
                                'desc' => 'Pembinaan iman dan budi pekerti sesuai nilai-nilai Kristiani.',
                            ],
                        ];
                    @endphp
                    @foreach ($defaultPrograms as $it)
                        <div
                            class="group bg-white rounded-2xl shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300 border border-slate-100 p-8">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-700 to-primary-900 text-gold-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-primary-900/20">
                                <i class="fas fa-{{ $it['icon'] }} text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary-900 mb-2">{{ $it['title'] }}</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $it['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Prestasi Siswa -->
            <div class="mt-20" data-aos="fade-up">
                <div class="text-center mb-12">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold border border-primary-100 mb-4">
                        <i class="fas fa-trophy text-gold-500"></i>
                        <span>Kebanggaan Kami</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900">Prestasi Siswa</h2>
                    <div class="w-20 h-1.5 bg-gradient-to-r from-primary-500 to-gold-500 mx-auto rounded-full mt-4"></div>
                    <p class="mt-4 text-slate-500">Pencapaian terbaru siswa SMP Negeri 1 Pirime.</p>
                </div>

                @if ($prestasis->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($prestasis as $prestasi)
                            <div
                                class="group bg-white rounded-2xl shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300 border border-slate-100 overflow-hidden">
                                @if ($prestasi->foto)
                                    <div class="h-48 overflow-hidden">
                                        <img src="{{ asset('storage/' . $prestasi->foto) }}"
                                            alt="{{ $prestasi->nama_prestasi }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                            loading="lazy">
                                    </div>
                                @else
                                    <div
                                        class="h-40 bg-gradient-to-br from-primary-700 to-primary-900 flex items-center justify-center">
                                        <div
                                            class="w-16 h-16 rounded-full bg-white/10 border-2 border-gold-400 flex items-center justify-center text-gold-400">
                                            <i class="fas fa-trophy text-2xl"></i>
                                        </div>
                                    </div>
                                @endif
                                <div class="p-6">
                                    <div class="flex items-center gap-2 mb-3">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-primary-50 text-primary-700">{{ ucfirst($prestasi->kategori) }}</span>
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-gold-50 text-gold-700">{{ ucfirst($prestasi->tingkat) }}</span>
                                        @if ($prestasi->tahun)
                                            <span
                                                class="text-xs text-slate-400 ml-auto font-semibold">{{ $prestasi->tahun }}</span>
                                        @endif
                                    </div>
                                    <h3 class="font-bold text-primary-900 leading-snug">{{ $prestasi->nama_prestasi }}</h3>
                                    @if ($prestasi->deskripsi)
                                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                                            {{ Str::limit($prestasi->deskripsi, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-10">
                        <a href="{{ route('profil.prestasi') }}"
                            class="inline-flex items-center gap-2 text-primary-700 hover:text-gold-600 font-bold text-sm transition-colors group">
                            Lihat Semua Prestasi <i
                                class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-12 text-center max-w-2xl mx-auto">
                        <div
                            class="mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-primary-700 to-primary-900 text-gold-400 flex items-center justify-center mb-4 shadow-lg">
                            <i class="fas fa-trophy text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-primary-900 text-xl">Belum Ada Data Prestasi</h4>
                        <p class="text-slate-500 text-sm mt-2">Admin akan segera memperbarui data prestasi siswa.</p>
                    </div>
                @endif
            </div>

        </div>
    </section>
@endsection
