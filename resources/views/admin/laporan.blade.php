@extends('layouts.admin')

@section('title', 'Laporan PPDB')
@section('pageTitle', 'Laporan PPDB')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 mb-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Laporan PPDB</h1>
                    <p class="text-blue-100">Ringkasan lengkap pendaftaran siswa baru</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-chart-bar text-5xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Pendaftar -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Pendaftar</p>
                            <p class="text-white text-3xl font-bold">{{ $pendaftars->count() }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menunggu Verifikasi -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm font-medium">Menunggu Verifikasi</p>
                            <p class="text-white text-3xl font-bold">{{ $pendaftars->where('status', 'Menunggu')->count() }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diterima -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Diterima</p>
                            <p class="text-white text-3xl font-bold">{{ $pendaftars->where('status', 'Diterima')->count() }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-check-circle text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ditolak -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-red-600 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-100 text-sm font-medium">Ditolak</p>
                            <p class="text-white text-3xl font-bold">{{ $pendaftars->where('status', 'Ditolak')->count() }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <i class="fas fa-times-circle text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export Button -->
        <div class="mb-6">
            <button onclick="window.print()"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition duration-150 ease-in-out">
                <i class="fas fa-print mr-2"></i>Cetak Laporan
            </button>
            <button onclick="exportToExcel()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-150 ease-in-out ml-2">
                <i class="fas fa-file-excel mr-2"></i>Export Excel
            </button>
        </div>

        <!-- Detail Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Detail Pendaftar</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                                Lengkap</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sekolah Asal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pendaftars as $index => $pendaftar)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pendaftar->nama_lengkap }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pendaftar->nisn }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pendaftar->nama_sekolah }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if ($pendaftar->status == 'Diterima') bg-green-100 text-green-800
                                @elseif($pendaftar->status == 'Ditolak') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ $pendaftar->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $pendaftar->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <i class="fas fa-users text-gray-400 text-5xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data pendaftar</h3>
                                    <p class="text-gray-500">Data pendaftar akan muncul setelah siswa melakukan pendaftaran.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary Footer -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $pendaftars->count() }}</h3>
                    <p class="text-gray-600">Total Pendaftar</p>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $pendaftars->where('status', 'Diterima')->count() }}
                    </h3>
                    <p class="text-gray-600">Diterima</p>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $pendaftars->where('status', 'Menunggu')->count() }}
                    </h3>
                    <p class="text-gray-600">Menunggu Verifikasi</p>
                </div>
            </div>
            <div class="mt-4 text-center text-sm text-gray-500">
                Laporan dibuat pada {{ date('d F Y, H:i') }} WIB
            </div>
        </div>
    </div>

    <script>
        function exportToExcel() {
            // Simple CSV export (can be enhanced with proper Excel library)
            let csv = 'No,Nama Lengkap,NISN,Sekolah Asal,Status,Tanggal Daftar\n';
            @foreach ($pendaftars as $index => $pendaftar)
                csv +=
                    '{{ $index + 1 }},{{ $pendaftar->nama_lengkap }},{{ $pendaftar->nisn }},{{ $pendaftar->nama_sekolah }},{{ $pendaftar->status }},{{ $pendaftar->created_at->format('d/m/Y') }}\n';
            @endforeach

            const blob = new Blob([csv], {
                type: 'text/csv'
            });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'laporan_ppdb_{{ date('Y-m-d') }}.csv';
            a.click();
            window.URL.revokeObjectURL(url);
        }
    </script>
@endsection
