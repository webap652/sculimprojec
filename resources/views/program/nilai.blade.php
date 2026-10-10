@extends('layouts.app')

@section('title', 'Nilai-Nilai Sekolah - SMP Negeri 1 Pirime')
@section('description', 'Nilai-nilai utama yang menjadi budaya belajar dan kehidupan warga SMP Negeri 1 Pirime.')

@section('hero')
    @include('layouts.partials.public-hero', [
        'title' => 'NILAI-NILAI SEKOLAH',
        'desc' => 'Budaya yang menuntun warga sekolah untuk belajar, bertumbuh, dan melayani dengan karakter.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => ['Beranda', 'Program', 'Nilai-Nilai Sekolah'],
    ])
@endsection

@section('content')
    <div class="bg-[#F4F7FB] py-14 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 rounded-full border border-[#D4AF37]/30 bg-[#D4AF37]/10 px-4 py-2 text-xs font-bold uppercase tracking-[.18em] text-[#8A6810]"><i class="fas fa-star"></i> Budaya Sekolah</span>
                <h2 class="mt-4 text-3xl font-extrabold text-[#0A2540] sm:text-4xl">Nilai-Nilai Sekolah</h2>
                <p class="mt-4 text-base leading-relaxed text-slate-600">Cerdas, Mandiri, Berkarakter menjadi semangat bersama dalam membangun lingkungan belajar yang beriman, inklusif, dan peduli.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($values as $index => $value)
                    <article class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-[#D4AF37]/50 hover:shadow-lg" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 60 }}">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#173A63] text-[#D4AF37] transition group-hover:bg-[#0A2540]"><i class="fas fa-{{ $value['icon'] }} text-lg"></i></div>
                        <h3 class="mt-5 text-lg font-bold text-[#0A2540]">{{ $value['name'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $value['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
