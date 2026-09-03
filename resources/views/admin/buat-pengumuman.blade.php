@extends('layouts.admin')

@section('title', 'Buat Pengumuman Baru - Admin')
@section('pageTitle', 'Buat Pengumuman Baru')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 mb-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Buat Pengumuman Baru</h1>
                    <p class="text-blue-100">Buat pengumuman yang akan ditampilkan di halaman depan website</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-plus-circle text-5xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.pengumuman.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Judul -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('judul') border-red-500 @enderror"
                        placeholder="Masukkan judul pengumuman" required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Pengumuman -->
                <div class="mb-6">
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <select id="jenis" name="jenis"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('jenis') border-red-500 @enderror"
                        required>
                        <option value="">Pilih jenis pengumuman</option>
                        <option value="informasi" {{ old('jenis') == 'informasi' ? 'selected' : '' }}>Informasi</option>
                        <option value="pengumuman" {{ old('jenis') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="penting" {{ old('jenis') == 'penting' ? 'selected' : '' }}>Penting</option>
                    </select>
                    @error('jenis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Isi Pengumuman -->
                <div class="mb-6">
                    <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                        Isi Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <textarea id="isi" name="isi" rows="8"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('isi') border-red-500 @enderror"
                        placeholder="Masukkan isi pengumuman..." required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar Pengumuman -->
                <div class="mb-6">
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Pengumuman
                    </label>
                    <input type="file" id="gambar" name="gambar" accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('gambar') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Pilih gambar untuk pengumuman (opsional). Format: JPG, PNG, GIF.
                        Maksimal 2MB.</p>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Aktif -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="aktif" value="1" {{ old('aktif') ? 'checked' : 'checked' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Aktifkan pengumuman (tampilkan di halaman depan)</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.pengumuman') }}"
                        class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md hover:shadow-lg transition duration-300">
                        <i class="fas fa-save mr-2"></i>Simpan Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
