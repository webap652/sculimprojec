@extends('layouts.app')

@section('title', 'Guru & Staff - SMP NEGERI 1 PIRIME')
@section('description', 'Data guru dan tenaga kependidikan SMP Negeri 1 Pirime.')

@section('hero')
    @php $breadcrumb = ['Beranda', 'Guru & Staff']; @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'GURU & TENAGA KEPENDIDIKAN',
        'desc' => 'Tenaga pendidik dan kependidikan yang berdedikasi di SMP Negeri 1 Pirime.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Section Header --}}
        <div class="text-center mb-10" data-aos="fade-up">
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold border border-primary-100 mb-4">
                <i class="fas fa-chalkboard-teacher text-gold-500"></i>
                <span>Tim Pendidik</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900">Guru & Tenaga Kependidikan</h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-primary-500 to-gold-500 mx-auto rounded-full mt-4"></div>
            <p class="mt-4 text-slate-500 max-w-2xl mx-auto">Tenaga pendidik profesional yang berdedikasi mencetak generasi
                unggul.</p>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-3 gap-3 sm:gap-4 mb-8" data-aos="fade-up">
            <div class="bg-primary-50 rounded-xl p-4 text-center border border-primary-100">
                <div class="counter text-2xl font-bold text-primary-600" data-target="{{ $data['jumlahGuru'] ?? 0 }}">0
                </div>
                <p class="text-xs text-slate-600 mt-1">Total Guru</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-4 text-center border border-blue-100">
                <div class="counter text-2xl font-bold text-blue-600" data-target="{{ $data['jumlahAsn'] ?? 0 }}">0</div>
                <p class="text-xs text-slate-600 mt-1">ASN</p>
            </div>
            <div class="bg-amber-50 rounded-xl p-4 text-center border border-amber-100">
                <div class="counter text-2xl font-bold text-amber-600" data-target="{{ $data['jumlahHonorer'] ?? 0 }}">0
                </div>
                <p class="text-xs text-slate-600 mt-1">Honorer</p>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row gap-4 mb-8" data-aos="fade-up">
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" id="searchGuru" placeholder="Cari nama guru..."
                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none transition text-sm">
            </div>
            <div class="flex flex-wrap gap-2" id="filterContainer">
                <button onclick="filterGuru('all', this)"
                    class="filter-btn active px-4 py-2 rounded-full text-sm font-medium bg-primary-600 text-white transition">Semua</button>
                @forelse(($data['mapelList'] ?? collect()) as $mapel)
                    <button onclick="filterGuru('{{ $mapel }}', this)"
                        class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-slate-100 text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition">{{ $mapel }}</button>
                @empty
                @endforelse
            </div>
        </div>

        <!-- Guru Cards Grid -->
        @if (($data['gurus'] ?? collect())->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="guruGrid">
                @foreach ($data['gurus'] as $guru)
                    <div class="guru-card group bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                        data-mapel="{{ $guru->mapel ?? '-' }}" data-name="{{ strtolower($guru->nama_lengkap) }}"
                        data-aos="fade-up">
                        {{-- Foto tampil utuh (rasio 3:4) --}}
                        <div
                            class="relative aspect-[3/4] bg-gradient-to-br from-primary-50 to-blue-50 flex items-center justify-center overflow-hidden">
                            @if ($guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama_lengkap }}"
                                    class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy">
                            @else
                                <div
                                    class="w-24 h-24 rounded-full bg-primary-600 text-white flex items-center justify-center text-3xl font-bold shadow-lg">
                                    {{ strtoupper(substr($guru->nama_lengkap, 0, 1)) }}
                                </div>
                            @endif
                            @if ($guru->status)
                                <span
                                    class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold text-white shadow {{ $guru->status == 'ASN' ? 'bg-primary-900' : 'bg-gold-500' }}">{{ $guru->status }}</span>
                            @endif
                        </div>
                        <div class="p-4 sm:p-5">
                            <h3 class="font-bold text-primary-900 text-base sm:text-lg leading-snug">
                                {{ $guru->nama_lengkap }}</h3>
                            @if ($guru->jabatan)
                                <p class="text-xs font-semibold text-gold-600 mt-0.5">{{ $guru->jabatan }}</p>
                            @endif
                            @if ($guru->nip)
                                <p class="text-xs text-slate-400 mt-0.5">NIP. {{ $guru->nip }}</p>
                            @endif
                            <div class="mt-3 space-y-1.5">
                                @if ($guru->mapel)
                                    <p class="text-xs text-primary-700 font-medium"><i
                                            class="fas fa-book mr-1.5"></i>{{ $guru->mapel }}</p>
                                @endif
                                @if ($guru->pendidikan)
                                    <p class="text-xs text-slate-500"><i
                                            class="fas fa-graduation-cap mr-1.5"></i>{{ $guru->pendidikan }}</p>
                                @endif
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                <div class="flex gap-1.5">
                                    @if ($guru->email)
                                        <a href="mailto:{{ $guru->email }}"
                                            class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-primary-100 hover:text-primary-600 transition"><i
                                                class="fas fa-envelope text-xs"></i></a>
                                    @endif
                                    @if ($guru->no_hp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $guru->no_hp) }}"
                                            target="_blank"
                                            class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-green-100 hover:text-green-600 transition"><i
                                                class="fab fa-whatsapp text-xs"></i></a>
                                    @endif
                                </div>
                                <span
                                    class="text-xs font-semibold text-primary-600 group-hover:text-primary-800 transition-colors"><i
                                        class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center" data-aos="fade-up">
                <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 flex items-center justify-center mb-4">
                    <i class="fas fa-chalkboard-user text-3xl text-slate-400"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-600">Data Guru Belum Tersedia</h3>
                <p class="text-slate-400 mt-2">Admin sekolah akan segera melengkapi data guru dan tenaga kependidikan.</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        // Filter by mapel
        function filterGuru(mapel, btnElement) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-primary-600', 'text-white');
                btn.classList.add('bg-slate-100', 'text-slate-600');
            });
            if (!btnElement) btnElement = event?.target;
            if (btnElement) {
                btnElement.classList.add('bg-primary-600', 'text-white');
                btnElement.classList.remove('bg-slate-100', 'text-slate-600');
            }
            document.querySelectorAll('.guru-card').forEach(card => {
                if (mapel === 'all' || card.dataset.mapel === mapel) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Search by name
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchGuru');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase().trim();
                    document.querySelectorAll('.guru-card').forEach(card => {
                        const name = card.dataset.name || '';
                        card.style.display = name.includes(query) ? 'block' : 'none';
                    });
                });
            }
        });
    </script>
@endpush
