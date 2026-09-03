@extends('layouts.app')

@section('title', 'Galeri - SMP NEGERI 1 PIRIME')
@section('description', 'Kumpulan momen dan kegiatan SMP Negeri 1 Pirime.')

@section('hero')
    @php $breadcrumb = ['Beranda', 'Galeri']; @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'GALERI',
        'desc' => 'Kumpulan momen dan dokumentasi kegiatan di SMP Negeri 1 Pirime.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    <section class="py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-10" data-aos="fade-up">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold border border-primary-100 mb-4">
                    <i class="fas fa-images text-gold-500"></i>
                    <span>Dokumentasi Kegiatan</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900">Galeri Sekolah</h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-primary-500 to-gold-500 mx-auto rounded-full mt-4"></div>
                <p class="mt-4 text-slate-500 max-w-2xl mx-auto">Kumpulan momen dan dokumentasi kegiatan di SMP Negeri 1
                    Pirime.</p>
            </div>
            {{-- Search & Filter --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8" data-aos="fade-up">
                <div class="flex flex-wrap gap-2 justify-center">
                    @if (isset($kategoriList) && $kategoriList->count() > 0)
                        <button onclick="filterGaleri('all')"
                            class="galeri-filter active px-5 py-2.5 rounded-full text-sm font-medium bg-gradient-to-r from-primary-700 to-primary-900 text-white transition-all shadow-lg shadow-primary-900/20">Semua</button>
                        @foreach ($kategoriList as $kategori)
                            <button onclick="filterGaleri('{{ $kategori }}')"
                                class="galeri-filter px-5 py-2.5 rounded-full text-sm font-medium bg-white text-slate-600 border border-slate-200 hover:bg-primary-50 hover:text-primary-700 hover:border-primary-300 transition-all">{{ $kategori }}</button>
                        @endforeach
                    @endif
                </div>
                <div class="relative w-full md:w-72">
                    <input type="text" id="searchGaleri" placeholder="Cari galeri..." oninput="searchGaleri(this.value)"
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none transition text-sm bg-white">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                </div>
            </div>

            <!-- Masonry Grid -->
            @if ($galeris->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="galeriGrid">
                    @foreach ($galeris as $galeri)
                        <div class="galeri-item relative rounded-2xl overflow-hidden group cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300 {{ $galeri->kategori ? 'kat-' . $galeri->kategori : '' }}"
                            data-kategori="{{ $galeri->kategori ?? 'all' }}" data-aos="zoom-in"
                            data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                                <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                    alt="{{ $galeri->judul ?? 'Foto Galeri' }}"
                                    class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                                    loading="lazy"
                                    onclick="openLightbox(this.src, '{{ addslashes($galeri->judul) }}', '{{ addslashes($galeri->deskripsi) }}')">
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-5">
                                <h3 class="text-white font-bold text-sm drop-shadow-lg">{{ $galeri->judul ?? 'Galeri' }}
                                </h3>
                                @if ($galeri->deskripsi)
                                    <p class="text-white/80 text-xs mt-1 line-clamp-2">{{ $galeri->deskripsi }}</p>
                                @endif
                                <span
                                    class="inline-block mt-2 text-[10px] uppercase tracking-wider text-primary-300 font-semibold">{{ $galeri->kategori ?? 'Umum' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10" data-aos="fade-up">
                    {{ $galeris->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-16 text-center" data-aos="fade-up">
                    <div class="w-24 h-24 mx-auto rounded-full bg-slate-100 flex items-center justify-center mb-5">
                        <i class="far fa-images text-4xl text-slate-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-600">Galeri Belum Tersedia</h3>
                    <p class="text-slate-400 mt-2">Admin sekolah akan segera mengupload dokumentasi kegiatan.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightboxModal"
        class="fixed inset-0 z-[100] hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4"
        onclick="closeLightbox(event)">
        <button onclick="closeLightbox()"
            class="absolute top-6 right-6 text-white/70 hover:text-white text-3xl transition z-10"><i
                class="fas fa-times"></i></button>
        <div class="max-w-4xl max-h-[90vh] w-full" onclick="event.stopPropagation()">
            <img id="lightboxImage" src="" class="w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl"
                alt="">
            <div class="mt-4 text-center">
                <h3 id="lightboxTitle" class="text-white text-xl font-bold"></h3>
                <p id="lightboxDesc" class="text-white/70 text-sm mt-1"></p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Filter Gallery
        function filterGaleri(kategori) {
            document.querySelectorAll('.galeri-filter').forEach(btn => {
                btn.classList.remove('bg-gradient-to-r', 'from-primary-700', 'to-primary-900', 'text-white',
                    'shadow-lg', 'shadow-primary-900/20');
                btn.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            });
            if (event && event.target) {
                event.target.classList.add('bg-gradient-to-r', 'from-primary-700', 'to-primary-900', 'text-white',
                    'shadow-lg', 'shadow-primary-900/20');
                event.target.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            }

            document.querySelectorAll('.galeri-item').forEach(item => {
                if (kategori === 'all' || item.dataset.kategori === kategori) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function searchGaleri(q) {
            const query = q.toLowerCase().trim();
            document.querySelectorAll('.galeri-item').forEach(item => {
                const title = (item.querySelector('h3')?.textContent || '').toLowerCase();
                const kat = (item.dataset.kategori || '').toLowerCase();
                const match = !query || title.includes(query) || kat.includes(query);
                item.style.display = match ? 'block' : 'none';
            });
        }

        // Lightbox
        function openLightbox(src, title, desc) {
            document.getElementById('lightboxImage').src = src;
            document.getElementById('lightboxTitle').textContent = title || '';
            document.getElementById('lightboxDesc').textContent = desc || '';
            document.getElementById('lightboxModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox(e) {
            if (e && e.target !== e.currentTarget && e.target.id !== 'lightboxModal') return;
            document.getElementById('lightboxModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Keyboard Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
@endpush
