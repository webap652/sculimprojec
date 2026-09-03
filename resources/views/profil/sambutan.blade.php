@extends('layouts.app')

@section('title', 'Sambutan Kepala Sekolah - SMP NEGERI 1 PIRIME')
@section('description', 'Sambutan Kepala Sekolah SMP Negeri 1 Pirime.')

@section('hero')
    @php $breadcrumb = ['Beranda', 'Profil', 'Sambutan Kepala Sekolah']; @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'SAMBUTAN KEPALA SEKOLAH',
        'desc' => 'Sambutan dan harapan Kepala SMP Negeri 1 Pirime untuk kemajuan pendidikan di Lanny Jaya.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Sub Navigation Horizontal --}}
        @include('profil.partials.sidebar')

        {{-- Main Content --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden"
            data-aos="fade-up">

            {{-- Header Profil Kepsek --}}
            <div
                class="bg-gradient-to-br from-primary-700 via-primary-600 to-primary-800 p-8 md:p-16 text-center relative overflow-hidden">
                <!-- Ornamen Latar Belakang Abstrak -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-black/10 rounded-full blur-2xl -ml-16 -mb-16"></div>

                <div class="relative z-10">
                    <!-- Foto Profil Animasi -->
                    <div
                        class="w-36 h-36 mx-auto rounded-full border-4 border-white/20 shadow-2xl overflow-hidden mb-6 relative group">
                        <div
                            class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300 z-10">
                        </div>
                        @if ($data['foto_kepsek'])
                            <img src="{{ asset('storage/' . $data['foto_kepsek']) }}" alt="{{ $data['kepala_sekolah'] }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                onerror="this.src='https://ui-avatars.com/api/?name='+encodeURIComponent('{{ $data['kepala_sekolah'] }}')+'&background=2563eb&color=fff&size=128'">
                        @else
                            <div class="w-full h-full bg-primary-500 flex items-center justify-center">
                                <i class="fas fa-user-tie text-white text-5xl"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Nama & Jabatan -->
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">{{ $data['kepala_sekolah'] }}
                    </h1>
                    <p class="text-primary-100 mt-2 font-medium tracking-wide uppercase text-sm">Kepala Sekolah</p>

                    @if ($data['nip_kepsek'])
                        <div
                            class="inline-block mt-4 px-5 py-1.5 bg-black/20 backdrop-blur-sm rounded-full border border-white/10">
                            <p class="text-white text-xs font-mono tracking-widest">NIP. {{ $data['nip_kepsek'] }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Body Content --}}
            <div class="p-8 md:p-12 lg:p-16 relative">
                <div class="max-w-4xl mx-auto">

                    <!-- Judul Section -->
                    <div class="flex flex-col items-center justify-center text-center mb-12">
                        <div
                            class="w-16 h-16 rounded-2xl bg-primary-50 flex items-center justify-center text-primary-600 mb-4 shadow-sm border border-primary-100 rotate-3 hover:rotate-0 transition-transform">
                            <i class="fas fa-quote-right text-2xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-slate-800">Pesan & Sambutan</h2>
                        <div class="w-20 h-1.5 bg-gradient-to-r from-primary-400 to-primary-600 rounded-full mt-4"></div>
                    </div>

                    <!-- Kotak Sambutan Moderen -->
                    <div
                        class="relative bg-white rounded-2xl p-8 md:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 mb-12 group hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-shadow duration-300">
                        <!-- Icon Quote Latar -->
                        <i
                            class="fas fa-quote-left absolute -top-5 -left-2 md:-left-6 text-6xl text-primary-500/10 group-hover:text-primary-500/20 transition-colors duration-300 transform -rotate-12 group-hover:rotate-0"></i>

                        <!-- Isi Teks (Menggunakan nl2br agar paragraf tetap rapi) -->
                        <div class="relative z-10 text-lg md:text-xl text-slate-600 leading-loose italic">
                            {!! nl2br(e($data['sambutan'])) !!}
                        </div>
                    </div>

                    <!-- Grid Visi & Harapan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                        <!-- Harapan Box -->
                        @if ($data['harapan'])
                            <div
                                class="bg-gradient-to-br from-emerald-50 to-teal-50/50 rounded-2xl p-8 border border-emerald-100/50 hover:border-emerald-200 transition-colors">
                                <div class="flex items-center gap-4 mb-5">
                                    <div
                                        class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shadow-sm">
                                        <i class="fas fa-seedling text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-800">Harapan Kedepan</h3>
                                </div>
                                <p class="text-slate-600 leading-relaxed text-justify">{{ $data['harapan'] }}</p>
                            </div>
                        @endif

                        <!-- Visi Box -->
                        <div
                            class="bg-gradient-to-br from-blue-50 to-indigo-50/50 rounded-2xl p-8 border border-blue-100/50 hover:border-blue-200 transition-colors">
                            <div class="flex items-center gap-4 mb-5">
                                <div
                                    class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shadow-sm">
                                    <i class="fas fa-eye text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800">Visi Pendidikan</h3>
                            </div>
                            <p class="text-slate-600 leading-relaxed text-justify italic">"{{ $data['visi'] }}"</p>
                        </div>
                    </div>

                    <!-- Area Tanda Tangan -->
                    <div class="flex flex-col items-end justify-center pt-8 border-t border-slate-100/80">
                        <p class="text-slate-500 text-sm mb-4">Hormat saya,</p>
                        @if ($data['foto_kepsek'])
                            <div class="relative mb-4 group cursor-default">
                                <div
                                    class="absolute inset-0 bg-primary-400 rounded-full blur-md opacity-30 group-hover:opacity-50 transition-opacity">
                                </div>
                                <img src="{{ asset('storage/' . $data['foto_kepsek']) }}"
                                    class="relative h-20 w-20 rounded-full object-cover border-4 border-white shadow-md"
                                    onerror="this.style.display='none'">
                            </div>
                        @endif
                        <h4 class="font-extrabold text-slate-800 text-xl">{{ $data['kepala_sekolah'] }}</h4>
                        <p class="text-sm font-semibold text-primary-600 mt-1">Kepala SMP Negeri 1 Pirime</p>
                        @if ($data['nip_kepsek'])
                            <p class="text-xs text-slate-400 mt-1 font-mono">NIP. {{ $data['nip_kepsek'] }}</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
