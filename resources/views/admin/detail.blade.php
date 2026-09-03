@extends('layouts.admin')

@section('title', 'Detail Pendaftar - ' . ($pendaftar ? $pendaftar->nama_lengkap : ''))
@section('pageTitle', 'Detail Pendaftar')

@section('content')
    <div class="max-w-7xl mx-auto">
        @if ($pendaftar)
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 mb-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Detail Pendaftar</h1>
                        <p class="text-blue-100">{{ $pendaftar->nama_lengkap }}</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-user text-5xl opacity-20"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Data Pribadi -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                            <h2 class="text-xl font-semibold text-white flex items-center">
                                <i class="fas fa-user mr-2"></i>Data Pribadi
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->nama_lengkap }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">NISN</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->nisn }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">NIK</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->nik }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->jenis_kelamin }}</p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->tempat_lahir }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->tanggal_lahir }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Agama</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->agama }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Sekolah Asal</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->nama_sekolah }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Orang Tua -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                            <h2 class="text-xl font-semibold text-white flex items-center">
                                <i class="fas fa-users mr-2"></i>Data Orang Tua
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->nama_ayah }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->pekerjaan_ayah }}</p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->nama_ibu }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pendaftar->pekerjaan_ibu }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Profile Photo -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-4">
                            <h2 class="text-xl font-semibold text-white flex items-center">
                                <i class="fas fa-camera mr-2"></i>Foto Profil
                            </h2>
                        </div>
                        <div class="p-6 text-center">
                            @if ($pendaftar->foto_profil)
                                <img src="{{ asset('storage/' . $pendaftar->foto_profil) }}" alt="Foto Profil"
                                    class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-gray-200">
                            @else
                                <div
                                    class="w-32 h-32 bg-gray-200 rounded-full mx-auto flex items-center justify-center border-4 border-gray-200">
                                    <i class="fas fa-user text-4xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-500 mt-2">Belum ada foto profil</p>
                            @endif
                        </div>
                    </div>

                    <!-- Status & Verifikasi -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-4">
                            <h2 class="text-xl font-semibold text-white flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>Status & Verifikasi
                            </h2>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('admin.verifikasi', $pendaftar->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select name="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                        <option value="Menunggu" {{ $pendaftar->status == 'Menunggu' ? 'selected' : '' }}>
                                            Menunggu Verifikasi</option>
                                        <option value="Diterima" {{ $pendaftar->status == 'Diterima' ? 'selected' : '' }}>
                                            Diterima</option>
                                        <option value="Ditolak" {{ $pendaftar->status == 'Ditolak' ? 'selected' : '' }}>
                                            Ditolak</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                                    <textarea name="catatan_admin" rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ $pendaftar->catatan_admin }}</textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                                    <i class="fas fa-save mr-2"></i>Update Status
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Berkas -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                            <h2 class="text-xl font-semibold text-white flex items-center">
                                <i class="fas fa-file-alt mr-2"></i>Berkas
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @if ($pendaftar->foto)
                                    <a href="{{ asset('storage/' . $pendaftar->foto) }}" target="_blank"
                                        class="flex items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition duration-150 ease-in-out">
                                        <i class="fas fa-image text-blue-500 mr-3"></i>
                                        <span class="text-sm text-gray-700">Lihat Foto</span>
                                    </a>
                                @endif
                                @if ($pendaftar->kk)
                                    <a href="{{ asset('storage/' . $pendaftar->kk) }}" target="_blank"
                                        class="flex items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition duration-150 ease-in-out">
                                        <i class="fas fa-file text-green-500 mr-3"></i>
                                        <span class="text-sm text-gray-700">Lihat KK</span>
                                    </a>
                                @endif
                                @if ($pendaftar->akte)
                                    <a href="{{ asset('storage/' . $pendaftar->akte) }}" target="_blank"
                                        class="flex items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition duration-150 ease-in-out">
                                        <i class="fas fa-file text-red-500 mr-3"></i>
                                        <span class="text-sm text-gray-700">Lihat Akte</span>
                                    </a>
                                @endif
                                @if ($pendaftar->ijazah)
                                    <a href="{{ asset('storage/' . $pendaftar->ijazah) }}" target="_blank"
                                        class="flex items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition duration-150 ease-in-out">
                                        <i class="fas fa-graduation-cap text-purple-500 mr-3"></i>
                                        <span class="text-sm text-gray-700">Lihat Ijazah</span>
                                    </a>
                                @endif
                                @if (!$pendaftar->foto && !$pendaftar->kk && !$pendaftar->akte && !$pendaftar->ijazah)
                                    <p class="text-gray-500 text-sm text-center py-4">Belum ada berkas yang diupload</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-5xl mb-4"></i>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Pendaftar Tidak Ditemukan</h2>
                <p class="text-gray-600">Data pendaftar yang Anda cari tidak tersedia.</p>
                <a href="{{ route('admin.pendaftar') }}"
                    class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-150 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Pendaftar
                </a>
            </div>
        @endif
    </div>
@endsection
