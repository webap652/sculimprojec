@extends('layouts.admin')
@section('title', 'Fasilitas - Admin')
@section('pageTitle', 'Fasilitas Sekolah')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm text-slate-500">Total {{ $fasilitas->count() }} fasilitas</p>
                <a href="{{ route('admin.fasilitas.create') }}"
                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Fasilitas
                </a>
            </div>
            @if (session('success'))
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">
                    {{ session('success') }}</div>
            @endif
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 uppercase text-xs tracking-wider">
                            <th class="p-3 text-left">Foto</th>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Kategori</th>
                            <th class="p-3 text-left">Jumlah</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Aktif</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($fasilitas as $f)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3">
                                    @if ($f->foto)
                                        <img src="{{ asset('storage/' . $f->foto) }}"
                                            class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                            <i class="fas fa-image"></i></div>
                                    @endif
                                </td>
                                <td class="p-3 font-medium">{{ $f->nama }}</td>
                                <td class="p-3"><span
                                        class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">{{ $kategoriList[$f->kategori] ?? $f->kategori }}</span>
                                </td>
                                <td class="p-3">{{ $f->jumlah }}</td>
                                <td class="p-3">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-semibold {{ $f->status == 'Baik' ? 'bg-emerald-100 text-emerald-700' : ($f->status == 'Rusak Ringan' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">{{ $f->status }}</span>
                                </td>
                                <td class="p-3">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $f->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">{{ $f->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                </td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.fasilitas.edit', $f) }}"
                                            class="text-primary-600 hover:text-primary-800"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.fasilitas.destroy', $f) }}" method="POST"
                                            onsubmit="return confirm('Hapus?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-500 hover:text-red-700"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-6 text-center text-slate-500">Belum ada data fasilitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
