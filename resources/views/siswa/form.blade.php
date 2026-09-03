@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
    <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
        <h3 class="text-2xl font-bold">Formulir Pendaftaran PPDB</h3>
    </div>
    <div class="p-6">
        <form action="{{ route('siswa.pendaftaran.simpan') }}" method="POST">
            @csrf

            <!-- Data Pribadi -->
            <div class="mb-8">
                <div class="bg-blue-600 text-white px-4 py-2 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Data Pribadi</h5>
                </div>
                <div class="border border-gray-300 rounded-b-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nama_lengkap', $data->nama_lengkap ?? '') }}" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">NISN *</label>
                            <input type="text" name="nisn" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nisn', $data->nisn ?? '') }}" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">NIK</label>
                            <input type="text" name="nik" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nik', $data->nik ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Jenis Kelamin *</label>
                            <select name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Tempat Lahir *</label>
                            <input type="text" name="tempat_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('tempat_lahir', $data->tempat_lahir ?? '') }}" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('tanggal_lahir', $data->tanggal_lahir ?? '') }}" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Agama</label>
                            <select name="agama" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Agama</option>
                                <option value="Islam" {{ old('agama', $data->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $data->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama', $data->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $data->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Budha" {{ old('agama', $data->agama ?? '') == 'Budha' ? 'selected' : '' }}>Budha</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Alamat *</label>
                            <textarea name="alamat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" required>{{ old('alamat', $data->alamat ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Desa/Kelurahan</label>
                            <input type="text" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('desa', $data->desa ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Kecamatan</label>
                            <input type="text" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('kecamatan', $data->kecamatan ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Kabupaten</label>
                            <input type="text" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('kabupaten', $data->kabupaten ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Provinsi</label>
                            <input type="text" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('provinsi', $data->provinsi ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Sekolah Asal -->
            <div class="mb-8">
                <div class="bg-gray-600 text-white px-4 py-2 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Data Sekolah Asal</h5>
                </div>
                <div class="border border-gray-300 rounded-b-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama Sekolah *</label>
                            <input type="text" name="nama_sekolah" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nama_sekolah', $data->nama_sekolah ?? '') }}" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">NPSN</label>
                            <input type="text" name="npsn" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('npsn', $data->npsn ?? '') }}">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Alamat Sekolah</label>
                            <textarea name="alamat_sekolah" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3">{{ old('alamat_sekolah', $data->alamat_sekolah ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="mb-8">
                <div class="bg-blue-400 text-white px-4 py-2 rounded-t-lg">
                    <h5 class="text-lg font-semibold">Data Orang Tua</h5>
                </div>
                <div class="border border-gray-300 rounded-b-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h6 class="text-lg font-semibold mb-4">Data Ayah</h6>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Nama Ayah *</label>
                                    <input type="text" name="nama_ayah" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nama_ayah', $data->nama_ayah ?? '') }}" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Pendidikan Ayah</label>
                                    <select name="pendidikan_ayah" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="SD" {{ old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA" {{ old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                        <option value="Diploma" {{ old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                        <option value="Sarjana" {{ old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Pekerjaan Ayah *</label>
                                    <input type="text" name="pekerjaan_ayah" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('pekerjaan_ayah', $data->pekerjaan_ayah ?? '') }}" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">No. HP Ayah</label>
                                    <input type="text" name="no_hp_ayah" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('no_hp_ayah', $data->no_hp_ayah ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-lg font-semibold mb-4">Data Ibu</h6>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Nama Ibu *</label>
                                    <input type="text" name="nama_ibu" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nama_ibu', $data->nama_ibu ?? '') }}" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Pendidikan Ibu</label>
                                    <select name="pendidikan_ibu" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="SD" {{ old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA" {{ old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                        <option value="Diploma" {{ old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                        <option value="Sarjana" {{ old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Pekerjaan Ibu *</label>
                                    <input type="text" name="pekerjaan_ibu" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('pekerjaan_ibu', $data->pekerjaan_ibu ?? '') }}" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">No. HP Ibu</label>
                                    <input type="text" name="no_hp_ibu" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('no_hp_ibu', $data->no_hp_ibu ?? '') }}">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Penghasilan Orang Tua</label>
                                    <select name="penghasilan_orangtua" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Penghasilan</option>
                                        <option value="< 1 juta" {{ old('penghasilan_orangtua', $data->penghasilan_orangtua ?? '') == '< 1 juta' ? 'selected' : '' }}>< 1 juta</option>
                                        <option value="1-3 juta" {{ old('penghasilan_orangtua', $data->penghasilan_orangtua ?? '') == '1-3 juta' ? 'selected' : '' }}>1-3 juta</option>
                                        <option value="3-5 juta" {{ old('penghasilan_orangtua', $data->penghasilan_orangtua ?? '') == '3-5 juta' ? 'selected' : '' }}>3-5 juta</option>
                                        <option value="> 5 juta" {{ old('penghasilan_orangtua', $data->penghasilan_orangtua ?? '') == '> 5 juta' ? 'selected' : '' }}> > 5 juta</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md font-medium transition duration-200">Simpan Data Pendaftaran</button>
                <a href="{{ route('siswa.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-md font-medium transition duration-200">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
