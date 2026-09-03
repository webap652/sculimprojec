@extends('layouts.admin')
@section('title', 'Prestasi - Admin')
@section('pageTitle', 'Prestasi')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm text-slate-500">Total {{ $prestasis->count() }} prestasi</p>
                <a href="{{ route('admin.prestasi.create') }}"
                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Prestasi
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
                            <th class="p-3 text-left">Nama Prestasi</th>
                            <th class="p-3 text-left">Kategori</th>
                            <th class="p-3 text-left">Tingkat</th>
                            <th class="p-3 text-left">Tahun</th>
                            <th class="p-3 text-left">Juara</th>
                            <th class="p-3 text-left">Aktif</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($prestasis as $p)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3">
                                    @if ($p->foto)
                                        <img src="{{ asset('storage/' . $p->foto) }}"
                                            class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600">
                                            <i class="fas fa-trophy"></i></div>
                                    @endif
                                </td>
                                <td class="p-3 font-medium">{{ $p->nama_prestasi }}</td>
                                <td class="p-3"><span
                                        class="px-2 py-1 rounded-full text-xs bg-indigo-100 text-indigo-700">{{ $kategoriList[$p->kategori] ?? $p->kategori }}</span>
                                </td>
                                <td class="p-3"><span
                                        class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">{{ $tingkatList[$p->tingkat] ?? $p->tingkat }}</span>
                                </td>
                                <td class="p-3">{{ $p->tahun ?? '-' }}</td>
                                <td class="p-3 font-bold text-amber-600">{{ $p->juara ? 'Juara ' . $p->juara : '-' }}</td>
                                <td class="p-3">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $p->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">{{ $p->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                </td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.prestasi.edit', $p) }}"
                                            class="text-primary-600 hover:text-primary-800"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.prestasi.destroy', $p) }}" method="POST"
                                            onsubmit="return confirm('Hapus prestasi?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-500 hover:text-red-700"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-6 text-center text-slate-500">Belum ada data prestasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
