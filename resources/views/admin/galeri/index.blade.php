@extends('layouts.admin')
@section('title', 'Galeri - Admin')
@section('pageTitle', 'Galeri')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm text-slate-500">Total {{ $galeris->count() }} foto</p>
                <a href="{{ route('admin.galeri.create') }}"
                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Foto
                </a>
            </div>
            @if (session('success'))
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">
                    {{ session('success') }}</div>
            @endif
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($galeris as $g)
                    <div class="bg-slate-50 rounded-xl overflow-hidden border border-slate-200 group relative">
                        <div class="aspect-[4/3] overflow-hidden">
                            <img src="{{ asset('storage/' . $g->gambar) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-3">
                            <h3 class="font-semibold text-sm">{{ $g->judul }}</h3>
                            <p class="text-xs text-slate-500 mt-1">{{ $g->kategori ?? '-' }}</p>
                        </div>
                        <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition">
                            <a href="{{ route('admin.galeri.edit', $g) }}"
                                class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-primary-600 shadow"><i
                                    class="fas fa-edit text-xs"></i></a>
                            <form action="{{ route('admin.galeri.destroy', $g) }}" method="POST"
                                onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button
                                    class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-red-500 shadow"><i
                                        class="fas fa-trash text-xs"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-6 text-center text-slate-500">Belum ada foto galeri.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
