@extends('layouts.admin')
@section('title', 'Edit Fasilitas - Admin')
@section('pageTitle', 'Edit Fasilitas')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <form action="{{ route('admin.fasilitas.update', $fasilitas) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-slate-700">Nama Fasilitas <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $fasilitas->nama) }}" required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori" required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @foreach ($kategoriList as $k => $v)
                                <option value="{{ $k }}" {{ $fasilitas->kategori == $k ? 'selected' : '' }}>
                                    {{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Jumlah <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="jumlah" value="{{ old('jumlah', $fasilitas->jumlah) }}" min="1"
                            required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Status <span
                                class="text-red-500">*</span></label>
                        <select name="status" required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat', 'Tidak Ada'] as $s)
                                <option value="{{ $s }}" {{ $fasilitas->status == $s ? 'selected' : '' }}>
                                    {{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Foto</label>
                        <input type="file" name="foto" accept="image/*" class="mt-1 w-full text-sm">
                        @if ($fasilitas->foto)
                            <img src="{{ asset('storage/' . $fasilitas->foto) }}" class="mt-2 h-16 w-auto rounded-lg border">
                        @endif
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Urutan</label>
                        <input type="number" name="urutan" value="{{ old('urutan', $fasilitas->urutan) }}" min="0"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.fasilitas.index') }}"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50">Batal</a>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
