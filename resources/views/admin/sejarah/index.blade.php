@extends('layouts.admin')
@section('title', 'Sejarah - Admin')
@section('pageTitle', 'Sejarah Sekolah')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm text-slate-500">Total {{ $sejarahs->count() }} catatan sejarah</p>
                <a href="{{ route('admin.sejarah.create') }}"
                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Sejarah
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
                            <th class="p-3 text-left">Tahun</th>
                            <th class="p-3 text-left">Judul</th>
                            <th class="p-3 text-left">Deskripsi</th>
                            <th class="p-3 text-left">Aktif</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($sejarahs as $s)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3 font-bold text-primary-600">{{ $s->tahun ?? '-' }}</td>
                                <td class="p-3 font-medium">{{ $s->judul }}</td>
                                <td class="p-3 text-slate-500 max-w-xs truncate">{{ Str::limit($s->deskripsi, 60) }}</td>
                                <td class="p-3">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $s->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">{{ $s->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                </td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.sejarah.edit', $s) }}"
                                            class="text-primary-600 hover:text-primary-800"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.sejarah.destroy', $s) }}" method="POST"
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
                                <td colspan="5" class="p-6 text-center text-slate-500">Belum ada data sejarah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
