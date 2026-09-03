@extends('layouts.admin')
@section('title', 'Tambah Galeri - Admin')
@section('pageTitle', 'Tambah Foto Galeri')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-semibold text-slate-700">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required
                        class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Kategori</label>
                        <input type="text" name="kategori" value="{{ old('kategori') }}"
                            placeholder="kegiatan, prestasi, fasilitas"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Gambar <span
                                class="text-red-500">*</span></label>
                        <input type="file" name="gambar" accept="image/*" required class="mt-1 w-full text-sm">
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.galeri.index') }}"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50">Batal</a>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
