@extends('layouts.admin')
@section('title', 'Struktur Organisasi - Admin')
@section('pageTitle', 'Struktur Organisasi')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm text-slate-500">Total {{ $strukturs->count() }} anggota</p>
                <a href="{{ route('admin.struktur-organisasi.create') }}"
                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Anggota
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
                            <th class="p-3 text-left">Jabatan</th>
                            <th class="p-3 text-left">Atasan</th>
                            <th class="p-3 text-left">Urutan</th>
                            <th class="p-3 text-left">Aktif</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($strukturs as $st)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3">
                                    @if ($st->foto)
                                        <img src="{{ asset('storage/' . $st->foto) }}"
                                            class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                                            {{ strtoupper(substr($st->nama, 0, 1)) }}</div>
                                    @endif
                                </td>
                                <td class="p-3 font-medium">{{ $st->nama }}</td>
                                <td class="p-3 text-primary-600 font-medium">{{ $st->jabatan }}</td>
                                <td class="p-3 text-slate-500">{{ $st->parent->nama ?? '-' }}
                                    {{ $st->parent ? '(' . $st->parent->jabatan . ')' : '' }}</td>
                                <td class="p-3">{{ $st->urutan }}</td>
                                <td class="p-3">
                                    <a href="{{ route('admin.struktur-organisasi.toggle', $st) }}"
                                        class="px-2 py-1 rounded-full text-xs font-semibold {{ $st->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $st->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </a>
                                </td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.struktur-organisasi.edit', $st) }}"
                                            class="text-primary-600 hover:text-primary-800"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.struktur-organisasi.destroy', $st) }}" method="POST"
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
                                <td colspan="7" class="p-6 text-center text-slate-500">Belum ada data struktur
                                    organisasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
