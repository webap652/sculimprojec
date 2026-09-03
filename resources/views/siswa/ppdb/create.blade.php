@extends('siswa.layout')

@section('title', 'Formulir PPDB - Siswa')
@section('pageTitle', 'Pendaftaran')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div
            class="relative bg-gradient-to-r from-indigo-700 via-indigo-600 to-brand-700 rounded-2xl shadow-sm p-6 sm:p-8 overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
            </div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-white">Formulir PPDB</h1>
                    <p class="text-indigo-100 text-sm">Lengkapi data pendaftaran SMP YPK Kotaraja</p>
                </div>
            </div>
        </div>

        @if (session('sukses'))
            <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 rounded-2xl p-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-check-circle"></i>
                </div>
                <p class="text-emerald-700 text-sm font-medium">{{ session('sukses') }}</p>
            </div>
        @endif

        <form action="{{ route('siswa.pendaftaran.simpan') }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-sm border border-slate-100 rounded-2xl p-6 sm:p-8">
            @csrf

            <!-- Data Pribadi -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-user mr-3 text-blue-600"></i>Data Pribadi
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                        <input type="text" name="nama_lengkap"
                            value="{{ old('nama_lengkap', $pendaftar->nama_lengkap ?? '') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_lengkap') border-red-500 @enderror">
                        @error('nama_lengkap')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIK *</label>
                        <input type="text" name="nik" value="{{ old('nik', $pendaftar->nik ?? '') }}" required
                            maxlength="16"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nik') border-red-500 @enderror">
                        @error('nik')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                        <input type="text" name="nisn" value="{{ old('nisn', $pendaftar->nisn ?? '') }}"
                            maxlength="10"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jenis_kelamin') border-red-500 @enderror">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki"
                                {{ old('jenis_kelamin', $pendaftar->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $pendaftar->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Agama *</label>
                        <select name="agama" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('agama') border-red-500 @enderror">
                            <option value="">Pilih Agama</option>
                            <option value="Islam"
                                {{ old('agama', $pendaftar->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen"
                                {{ old('agama', $pendaftar->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik"
                                {{ old('agama', $pendaftar->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu"
                                {{ old('agama', $pendaftar->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Budha"
                                {{ old('agama', $pendaftar->agama ?? '') == 'Budha' ? 'selected' : '' }}>Budha</option>
                            <option value="Konghucu"
                                {{ old('agama', $pendaftar->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                            </option>
                        </select>
                        @error('agama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir *</label>
                        <input type="text" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $pendaftar->tempat_lahir ?? '') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tempat_lahir') border-red-500 @enderror">
                        @error('tempat_lahir')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $pendaftar->tanggal_lahir ?? '') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal_lahir') border-red-500 @enderror">
                        @error('tanggal_lahir')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. HP Siswa</label>
                        <input type="text" name="no_hp_siswa"
                            value="{{ old('no_hp_siswa', $pendaftar->no_hp_siswa ?? '') }}" maxlength="15"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-map-marker-alt mr-3 text-green-600"></i>Alamat
                </h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                        <textarea name="alamat" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('alamat') border-red-500 @enderror">{{ old('alamat', $pendaftar->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Desa/Kelurahan *</label>
                            <input type="text" name="desa" value="{{ old('desa', $pendaftar->desa ?? '') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('desa') border-red-500 @enderror">
                            @error('desa')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan *</label>
                            <input type="text" name="kecamatan"
                                value="{{ old('kecamatan', $pendaftar->kecamatan ?? '') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kecamatan') border-red-500 @enderror">
                            @error('kecamatan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten *</label>
                            <input type="text" name="kabupaten"
                                value="{{ old('kabupaten', $pendaftar->kabupaten ?? '') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kabupaten') border-red-500 @enderror">
                            @error('kabupaten')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $pendaftar->provinsi ?? '') }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('provinsi') border-red-500 @enderror">
                        @error('provinsi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-users mr-3 text-purple-600"></i>Data Orang Tua
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Data Ayah -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Data Ayah</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah *</label>
                            <input type="text" name="nama_ayah"
                                value="{{ old('nama_ayah', $pendaftar->nama_ayah ?? '') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_ayah') border-red-500 @enderror">
                            @error('nama_ayah')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan Ayah</label>
                            <select name="pendidikan_ayah"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Pendidikan</option>
                                <option value="SD"
                                    {{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah ?? '') == 'SD' ? 'selected' : '' }}>
                                    SD</option>
                                <option value="SMP"
                                    {{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah ?? '') == 'SMP' ? 'selected' : '' }}>
                                    SMP</option>
                                <option value="SMA"
                                    {{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah ?? '') == 'SMA' ? 'selected' : '' }}>
                                    SMA</option>
                                <option value="D1"
                                    {{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah ?? '') == 'D1' ? 'selected' : '' }}>
                                    D1</option>
                                <option value="D2"
                                    {{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah ?? '') == 'D2' ? 'selected' : '' }}>
                                    D2</option>
                                <option value="D3"
                                    {{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah ?? '') == 'D3' ? 'selected' : '' }}>
                                    D3</option>
                                <option value="S1"
                                    {{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah ?? '') == 'S1' ? 'selected' : '' }}>
                                    S1</option>
                                <option value="S2"
                                    {{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah ?? '') == 'S2' ? 'selected' : '' }}>
                                    S2</option>
                                <option value="S3"
                                    {{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah ?? '') == 'S3' ? 'selected' : '' }}>
                                    S3</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah"
                                value="{{ old('pekerjaan_ayah', $pendaftar->pekerjaan_ayah ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. HP Ayah</label>
                            <input type="text" name="no_hp_ayah"
                                value="{{ old('no_hp_ayah', $pendaftar->no_hp_ayah ?? '') }}" maxlength="15"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- Data Ibu -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Data Ibu</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu *</label>
                            <input type="text" name="nama_ibu"
                                value="{{ old('nama_ibu', $pendaftar->nama_ibu ?? '') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_ibu') border-red-500 @enderror">
                            @error('nama_ibu')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan Ibu</label>
                            <select name="pendidikan_ibu"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Pendidikan</option>
                                <option value="SD"
                                    {{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu ?? '') == 'SD' ? 'selected' : '' }}>
                                    SD</option>
                                <option value="SMP"
                                    {{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu ?? '') == 'SMP' ? 'selected' : '' }}>
                                    SMP</option>
                                <option value="SMA"
                                    {{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu ?? '') == 'SMA' ? 'selected' : '' }}>
                                    SMA</option>
                                <option value="D1"
                                    {{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu ?? '') == 'D1' ? 'selected' : '' }}>
                                    D1</option>
                                <option value="D2"
                                    {{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu ?? '') == 'D2' ? 'selected' : '' }}>
                                    D2</option>
                                <option value="D3"
                                    {{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu ?? '') == 'D3' ? 'selected' : '' }}>
                                    D3</option>
                                <option value="S1"
                                    {{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu ?? '') == 'S1' ? 'selected' : '' }}>
                                    S1</option>
                                <option value="S2"
                                    {{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu ?? '') == 'S2' ? 'selected' : '' }}>
                                    S2</option>
                                <option value="S3"
                                    {{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu ?? '') == 'S3' ? 'selected' : '' }}>
                                    S3</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu"
                                value="{{ old('pekerjaan_ibu', $pendaftar->pekerjaan_ibu ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. HP Ibu</label>
                            <input type="text" name="no_hp_ibu"
                                value="{{ old('no_hp_ibu', $pendaftar->no_hp_ibu ?? '') }}" maxlength="15"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Penghasilan Orang Tua</label>
                        <select name="penghasilan_orangtua"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Penghasilan</option>
                            <option value="< Rp 500.000"
                                {{ old('penghasilan_orangtua', $pendaftar->penghasilan_orangtua ?? '') == '< Rp 500.000' ? 'selected' : '' }}>
                                < Rp 500.000</option>
                            <option value="Rp 500.000 - Rp 1.000.000"
                                {{ old('penghasilan_orangtua', $pendaftar->penghasilan_orangtua ?? '') == 'Rp 500.000 - Rp 1.000.000' ? 'selected' : '' }}>
                                Rp 500.000 - Rp 1.000.000</option>
                            <option value="Rp 1.000.000 - Rp 2.000.000"
                                {{ old('penghasilan_orangtua', $pendaftar->penghasilan_orangtua ?? '') == 'Rp 1.000.000 - Rp 2.000.000' ? 'selected' : '' }}>
                                Rp 1.000.000 - Rp 2.000.000</option>
                            <option value="Rp 2.000.000 - Rp 3.000.000"
                                {{ old('penghasilan_orangtua', $pendaftar->penghasilan_orangtua ?? '') == 'Rp 2.000.000 - Rp 3.000.000' ? 'selected' : '' }}>
                                Rp 2.000.000 - Rp 3.000.000</option>
                            <option value="> Rp 3.000.000"
                                {{ old('penghasilan_orangtua', $pendaftar->penghasilan_orangtua ?? '') == '> Rp 3.000.000' ? 'selected' : '' }}>
                                > Rp 3.000.000</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Anak Ke</label>
                        <input type="number" name="anak_ke" value="{{ old('anak_ke', $pendaftar->anak_ke ?? '') }}"
                            min="1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Saudara</label>
                        <input type="number" name="jumlah_saudara"
                            value="{{ old('jumlah_saudara', $pendaftar->jumlah_saudara ?? '') }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Data Sekolah Asal -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-school mr-3 text-orange-600"></i>Data Sekolah Asal
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Sekolah *</label>
                        <input type="text" name="nama_sekolah"
                            value="{{ old('nama_sekolah', $pendaftar->nama_sekolah ?? '') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_sekolah') border-red-500 @enderror">
                        @error('nama_sekolah')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NPSN</label>
                        <input type="text" name="npsn" value="{{ old('npsn', $pendaftar->npsn ?? '') }}"
                            maxlength="20"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Sekolah</label>
                    <textarea name="alamat_sekolah" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('alamat_sekolah', $pendaftar->alamat_sekolah ?? '') }}</textarea>
                </div>
            </div>

            <!-- Upload Foto -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-camera mr-3 text-red-600"></i>Upload Foto
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                        <input type="file" name="foto_profil" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, Max: 2MB</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Formal</label>
                        <input type="file" name="foto" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, Max: 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 sm:space-x-4">
                <a href="{{ route('siswa.dashboard') }}"
                    class="px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-semibold hover:bg-slate-200 transition text-center">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transition flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i>Simpan Data
                </button>
            </div>
        </form>
    </div>
@endsection
