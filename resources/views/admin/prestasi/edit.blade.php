@extends('layouts.admin')
@section('title', 'Edit Prestasi - Admin')
@section('pageTitle', 'Edit Prestasi')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <form action="{{ route('admin.prestasi.update', $prestasi) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-slate-700">Nama Prestasi <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_prestasi"
                            value="{{ old('nama_prestasi', $prestasi->nama_prestasi) }}" required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori" required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @foreach ($kategoriList as $k => $v)
                                <option value="{{ $k }}" {{ $prestasi->kategori == $k ? 'selected' : '' }}>
                                    {{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Tingkat <span
                                class="text-red-500">*</span></label>
                        <select name="tingkat" required
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @foreach ($tingkatList as $k => $v)
                                <option value="{{ $k }}" {{ $prestasi->tingkat == $k ? 'selected' : '' }}>
                                    {{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Tahun</label>
                        <input type="number" name="tahun" value="{{ old('tahun', $prestasi->tahun ?? date('Y')) }}"
                            min="1900" max="{{ date('Y') }}"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Juara</label>
                        <input type="text" name="juara" value="{{ old('juara', $prestasi->juara) }}"
                            placeholder="1, 2, 3, Harapan"
                            class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Foto/Dokumentasi</label>
                        <input type="file" name="foto" accept="image/*" class="mt-1 w-full text-sm">
                        @if ($prestasi->foto)
                            <img src="{{ asset('storage/' . $prestasi->foto) }}" class="mt-2 h-16 w-auto rounded-lg border">
                        @endif
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.prestasi.index') }}"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50">Batal</a>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
