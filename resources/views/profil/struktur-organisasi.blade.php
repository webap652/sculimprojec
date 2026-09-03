@extends('layouts.app')

@section('title', 'Struktur Organisasi - SMP NEGERI 1 PIRIME')
@section('description', 'Struktur kepengurusan dan organisasi SMP Negeri 1 Pirime.')

@section('hero')
    @php $breadcrumb = ['Beranda', 'Profil', 'Struktur Organisasi']; @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'STRUKTUR ORGANISASI',
        'desc' => 'Struktur kepengurusan dan bagan organisasi SMP Negeri 1 Pirime.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    @php
        // Cek apakah data dari database benar-benar kosong
        $isTreeEmpty =
            !isset($tree) ||
            (is_countable($tree) && count($tree) == 0) ||
            ($tree instanceof \Illuminate\Support\Collection && $tree->isEmpty());

        $allData = collect();

        // JIKA DATABASE KOSONG -> Gunakan Data Dummy Sesuai Poster
        if ($isTreeEmpty) {
            $root = (object) ['id' => 1, 'nama' => 'DRS. IMAM BASORI', 'jabatan' => 'Kepala Sekolah', 'foto' => null];
            $komite = (object) ['id' => 2, 'nama' => '', 'jabatan' => 'KOMITE SEKOLAH', 'foto' => null];
            $ktu = (object) ['id' => 3, 'nama' => 'DIDIK SUBIYANTORO', 'jabatan' => 'KTU', 'foto' => null];

            $mainStaff = collect([
                (object) ['id' => 4, 'nama' => 'Samiran, S.Pd', 'jabatan' => 'WAKA SARPRAS', 'foto' => null],
                (object) [
                    'id' => 5,
                    'nama' => "Moh. In'am Fathur Riza, S.Pd",
                    'jabatan' => 'WAKA KESISWAAN',
                    'foto' => null,
                ],
                (object) ['id' => 6, 'nama' => 'Drs. Cahyo Sumargo', 'jabatan' => 'WAKA SARPRAS', 'foto' => null],
                (object) ['id' => 7, 'nama' => 'Sunhaji, S.Pd', 'jabatan' => 'WAKA HUMAS', 'foto' => null],
                (object) ['id' => 8, 'nama' => 'Drs. Sinar Agus', 'jabatan' => 'PENJAS SNP', 'foto' => null],
                (object) [
                    'id' => 9,
                    'nama' => 'Siti Qotidjah N.K., S.Pd',
                    'jabatan' => 'KEPALA PERPUS',
                    'foto' => null,
                ],
            ]);
        }
        // JIKA ADA DATA DARI ADMIN -> Proses secara dinamis (flat collection)
        else {
            // Data sudah flat dari controller, tidak perlu rekursif
            $allData = $tree->sortBy('urutan')->values();

            // 1. Ekstrak KEPALA SEKOLAH
            $root =
                $allData->first(
                    fn($item) => strcasecmp(trim($item->jabatan), 'Kepala Sekolah') === 0 ||
                        strcasecmp(trim($item->jabatan), 'Kepsek') === 0,
                ) ?? $allData->first();

            if ($root) {
                $allData = $allData->reject(fn($item) => $item->id === $root->id);
            }

            // 2. Ekstrak KOMITE SEKOLAH
            $komite = $allData->first(fn($item) => stripos($item->jabatan, 'komite') !== false);
            if ($komite) {
                $allData = $allData->reject(fn($item) => $item->id === $komite->id);
            }

            // 3. Ekstrak KTU / TATA USAHA
            $ktu = $allData->first(
                fn($item) => strcasecmp(trim($item->jabatan), 'KTU') === 0 ||
                    strcasecmp(trim($item->jabatan), 'Kepala Tata Usaha') === 0 ||
                    stripos($item->jabatan, 'tata usaha') !== false ||
                    stripos($item->jabatan, 'kepala tu') !== false,
            );
            if ($ktu) {
                $allData = $allData->reject(fn($item) => $item->id === $ktu->id);
            }

            // 4. SISANYA
            $mainStaff = $allData->values();
        }
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @include('profil.partials.sidebar')

        <div class="relative bg-[#f8f9fa] rounded-3xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] border border-slate-200 overflow-hidden mb-12 min-h-[800px]"
            data-aos="fade-up">

            {{-- Decorative Corner Backgrounds --}}
            <div
                class="absolute top-0 left-0 w-64 h-64 bg-[radial-gradient(#cbd5e1_2px,transparent_2px)] [background-size:16px_16px] opacity-40">
            </div>
            <div
                class="absolute bottom-0 left-0 w-64 h-64 bg-[radial-gradient(#cbd5e1_2px,transparent_2px)] [background-size:16px_16px] opacity-40">
            </div>

            {{-- Bottom Poster Waves --}}
            <div class="absolute bottom-0 left-0 w-full h-32 bg-[#c59b27] rounded-b-3xl"
                style="clip-path: polygon(0 20%, 100% 0%, 100% 100%, 0 100%); z-index: 1;"></div>
            <div class="absolute bottom-0 left-0 w-full h-32 bg-[#0a2558] rounded-b-3xl"
                style="clip-path: polygon(0 40%, 100% 20%, 100% 100%, 0 100%); z-index: 2;"></div>

            <div class="relative z-10 flex items-center justify-center gap-4 sm:gap-8 pt-12 pb-8 px-6">

                {{-- Teks Judul --}}
                <div class="text-center">
                    <h3 class="text-[#c59b27] font-black text-sm sm:text-lg tracking-[0.2em] uppercase mb-1 drop-shadow-sm">
                        STRUKTUR ORGANISASI</h3>
                    <h1
                        class="text-3xl sm:text-5xl md:text-6xl font-black text-[#0a2558] tracking-tighter mb-4 drop-shadow-sm">
                        SMP NEGERI 1 PIRIME</h1>

                    <div
                        class="flex items-center justify-center gap-2 sm:gap-4 text-[10px] sm:text-xs font-bold text-[#0a2558] tracking-widest uppercase">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#c59b27]"></span> CERDAS
                        <span class="w-1.5 h-1.5 rounded-full bg-[#c59b27]"></span> MANDIRI
                        <span class="w-1.5 h-1.5 rounded-full bg-[#c59b27]"></span> BERKARAKTER
                        <span class="w-1.5 h-1.5 rounded-full bg-[#c59b27]"></span>
                    </div>
                </div>
            </div>

            <div class="relative z-10 py-8 px-4 overflow-x-auto">
                <div class="min-w-[800px] max-w-4xl mx-auto relative pb-32">

                    {{-- GARIS TENGAH UTAMA --}}
                    <div
                        class="absolute top-[80px] bottom-[140px] left-1/2 w-[3px] bg-[#0a2558] -translate-x-1/2 z-0 shadow-sm">
                    </div>

                    @if ($root)
                        <div class="flex flex-col items-center mb-12 relative z-10">
                            <div
                                class="relative flex bg-white shadow-xl border border-slate-200 w-[300px] h-[70px] items-center hover:-translate-y-1 transition-transform rounded-r-lg rounded-l-lg">
                                <div
                                    class="absolute -left-8 w-[84px] h-[84px] rounded-full border-4 border-[#c59b27] shadow-lg overflow-hidden bg-white flex-shrink-0 z-20">
                                    @if (isset($root->foto) && $root->foto)
                                        <img src="{{ asset('storage/' . $root->foto) }}" alt="{{ $root->nama }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($root->nama) }}&background=0a2558&color=fff&size=100&bold=true"
                                            class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-grow pl-[60px] h-full flex flex-col rounded-r-lg overflow-hidden">
                                    <div
                                        class="h-1/2 bg-[#0a2558] text-white flex items-center justify-center px-2 font-extrabold text-xs sm:text-sm tracking-wide">
                                        {{ strtoupper($root->nama) }}
                                    </div>
                                    <div
                                        class="h-1/2 bg-white text-[#0a2558] flex items-center justify-center px-2 font-semibold italic text-xs sm:text-sm">
                                        {{ $root->jabatan }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($komite || $ktu)
                        <div class="relative flex justify-between items-center mb-12 z-10 px-[10%]">
                            <div
                                class="absolute top-1/2 left-[25%] right-[25%] h-0 border-t-[2.5px] border-dashed border-[#0a2558] -translate-y-1/2 z-0">
                            </div>

                            {{-- Komite --}}
                            <div class="w-1/2 flex justify-end pr-12 z-10">
                                @if ($komite)
                                    <div
                                        class="bg-[#0a2558] text-white rounded-xl px-6 py-3.5 shadow-xl font-extrabold text-sm uppercase tracking-widest hover:-translate-y-1 transition-transform whitespace-nowrap border-2 border-white ring-2 ring-[#0a2558]">
                                        @if ($komite->nama && stripos($komite->nama, 'komite') === false)
                                            <div class="text-center">
                                                <div class="text-xs font-normal italic text-slate-300">
                                                    {{ $komite->jabatan }}</div>
                                                <div>{{ $komite->nama }}</div>
                                            </div>
                                        @else
                                            {{ $komite->jabatan }}
                                        @endif
                                    </div>
                                @endif
                            </div>

                            {{-- KTU --}}
                            <div class="w-1/2 flex justify-start pl-12 z-10">
                                @if ($ktu)
                                    <div
                                        class="relative flex bg-white shadow-xl border border-slate-200 w-[240px] h-[56px] items-center hover:-translate-y-1 transition-transform rounded-r-lg rounded-l-lg">
                                        <div
                                            class="absolute -left-6 w-[64px] h-[64px] rounded-full border-[3px] border-[#c59b27] shadow-md overflow-hidden bg-white flex-shrink-0 z-20">
                                            @if (isset($ktu->foto) && $ktu->foto)
                                                <img src="{{ asset('storage/' . $ktu->foto) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($ktu->nama) }}&background=0a2558&color=fff&size=80&bold=true"
                                                    class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div class="flex-grow pl-[44px] h-full flex flex-col rounded-r-lg overflow-hidden">
                                            <div
                                                class="h-1/2 bg-[#0a2558] text-white flex items-center justify-center px-2 font-bold text-xs uppercase tracking-wide">
                                                {{ strtoupper($ktu->nama) }}
                                            </div>
                                            <div
                                                class="h-1/2 bg-white text-[#0a2558] flex items-center justify-center px-2 font-semibold italic text-xs">
                                                {{ $ktu->jabatan }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @foreach ($mainStaff->chunk(2) as $index => $chunk)
                        <div class="relative flex justify-between items-center mb-12 z-10 px-[10%]">

                            {{-- Logic Garis Dinamis --}}
                            @if ($chunk->count() == 2)
                                <div
                                    class="absolute top-1/2 left-[25%] right-[25%] h-0 border-t-[2.5px] border-dashed border-[#0a2558] -translate-y-1/2 z-0">
                                </div>
                            @else
                                <div
                                    class="absolute top-1/2 left-[25%] right-1/2 h-0 border-t-[2.5px] border-dashed border-[#0a2558] -translate-y-1/2 z-0">
                                </div>
                            @endif

                            {{-- Item Kiri --}}
                            <div class="w-1/2 flex justify-end pr-12 z-10">
                                @if (isset($chunk->values()[0]))
                                    @php $staff = $chunk->values()[0]; @endphp
                                    <div
                                        class="relative flex bg-white shadow-xl border border-slate-200 w-[240px] h-[56px] items-center hover:-translate-y-1 transition-transform rounded-r-lg rounded-l-lg">
                                        <div
                                            class="absolute -left-6 w-[64px] h-[64px] rounded-full border-[3px] border-[#c59b27] shadow-md overflow-hidden bg-white flex-shrink-0 z-20">
                                            @if (isset($staff->foto) && $staff->foto)
                                                <img src="{{ asset('storage/' . $staff->foto) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($staff->nama) }}&background=0a2558&color=fff&size=80&bold=true"
                                                    class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div class="flex-grow pl-[44px] h-full flex flex-col rounded-r-lg overflow-hidden">
                                            <div
                                                class="h-1/2 bg-[#0a2558] text-white flex items-center px-3 font-bold text-[11px] uppercase tracking-wide whitespace-nowrap overflow-hidden text-ellipsis">
                                                {{ $staff->jabatan }}
                                            </div>
                                            <div
                                                class="h-1/2 bg-white text-[#0a2558] flex items-center px-3 font-semibold italic text-[11px] border-t border-slate-200 whitespace-nowrap overflow-hidden text-ellipsis">
                                                {{ $staff->nama }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Item Kanan --}}
                            <div class="w-1/2 flex justify-start pl-12 z-10">
                                @if (isset($chunk->values()[1]))
                                    @php $rightStaff = $chunk->values()[1]; @endphp
                                    <div
                                        class="relative flex bg-white shadow-xl border border-slate-200 w-[240px] h-[56px] items-center hover:-translate-y-1 transition-transform rounded-r-lg rounded-l-lg">
                                        <div
                                            class="absolute -left-6 w-[64px] h-[64px] rounded-full border-[3px] border-[#c59b27] shadow-md overflow-hidden bg-white flex-shrink-0 z-20">
                                            @if (isset($rightStaff->foto) && $rightStaff->foto)
                                                <img src="{{ asset('storage/' . $rightStaff->foto) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($rightStaff->nama) }}&background=0a2558&color=fff&size=80&bold=true"
                                                    class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div class="flex-grow pl-[44px] h-full flex flex-col rounded-r-lg overflow-hidden">
                                            <div
                                                class="h-1/2 bg-[#0a2558] text-white flex items-center px-3 font-bold text-[11px] uppercase tracking-wide whitespace-nowrap overflow-hidden text-ellipsis">
                                                {{ $rightStaff->jabatan }}
                                            </div>
                                            <div
                                                class="h-1/2 bg-white text-[#0a2558] flex items-center px-3 font-semibold italic text-[11px] border-t border-slate-200 whitespace-nowrap overflow-hidden text-ellipsis">
                                                {{ $rightStaff->nama }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{-- Nodes Abstrak di Bawah (Selalu Tampil Sebagai Penutup Struktur) --}}
                    <div class="relative flex justify-between items-center mb-10 z-10 px-[15%]">
                        <div
                            class="absolute top-1/2 left-[32%] right-[32%] h-0 border-t-2 border-[#0a2558] -translate-y-1/2 z-0">
                        </div>
                        <div class="w-1/2 flex justify-end pr-8 z-10">
                            <div
                                class="flex items-center bg-[#0a2558] text-white rounded-full pr-5 py-1.5 shadow-lg border-2 border-white ring-1 ring-[#0a2558] hover:-translate-y-1 transition-transform">
                                <div
                                    class="w-8 h-8 rounded-full bg-white text-[#0a2558] flex items-center justify-center mr-3 ml-0.5">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <span class="font-bold text-xs uppercase tracking-wide">LABORAN</span>
                            </div>
                        </div>
                        <div class="w-1/2 flex justify-start pl-8 z-10">
                            <div
                                class="flex items-center bg-[#0a2558] text-white rounded-full pr-5 py-1.5 shadow-lg border-2 border-white ring-1 ring-[#0a2558] hover:-translate-y-1 transition-transform">
                                <div
                                    class="w-8 h-8 rounded-full bg-white text-[#0a2558] flex items-center justify-center mr-3 ml-0.5">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <span class="font-bold text-xs uppercase tracking-wide">PUSTAKAWAN</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-center mb-8 relative z-10">
                        <div
                            class="flex items-center bg-[#0a2558] text-white rounded-full pr-8 py-2 shadow-xl border-2 border-white ring-2 ring-[#0a2558] hover:-translate-y-1 transition-transform">
                            <div
                                class="w-10 h-10 rounded-full bg-white text-[#0a2558] flex items-center justify-center mr-4 ml-1">
                                <i class="fas fa-user-tie text-lg"></i>
                            </div>
                            <span class="font-extrabold text-sm uppercase tracking-widest">GURU BK / WALI KELAS</span>
                        </div>
                    </div>

                    <div class="flex flex-col items-center relative z-10">
                        <div
                            class="flex items-center bg-[#0a2558] text-white rounded-full pr-8 py-2 shadow-xl border-2 border-white ring-2 ring-[#0a2558] hover:-translate-y-1 transition-transform">
                            <div
                                class="w-10 h-10 rounded-full bg-white text-[#0a2558] flex items-center justify-center mr-4 ml-1">
                                <i class="fas fa-user-graduate text-lg"></i>
                            </div>
                            <span class="font-extrabold text-sm uppercase tracking-widest">SISWA</span>
                        </div>
                    </div>

                </div>
            </div>

            <div
                class="absolute bottom-0 left-0 w-full flex flex-col sm:flex-row justify-between items-center sm:items-end px-6 sm:px-10 pb-4 text-white z-10">
                <span class="italic font-normal text-xs sm:text-sm text-white/90 mb-1 sm:mb-0">"Membangun Generasi Emas
                    Lanny Jaya"</span>
                <span class="font-bold tracking-widest text-xs sm:text-sm">SMP NEGERI 1 PIRIME</span>
            </div>

        </div>
    </div>
@endsection
