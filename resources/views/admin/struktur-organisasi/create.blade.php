@extends('layouts.admin')
@section('title', 'Tambah Anggota Struktur - Admin')
@section('pageTitle', 'Tambah Anggota Struktur Organisasi')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <form action="{{ route('admin.struktur-organisasi.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Jabatan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Atasan (Parent)</label>
                        <select name="parent_id"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">- Tidak Ada (Pimpinan Tertinggi) -</option>
                            @foreach ($parents as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->jabatan }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Foto</label>
                        <input type="file" name="foto" accept="image/*" class="mt-1 w-full text-sm">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Urutan</label>
                        <input type="number" name="urutan" value="0" min="0"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="flex items-center gap-2 mt-6">
                            <input type="checkbox" name="is_active" value="1" checked
                                class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm font-semibold text-slate-700">Aktif</span>
                        </label>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.struktur-organisasi.index') }}"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50">Batal</a>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
