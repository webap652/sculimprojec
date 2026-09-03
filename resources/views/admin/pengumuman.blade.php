@extends('layouts.admin')

@section('title', 'Kelola Pengumuman - Admin')
@section('pageTitle', 'Kelola Pengumuman')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 mb-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Kelola Pengumuman</h1>
                    <p class="text-blue-100">Kelola pengumuman yang akan ditampilkan di halaman depan website</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-bullhorn text-5xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Create Button -->
        <div class="mb-6">
            <a href="{{ route('admin.pengumuman.buat') }}"
                class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>Buat Pengumuman Baru
            </a>
        </div>

        <!-- Announcements List -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Pengumuman</h3>
            </div>

            @if ($pengumumans->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach ($pengumumans as $pengumuman)
                        <div class="p-6 hover:bg-gray-50 transition duration-150">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h4 class="text-lg font-semibold text-gray-900">{{ $pengumuman->judul }}</h4>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if ($pengumuman->jenis == 'penting') bg-red-100 text-red-800
                                        @elseif($pengumuman->jenis == 'pengumuman') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                            @if ($pengumuman->jenis == 'penting')
                                                Penting
                                            @elseif($pengumuman->jenis == 'pengumuman')
                                                Pengumuman
                                            @else
                                                Informasi
                                            @endif
                                        </span>
                                        @if ($pengumuman->aktif)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-eye mr-1"></i>Aktif
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <i class="fas fa-eye-slash mr-1"></i>Tidak Aktif
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 mb-3 line-clamp-2">{{ Str::limit($pengumuman->isi, 150) }}</p>
                                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                                        <span><i
                                                class="fas fa-calendar mr-1"></i>{{ $pengumuman->created_at->format('d M Y, H:i') }}</span>
                                        @if ($pengumuman->tanggal_publish)
                                            <span><i class="fas fa-clock mr-1"></i>Dipublish:
                                                {{ $pengumuman->tanggal_publish->format('d M Y, H:i') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center space-x-2 ml-4">
                                    <form action="{{ route('admin.pengumuman.toggle', $pengumuman->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                            class="p-2 text-gray-400 hover:text-blue-600 transition duration-150"
                                            title="{{ $pengumuman->aktif ? 'Nonaktifkan' : 'Aktifkan' }} pengumuman">
                                            <i class="fas fa-{{ $pengumuman->aktif ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}"
                                        class="p-2 text-gray-400 hover:text-yellow-600 transition duration-150"
                                        title="Edit pengumuman">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.pengumuman.hapus', $pengumuman->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-gray-400 hover:text-red-600 transition duration-150"
                                            title="Hapus pengumuman">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="px-6 py-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bullhorn text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengumuman</h3>
                    <p class="text-gray-500 mb-6">Buat pengumuman pertama untuk ditampilkan di halaman depan website.</p>
                    <a href="{{ route('admin.pengumuman.buat') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150">
                        <i class="fas fa-plus mr-2"></i>Buat Pengumuman Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
