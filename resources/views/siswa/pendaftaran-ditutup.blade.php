@extends('siswa.layout')

@section('title', 'Pendaftaran Ditutup')
@section('pageTitle', 'Pendaftaran Ditutup')

@section('content')
    <div class="mx-auto flex min-h-[60vh] max-w-2xl items-center justify-center py-10">
        <section class="w-full rounded-3xl border border-rose-100 bg-white p-8 text-center shadow-xl sm:p-12">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-rose-50 text-rose-600"><i class="fas fa-lock text-3xl"></i></div>
            <p class="mt-6 text-xs font-bold uppercase tracking-[.2em] text-rose-600">PPDB / SPMB {{ $academicYear }}</p>
            <h1 class="mt-3 text-3xl font-extrabold text-[#0A2540]">Pendaftaran Ditutup</h1>
            <p class="mx-auto mt-4 max-w-lg leading-relaxed text-slate-600">{{ $closeMessage }}</p>
            <a href="{{ route('home') }}" class="mt-8 inline-flex items-center gap-2 rounded-xl bg-[#0A2540] px-5 py-3 font-bold text-white hover:bg-[#173A63]"><i class="fas fa-arrow-left"></i>Kembali ke Beranda</a>
        </section>
    </div>
@endsection
