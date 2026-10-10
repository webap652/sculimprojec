@extends('layouts.app')

@section('title', 'Program Unggulan SMPN 1 Pirime')
@section('description', 'Program unggulan SMP Negeri 1 Pirime yang dikembangkan sesuai kondisi daerah 3T, potensi peserta didik, lingkungan sekolah, dan budaya lokal Lanny Jaya.')

@section('hero')
    @include('layouts.partials.public-hero', [
        'title' => 'PROGRAM UNGGULAN',
        'desc' => 'Cerdas, mandiri, dan berkarakter melalui pengalaman belajar yang dekat dengan lingkungan dan budaya lokal.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => ['Beranda', 'Program', 'Program Unggulan'],
    ])
@endsection

@section('content')
    <div class="bg-[#F4F7FB] py-14 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 rounded-full border border-[#D4AF37]/30 bg-[#D4AF37]/10 px-4 py-2 text-xs font-bold uppercase tracking-[.18em] text-[#8A6810]"><i class="fas fa-lightbulb"></i> Program Sekolah</span>
                <h2 class="mt-4 text-3xl font-extrabold text-[#0A2540] sm:text-4xl">Program Unggulan SMPN 1 Pirime</h2>
                <p class="mt-4 text-base leading-relaxed text-slate-600">Program unggulan yang dikembangkan sesuai dengan kondisi daerah 3T, potensi peserta didik, lingkungan sekolah, serta budaya lokal masyarakat Lanny Jaya.</p>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($programs as $index => $program)
                    <article class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-[#D4AF37]/50 hover:shadow-xl" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 80 }}">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#0A2540] text-[#D4AF37] transition group-hover:bg-[#173A63]"><i class="fas fa-{{ $program['icon'] }} text-xl"></i></div>
                            <span class="text-3xl font-black text-slate-100">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-[#0A2540]">{{ $program['name'] }}</h3>
                        <div class="mt-3 h-1 w-12 rounded-full bg-[#D4AF37]"></div>
                        <p class="mt-5 text-sm leading-7 text-slate-600">{{ $program['desc'] }}</p>
                    </article>
                @endforeach
            </div>

            <section class="mt-14 overflow-hidden rounded-3xl bg-[#0A2540] px-6 py-10 text-center text-white shadow-xl sm:px-12" data-aos="fade-up">
                <i class="fas fa-seedling text-3xl text-[#D4AF37]"></i>
                <h2 class="mt-4 text-2xl font-extrabold sm:text-3xl">Belajar dari Lingkungan, Tumbuh Bersama Budaya</h2>
                <p class="mx-auto mt-4 max-w-3xl leading-7 text-slate-200">Program unggulan SMP Negeri 1 Pirime menjadi bagian dari upaya membentuk peserta didik yang cerdas, mandiri, berkarakter, berbudaya, tangguh, dan mampu menghadapi tantangan masa depan.</p>
            </section>
        </div>
    </div>
@endsection
