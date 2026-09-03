@extends('layouts.app')

@section('title', 'Visi & Misi - SMP NEGERI 1 PIRIME')
@section('description', 'Visi, misi, tujuan sekolah, dan moto SMP Negeri 1 Pirime - Mewujudkan peserta didik yang
    Beriman, Berilmu, Berkarakter, dan Peduli Lingkungan.')

@section('hero')
    @php $breadcrumb = ['Beranda', 'Profil', 'Visi & Misi']; @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'VISI & MISI',
        'desc' =>
            'Visi, misi, tujuan, dan moto SMP Negeri 1 Pirime sebagai pedoman dalam mencetak Generasi Emas Lanny Jaya.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @include('profil.partials.sidebar')
        <div class="space-y-10">

            {{-- VISI --}}
            <section
                class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 rounded-2xl p-8 md:p-12 text-white relative overflow-hidden"
                data-aos="fade-up">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-16 -mb-16"></div>
                <div class="relative z-10 text-center">
                    <div
                        class="w-20 h-20 mx-auto bg-accent-500 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-eye text-white text-3xl"></i>
                    </div>
                    <span
                        class="bg-white/20 text-white text-xs font-bold uppercase px-4 py-1.5 rounded-full tracking-wider">Visi
                        Kami</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mt-6 mb-6">Visi SMP Negeri 1 Pirime</h2>
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 md:p-8 border border-white/20">
                            <i class="fas fa-quote-left text-3xl text-accent-500 mb-4 block opacity-50"></i>
                            <p class="text-xl md:text-2xl font-semibold leading-relaxed text-white italic">
                                "{{ $data['visi'] }}"</p>
                            <i class="fas fa-quote-right text-3xl text-accent-500 mt-4 block opacity-50"></i>
                        </div>
                    </div>
                </div>
            </section>

            {{-- MISI --}}
            <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600">
                        <i class="fas fa-bullseye text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Misi Sekolah</h2>
                        <div class="w-16 h-1 bg-amber-500 rounded-full mt-2"></div>
                    </div>
                </div>
                @if (count($data['misi']) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($data['misi'] as $index => $misi)
                            <div
                                class="p-5 rounded-xl border border-slate-100 hover:shadow-md transition bg-gradient-to-br from-white to-amber-50/50 flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0 text-sm font-bold">
                                    {{ $index + 1 }}</div>
                                <p class="text-slate-700 leading-relaxed">{{ $misi }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-slate-500 text-center py-8">Data misi belum tersedia.</p>
                @endif
            </section>

            {{-- Tujuan Sekolah --}}
            @if (!empty($goals))
                <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8" data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <i class="fas fa-flag-checkered text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">Tujuan Sekolah</h2>
                            <div class="w-16 h-1 bg-emerald-500 rounded-full mt-2"></div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-emerald-200 hidden md:block"></div>
                        <div class="space-y-6">
                            @foreach ($goals as $index => $goal)
                                <div class="relative pl-0 md:pl-16">
                                    <div
                                        class="absolute left-0 top-1 w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold hidden md:flex border-4 border-white shadow">
                                        {{ $index + 1 }}</div>
                                    <div
                                        class="p-5 rounded-xl bg-emerald-50/50 border border-emerald-100 hover:shadow-md transition">
                                        <p class="text-slate-700 leading-relaxed">{{ $goal }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            {{-- MOTO --}}
            <section
                class="bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 rounded-2xl p-8 md:p-12 text-center relative overflow-hidden"
                data-aos="fade-up">
                <div class="relative z-10">
                    <span
                        class="bg-accent-500 text-white text-xs font-bold uppercase px-4 py-1.5 rounded-full tracking-wider">Moto</span>
                    <div class="mt-6 max-w-3xl mx-auto">
                        <i class="fas fa-quote-left text-4xl text-accent-500 mb-4 block opacity-30"></i>
                        <p class="text-2xl md:text-3xl font-extrabold text-white leading-tight">"{{ $data['moto'] }}"</p>
                        <div class="w-24 h-1 bg-accent-500 mx-auto mt-6 rounded-full"></div>
                        <p class="text-slate-400 mt-4 text-sm">Moto SMP Negeri 1 Pirime</p>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
