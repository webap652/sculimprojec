@extends('layouts.app')

@section('title', 'Pengumuman - SMP NEGERI 1 PIRIME')

@section('content')
    @php
        $announcements = $pengumumans ?? collect();
        $categoryLabels = ['informasi' => 'Sekolah', 'pengumuman' => 'PPDB', 'penting' => 'Penting'];
    @endphp

    <section class="relative overflow-hidden bg-[#0b2945] py-14 text-white sm:py-20">
        <div class="absolute inset-0 opacity-25"><img src="{{ asset('images/hero-bg/hero bg (2).png') }}" alt="" class="h-full w-full object-cover"></div>
        <div class="absolute inset-0 bg-[#0b2945]/80"></div>
        <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <p class="mb-3 text-xs font-bold uppercase tracking-[.25em] text-[#d9a928]">Informasi Sekolah</p>
            <h1 class="max-w-2xl text-3xl font-bold tracking-tight sm:text-5xl">Pengumuman</h1>
            <p class="mt-3 max-w-xl text-sm leading-6 text-slate-200 sm:text-base">Pusat informasi resmi SMP Negeri 1 Pirime.</p>
            <div class="mt-5 flex items-center gap-2 text-xs text-slate-300"><a href="{{ route('home') }}" class="hover:text-white">Beranda</a><span>/</span><span>Informasi</span><span>/</span><span class="text-[#d9a928]">Pengumuman</span></div>
        </div>
    </section>

    <section class="bg-[#f7f9fc] py-12 sm:py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                <div><p class="text-xs font-bold uppercase tracking-[.2em] text-[#d9a928]">Papan Informasi</p><h2 class="mt-2 text-2xl font-bold text-[#0b2945] sm:text-3xl">Pengumuman Terkini</h2><p class="mt-2 text-sm text-slate-500">Informasi resmi dan terbaru SMP Negeri 1 Pirime.</p></div>
                <label class="relative block w-full md:max-w-xs"><span class="sr-only">Cari pengumuman</span><i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i><input id="searchPengumuman" type="search" placeholder="Cari pengumuman..." class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition focus:border-[#d9a928] focus:ring-4 focus:ring-[#d9a928]/10"></label>
            </div>
            <div id="announcementFilters" class="mt-8 flex gap-2 overflow-x-auto pb-2">
                <button type="button" data-filter="all" class="filter-button shrink-0 rounded-full border border-[#0b2945] bg-[#0b2945] px-4 py-2 text-xs font-bold text-white">Semua</button>
                @foreach ($categoryLabels as $value => $label)<button type="button" data-filter="{{ $value }}" class="filter-button shrink-0 rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-[#d9a928] hover:text-[#0b2945]">{{ $label }}</button>@endforeach
            </div>

            @if ($announcements->isNotEmpty())
                <div id="announcementGrid" class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($announcements as $pengumuman)
                        <article class="announcement-card group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl" data-category="{{ $pengumuman->jenis }}" data-search="{{ strtolower($pengumuman->judul.' '.strip_tags($pengumuman->isi)) }}">
                            @if ($pengumuman->gambar)<div class="h-48 overflow-hidden bg-slate-100"><img src="{{ asset('storage/pengumuman/'.$pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105"></div>@else<div class="flex h-48 items-center justify-center bg-[#0b2945] text-[#d9a928]"><i class="fas fa-bullhorn text-4xl"></i></div>@endif
                            <div class="flex flex-1 flex-col p-5"><div class="flex items-center justify-between gap-3"><span class="rounded-full bg-[#fff8df] px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-[#8a6810]">{{ $categoryLabels[$pengumuman->jenis] ?? ucfirst($pengumuman->jenis) }}</span><time class="shrink-0 text-xs text-slate-400">{{ ($pengumuman->tanggal_publish ?? $pengumuman->created_at)->format('d M Y') }}</time></div><h3 class="mt-4 line-clamp-2 text-lg font-bold leading-snug text-[#0b2945]">{{ $pengumuman->judul }}</h3><p class="mt-3 line-clamp-3 flex-1 text-sm leading-6 text-slate-500">{{ Str::limit(strip_tags($pengumuman->isi), 130) }}</p><a href="{{ route('pengumuman.show', $pengumuman) }}" class="mt-5 inline-flex items-center text-sm font-bold text-[#0b2945] transition group-hover:text-[#b48712]">Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-xs"></i></a></div>
                        </article>
                    @endforeach
                </div>
                <div id="noSearchResults" class="mt-8 hidden rounded-2xl border border-slate-200 bg-white px-6 py-12 text-center"><h3 class="font-bold text-[#0b2945]">Pengumuman tidak ditemukan</h3><p class="mt-2 text-sm text-slate-500">Coba gunakan kata kunci lain.</p></div>
            @else
                <div class="mt-8 rounded-2xl border border-slate-200 bg-white px-6 py-14 text-center"><h3 class="font-bold text-[#0b2945]">Belum ada pengumuman</h3><p class="mt-2 text-sm text-slate-500">Saat ini belum ada informasi yang tersedia.</p></div>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = [...document.querySelectorAll('.announcement-card')];
            const buttons = [...document.querySelectorAll('.filter-button')];
            const search = document.getElementById('searchPengumuman');
            const empty = document.getElementById('noSearchResults');
            let category = 'all';
            function filterCards() {
                const query = (search?.value || '').toLowerCase().trim();
                let visible = 0;
                cards.forEach((card) => { const match = (category === 'all' || card.dataset.category === category) && card.dataset.search.includes(query); card.classList.toggle('hidden', !match); if (match) visible++; });
                empty?.classList.toggle('hidden', visible > 0);
            }
            buttons.forEach((button) => button.addEventListener('click', () => { category = button.dataset.filter; buttons.forEach((item) => item.classList.toggle('bg-[#0b2945]', item === button)); buttons.forEach((item) => item.classList.toggle('text-white', item === button)); filterCards(); }));
            search?.addEventListener('input', filterCards);
        });
    </script>
@endsection