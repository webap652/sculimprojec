@extends('layouts.app')

@section('title', 'Sejarah Sekolah - SMP NEGERI 1 PIRIME')
@section('description', 'Sejarah berdirinya SMP Negeri 1 Pirime, perkembangan, dan perjalanan sekolah dari masa ke
    masa.')

@section('hero')
    @php $breadcrumb = ['Beranda', 'Profil', 'Sejarah Sekolah']; @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'SEJARAH SEKOLAH',
        'desc' => 'Perjalanan panjang SMP Negeri 1 Pirime dalam mencetak generasi penerus bangsa.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        @include('profil.partials.sidebar')

        @if ($sejarahs->count() > 0)
            {{-- Header Section --}}
            <div class="text-center mb-14" data-aos="fade-up">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 text-primary-700 text-sm font-medium border border-primary-200 mb-4">
                    <i class="fas fa-clock-rotate-left"></i>
                    <span>Perjalanan & Sejarah</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-3">Kilas Balik SMP Negeri 1 Pirime</h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-primary-500 to-accent-500 mx-auto rounded-full mb-4"></div>
                <p class="text-slate-500 max-w-2xl mx-auto text-base">
                    Menelusuri jejak langkah dan perjalanan panjang sekolah dari masa ke masa.
                </p>
            </div>

            {{-- Timeline Section --}}
            <section class="relative" data-aos="fade-up" data-aos-delay="100">

                {{-- Decorative Elements --}}
                <div class="absolute -top-20 -left-20 w-72 h-72 bg-primary-100/40 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -right-20 w-72 h-72 bg-accent-100/40 rounded-full blur-3xl"></div>

                <div class="relative">

                    {{-- Timeline Vertical Line (Desktop) --}}
                    <div
                        class="hidden md:block absolute left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-primary-300 via-primary-400 to-primary-300 -translate-x-1/2 rounded-full">
                        {{-- Pulse dot at start --}}
                        <div
                            class="absolute -top-1 left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-primary-500 animate-ping opacity-75">
                        </div>
                        <div
                            class="absolute -top-1 left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-primary-600 border-2 border-white">
                        </div>
                    </div>

                    {{-- Timeline Items --}}
                    <div class="space-y-10 md:space-y-16">
                        @foreach ($sejarahs as $index => $sejarah)
                            @php
                                $isLeft = $index % 2 == 0;
                                $hasImages =
                                    isset($sejarah->galeri) &&
                                    is_array($sejarah->galeri) &&
                                    count($sejarah->galeri) > 0;
                            @endphp

                            <div class="relative group">
                                {{-- Year Badge --}}
                                <div class="flex justify-center mb-6 md:mb-0 relative z-20">
                                    <div
                                        class="hidden md:flex absolute left-1/2 -translate-x-1/2 -top-0 w-14 h-14 rounded-full bg-gradient-to-br from-primary-600 to-primary-800 text-white items-center justify-center shadow-xl shadow-primary-500/30 border-4 border-white ring-2 ring-primary-200 z-20 transition-all duration-300 group-hover:scale-110 group-hover:shadow-primary-500/50">
                                        <span class="text-xs font-black leading-tight text-center">
                                            {{ substr($sejarah->tahun, 2, 2) }}<br>
                                            <span
                                                class="text-[9px] font-normal opacity-75">{{ substr($sejarah->tahun, 0, 2) }}</span>
                                        </span>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col md:flex-row items-center gap-0 md:gap-8 {{ $isLeft ? '' : 'md:flex-row-reverse' }}">

                                    {{-- Content Card --}}
                                    <div class="w-full md:w-[calc(50%-40px)] {{ $isLeft ? 'md:text-right' : 'md:text-left' }}"
                                        data-aos="{{ $isLeft ? 'fade-right' : 'fade-left' }}"
                                        data-aos-delay="{{ 100 + $index * 50 }}">

                                        {{-- Mobile Year Badge --}}
                                        <div class="md:hidden flex items-center gap-3 mb-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-600 to-primary-800 text-white flex items-center justify-center text-sm font-black shadow-lg flex-shrink-0">
                                                {{ $sejarah->tahun ?? '?' }}
                                            </div>
                                            <div class="h-0.5 flex-1 bg-gradient-to-r from-primary-300 to-transparent">
                                            </div>
                                        </div>

                                        <div
                                            class="relative bg-white rounded-2xl p-6 sm:p-8 shadow-[0_8px_30px_-4px_rgba(0,0,0,0.08)] border border-slate-100 hover:shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15)] transition-all duration-500 group/card {{ $isLeft ? 'md:mr-0' : 'md:ml-0' }}">

                                            {{-- Gradient top accent --}}
                                            <div
                                                class="absolute top-0 {{ $isLeft ? 'right-0' : 'left-0' }} w-24 h-1 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full">
                                            </div>

                                            {{-- Desktop Year Chip --}}
                                            <div
                                                class="hidden md:flex items-center gap-2 {{ $isLeft ? 'justify-end' : 'justify-start' }} mb-4">
                                                <span
                                                    class="px-3 py-1 rounded-lg bg-primary-50 text-primary-700 text-sm font-bold border border-primary-200">
                                                    <i class="fas fa-calendar-alt mr-1.5 text-xs"></i>{{ $sejarah->tahun }}
                                                </span>
                                            </div>

                                            {{-- Title --}}
                                            <h3
                                                class="text-xl sm:text-2xl font-extrabold text-slate-800 mb-3 group-hover/card:text-primary-700 transition-colors duration-300">
                                                {{ $sejarah->judul }}
                                            </h3>

                                            {{-- Description --}}
                                            @if ($sejarah->deskripsi)
                                                <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                                                    {{ $sejarah->deskripsi }}
                                                </p>
                                            @endif

                                            {{-- Images Gallery --}}
                                            @if ($hasImages)
                                                <div class="mt-5 {{ $isLeft ? 'md:flex md:justify-end' : '' }}">
                                                    <div
                                                        class="flex gap-2 flex-wrap {{ $isLeft ? 'md:flex-row-reverse' : '' }}">
                                                        @foreach (array_slice($sejarah->galeri, 0, 4) as $img)
                                                            <div
                                                                class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-xl overflow-hidden border-2 border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer group/img">
                                                                <img src="{{ asset('storage/' . $img) }}"
                                                                    alt="Galeri {{ $sejarah->judul }}"
                                                                    class="w-full h-full object-cover group-hover/img:scale-110 transition-transform duration-500">
                                                            </div>
                                                        @endforeach
                                                        @if (count($sejarah->galeri) > 4)
                                                            <div
                                                                class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl bg-slate-100 border-2 border-slate-200 flex items-center justify-center text-slate-500 text-xs font-bold hover:bg-slate-200 transition-colors cursor-pointer">
                                                                +{{ count($sejarah->galeri) - 4 }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Index Number Decoration --}}
                                            <div
                                                class="absolute {{ $isLeft ? 'left-3' : 'right-3' }} bottom-3 text-6xl sm:text-7xl font-black text-slate-100/60 select-none pointer-events-none leading-none">
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Empty space for the other side (desktop) --}}
                                    <div class="hidden md:block w-[calc(50%-40px)]"></div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Timeline End Decoration --}}
                    <div class="flex justify-center mt-14">
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-primary-400 ring-4 ring-primary-100 animate-pulse"></div>
                            <div class="w-0.5 h-12 bg-gradient-to-b from-primary-300 to-transparent"></div>
                            <span class="text-xs text-slate-400 font-medium tracking-wider">TERUS BERKARYA</span>
                        </div>
                    </div>

                </div>
            </section>

            {{-- CTA Section --}}
            <div class="mt-16" data-aos="fade-up">
                <div
                    class="relative bg-gradient-to-r from-primary-900 via-primary-700 to-primary-600 rounded-3xl p-8 md:p-12 overflow-hidden shadow-2xl">
                    {{-- Background decoration --}}
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-20 -mt-20"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-16 -mb-16"></div>
                    <div
                        class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(255,255,255,0.05)_0%,transparent_50%)]">
                    </div>

                    <div class="relative z-10 text-center">
                        <i class="fas fa-quote-left text-4xl text-accent-500/80 mb-4 block"></i>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-3">Menulis Sejarah Baru</h3>
                        <p class="text-blue-200 text-sm sm:text-base max-w-2xl mx-auto mb-6">
                            Setiap hari adalah kesempatan untuk menorehkan prestasi dan melanjutkan perjalanan mulia
                            dalam mendidik generasi penerus bangsa.
                        </p>
                        <div class="w-16 h-1 bg-accent-500 mx-auto rounded-full"></div>
                    </div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-20 px-4">
                <div class="relative mb-8" data-aos="fade-up">
                    <div
                        class="w-28 h-28 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center shadow-inner">
                        <i class="fas fa-clock-rotate-left text-5xl text-slate-400"></i>
                    </div>
                    <div
                        class="absolute -top-2 -right-2 w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center animate-pulse">
                        <i class="fas fa-pen text-primary-500 text-sm"></i>
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-slate-700 mb-2" data-aos="fade-up" data-aos-delay="50">Sejarah Belum
                    Tersedia</h3>
                <p class="text-slate-400 text-center max-w-md mb-6" data-aos="fade-up" data-aos-delay="100">
                    Tim sekolah sedang menyusun dan mendokumentasikan perjalanan sejarah sekolah.
                    Silakan kembali lagi nanti.
                </p>
                <div class="flex items-center gap-2 text-sm text-slate-400" data-aos="fade-up" data-aos-delay="150">
                    <i class="fas fa-spinner-third animate-spin"></i>
                    <span>Segera hadir...</span>
                </div>

                {{-- Decorative dots --}}
                <div class="flex gap-3 mt-10">
                    <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                    <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                    <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                </div>
            </div>
        @endif

    </div>
@endsection

@push('styles')
    <style>
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar for timeline */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Timeline card hover effect */
        .group\/card {
            position: relative;
            overflow: hidden;
        }

        .group\/card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.02) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
        }

        .group\/card:hover::before {
            opacity: 1;
        }

        /* Image gallery hover */
        .group\/img {
            overflow: hidden;
        }

        /* Pulse animation for timeline end */
        @keyframes pulse-soft {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.5);
                opacity: 0.2;
            }
        }

        .animate-pulse-soft {
            animation: pulse-soft 2s ease-in-out infinite;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 600,
            easing: 'ease-out-cubic'
        });
    </script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush
