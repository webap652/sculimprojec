@extends('siswa.layout')
@section('title', 'Pengumuman')
@section('pageTitle', 'Pengumuman')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Header --}}
        <div
            class="relative bg-gradient-to-r from-indigo-700 via-indigo-600 to-brand-700 rounded-2xl shadow-sm p-6 sm:p-8 overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
            </div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center">
                    <i class="fas fa-bullhorn text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-white">Pengumuman</h1>
                    <p class="text-indigo-100 text-sm">Informasi terbaru dari SMP NEGERI 1 PIRIME</p>
                </div>
            </div>
        </div>

        @if ($pengumumans->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($pengumumans as $pengumuman)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-all hover:-translate-y-1 flex flex-col">
                        @if ($pengumuman->gambar)
                            <div class="h-44 overflow-hidden">
                                <img src="{{ asset('storage/pengumuman/' . $pengumuman->gambar) }}"
                                    alt="{{ $pengumuman->judul }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div
                                class="h-44 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                <i class="fas fa-bullhorn text-5xl text-slate-300"></i>
                            </div>
                        @endif

                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center justify-between mb-3">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                @if ($pengumuman->jenis == 'penting') bg-rose-100 text-rose-700
                                @elseif($pengumuman->jenis == 'pengumuman') bg-indigo-100 text-indigo-700
                                @else bg-emerald-100 text-emerald-700 @endif">
                                    <i
                                        class="fas fa-{{ $pengumuman->jenis == 'penting' ? 'exclamation-triangle' : ($pengumuman->jenis == 'pengumuman' ? 'bullhorn' : 'info-circle') }} mr-1"></i>
                                    {{ ucfirst($pengumuman->jenis) }}
                                </span>
                                <span class="text-xs text-slate-400">
                                    {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y') : $pengumuman->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2">{{ $pengumuman->judul }}</h3>
                            <p class="text-slate-500 text-sm mb-4 line-clamp-3 flex-1">
                                {{ Str::limit($pengumuman->isi, 150) }}</p>

                            <button
                                class="w-full bg-indigo-600 text-white py-2.5 px-4 rounded-xl hover:bg-indigo-700 transition font-semibold text-sm flex items-center justify-center"
                                data-bs-toggle="modal" data-bs-target="#pengumumanModal{{ $pengumuman->id }}">
                                <i class="fas fa-eye mr-2"></i> Baca Selengkapnya
                            </button>
                        </div>
                    </div>

                    {{-- Modal --}}
                    <div class="modal fade" id="pengumumanModal{{ $pengumuman->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content rounded-2xl">
                                <div class="modal-header border-b border-slate-100">
                                    <h5 class="modal-title font-bold text-slate-900">{{ $pengumuman->judul }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($pengumuman->gambar)
                                        <div class="mb-4">
                                            <img src="{{ asset('storage/pengumuman/' . $pengumuman->gambar) }}"
                                                alt="{{ $pengumuman->judul }}" class="w-full rounded-xl">
                                        </div>
                                    @endif
                                    <div class="flex items-center space-x-4 mb-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                        @if ($pengumuman->jenis == 'penting') bg-rose-100 text-rose-700
                                        @elseif($pengumuman->jenis == 'pengumuman') bg-indigo-100 text-indigo-700
                                        @else bg-emerald-100 text-emerald-700 @endif">
                                            <i
                                                class="fas fa-{{ $pengumuman->jenis == 'penting' ? 'exclamation-triangle' : ($pengumuman->jenis == 'pengumuman' ? 'bullhorn' : 'info-circle') }} mr-1"></i>
                                            {{ ucfirst($pengumuman->jenis) }}
                                        </span>
                                        <span class="text-sm text-slate-500">
                                            Dipublikasikan:
                                            {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y H:i') : $pengumuman->created_at->format('d M Y H:i') }}
                                        </span>
                                    </div>
                                    <div class="text-slate-700 leading-relaxed">
                                        {!! nl2br(e($pengumuman->isi)) !!}
                                    </div>
                                </div>
                                <div class="modal-footer border-t border-slate-100">
                                    <button type="button"
                                        class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 text-center">
                <div class="mx-auto w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-bullhorn text-2xl text-indigo-600"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Pengumuman</h3>
                <p class="text-slate-500 text-sm">Saat ini belum ada pengumuman yang tersedia. Silakan kembali lagi nanti.
                </p>
            </div>
        @endif
    </div>
@endsection
