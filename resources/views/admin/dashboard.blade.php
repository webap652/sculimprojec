@extends('layouts.admin')
@section('title', 'Dashboard Admin - PPDB Modern')
@section('pageTitle', 'Dashboard')


@section('content')
    @php
        $total = max(1, (int) $jumlahPendaftar);
        $accepted = (int) $diterima;
        $rejected = (int) $ditolak;
        $waiting = (int) $belumVerifikasi;
        $acceptPercent = $jumlahPendaftar > 0 ? round(($diterima / $jumlahPendaftar) * 100, 0) : 0;
    @endphp

    {{-- Toast / Notif cepat (pendaftar baru menunggu verifikasi) --}}
    <div id="adminNewPendaftarToast" class="hidden fixed top-4 right-4 z-[60]">
        <div class="rounded-xl bg-white shadow-lg border border-slate-100 px-4 py-3 flex items-start gap-3">
            <div class="w-9 h-9 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                <i class="fas fa-bell"></i>
            </div>
            <div>
                <p class="font-bold text-slate-800">Notifikasi Pendaftar Baru</p>
                <p class="text-sm text-slate-600" id="adminNewPendaftarToastText">
                    Ada pendaftar baru yang menunggu verifikasi.
                </p>
            </div>
            <button type="button" class="ml-2 text-slate-400 hover:text-slate-700"
                onclick="document.getElementById('adminNewPendaftarToast').classList.add('hidden')">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto space-y-6">

        <div class="flex items-center justify-between rounded-2xl border {{ $ppdbOpen ? 'border-emerald-200 bg-emerald-50' : 'border-rose-200 bg-rose-50' }} px-5 py-4">
            <div class="flex items-center gap-3"><i class="fas {{ $ppdbOpen ? 'fa-circle-check text-emerald-600' : 'fa-lock text-rose-600' }} text-xl"></i><div><p class="font-bold {{ $ppdbOpen ? 'text-emerald-800' : 'text-rose-800' }}">PPDB/SPMB {{ $ppdbOpen ? 'DIBUKA' : 'DITUTUP' }}</p><p class="text-sm {{ $ppdbOpen ? 'text-emerald-700' : 'text-rose-700' }}">Tahun Ajaran {{ $ppdbAcademicYear }}</p></div></div>
            <a href="{{ route('admin.system-settings.edit') }}" class="rounded-xl bg-white px-4 py-2 text-sm font-bold text-[#0A2540] shadow-sm">Pengaturan</a>
        </div>

        <!-- Welcome Section -->
        <div
            class="relative bg-gradient-to-r from-indigo-700 via-indigo-600 to-indigo-500 rounded-2xl shadow-sm p-6 sm:p-8 overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white mb-2 tracking-tight">Perkembangan PPDB Hari
                        Ini
                    </h1>
                    <p class="text-indigo-50 font-medium text-sm sm:text-base max-w-xl">
                        Pendaftaran Tahun Ajaran {{ $ppdbAcademicYear }}. Terdapat
                        <span class="text-white font-bold bg-white/20 px-2 py-0.5 rounded">{{ $waiting }}</span>
                        berkas yang perlu Anda verifikasi segera.
                    </p>
                </div>

                <div class="shrink-0">
                    <a href="{{ route('admin.laporan') }}"
                        class="inline-flex items-center bg-white text-indigo-700 px-5 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:bg-indigo-50 transition-all">
                        <i class="fas fa-download mr-2"></i> Unduh Rekap CSV
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards (KPI) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between group hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-16 h-16 bg-indigo-50 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <i class="fas fa-users"></i>
                        </div>
                        <span
                            class="flex items-center text-emerald-600 text-xs font-bold bg-emerald-50 px-2 py-1 rounded-md">
                            <i class="fas fa-arrow-up mr-1"></i>
                            {{ $total > 0 ? round(($accepted / $total) * 100, 0) : 0 }}%
                        </span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-800 mt-4">{{ (int) $jumlahPendaftar }}</h3>
                    <p class="text-slate-500 text-sm font-medium mt-1">Total Pendaftar</p>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between group hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-16 h-16 bg-amber-50 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-slate-800 mt-4">{{ $waiting }}</h3>
                    <p class="text-slate-500 text-sm font-medium mt-1">Menunggu Verifikasi</p>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between group hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-16 h-16 bg-emerald-50 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-slate-800 mt-4">{{ $accepted }}</h3>
                    <p class="text-slate-500 text-sm font-medium mt-1">Siswa Diterima</p>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between group hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-16 h-16 bg-rose-50 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center text-rose-600">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-slate-800 mt-4">{{ $rejected }}</h3>
                    <p class="text-slate-500 text-sm font-medium mt-1">Berkas Ditolak</p>
                </div>
            </div>
        </div>

        <!-- Grafik Analitik -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Tren Pendaftaran</h2>
                        <p class="text-xs text-slate-500 mt-1" id="trendSubtitle">Statistik 7 hari terakhir</p>
                    </div>
                    <select id="trendRangeSelect"
                        class="text-sm bg-slate-50 border border-slate-200 text-slate-700 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                        <option value="7d" selected>7 Hari Terakhir</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </div>
                <div class="w-full h-72">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col">
                <h2 class="text-lg font-bold text-slate-800 mb-2">Distribusi Status</h2>
                <p class="text-xs text-slate-500 mb-6">Persentase berkas keseluruhan</p>

                <div class="relative flex-1 flex items-center justify-center min-h-[200px]">
                    <canvas id="statusChart"></canvas>

                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-3xl font-black text-slate-800">{{ $acceptPercent }}%</span>
                        <span class="text-[10px] uppercase font-bold text-slate-400">Penerimaan</span>
                    </div>
                </div>

                <div class="mt-6 space-y-3">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm">
                            <span class="w-3 h-3 rounded-full bg-emerald-500 mr-2"></span> Diterima
                        </div>
                        <span class="font-bold text-slate-700">{{ $accepted }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm">
                            <span class="w-3 h-3 rounded-full bg-amber-500 mr-2"></span> Menunggu
                        </div>
                        <span class="font-bold text-slate-700">{{ $waiting }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm">
                            <span class="w-3 h-3 rounded-full bg-rose-500 mr-2"></span> Ditolak
                        </div>
                        <span class="font-bold text-slate-700">{{ $rejected }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel & Aksi Cepat -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div
                    class="p-6 border-b border-slate-50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <h2 class="text-lg font-bold text-slate-800">Antrean Verifikasi</h2>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <input id="queueSearch" type="text" placeholder="Cari nama / email..."
                            class="w-full sm:w-64 text-sm bg-slate-50 border border-slate-200 text-slate-700 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <a href="{{ route('admin.pendaftar') }}"
                            class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 bg-indigo-50 px-3 py-1.5 rounded-lg transition-colors whitespace-nowrap">
                            Lihat Semua
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table id="queueTable" class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-wider">
                                <th class="p-4 font-semibold">Nama Pendaftar</th>
                                <th class="p-4 font-semibold">Asal Sekolah</th>
                                <th class="p-4 font-semibold">Tanggal Daftar</th>
                                <th class="p-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($pendaftarTerbaru as $pendaftar)
                                <tr class="hover:bg-slate-50/80 transition-colors group">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex justify-center items-center font-bold text-xs">
                                                {{ strtoupper(substr($pendaftar->nama_lengkap ?? 'A', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-800">{{ $pendaftar->nama_lengkap ?? '-' }}
                                                </p>
                                                <p class="text-xs text-slate-500">{{ optional($pendaftar->user)->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-slate-600">{{ $pendaftar->asal_sekolah ?? '-' }}</td>
                                    <td class="p-4 text-slate-500 text-xs">
                                        {{ optional($pendaftar->created_at)->format('d M Y') ?? '-' }}</td>
                                    <td class="p-4 text-right">
                                        <a href="{{ route('admin.detail', $pendaftar->id) }}"
                                            class="text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-md font-medium text-xs transition-colors">
                                            Cek Berkas
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-10 text-center text-slate-500 text-sm">Belum ada
                                        pendaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div
                class="bg-gradient-to-b from-slate-800 to-slate-900 rounded-2xl shadow-sm border border-slate-700 p-6 text-white relative overflow-hidden">
                <i class="fas fa-bolt absolute -top-4 -right-2 text-7xl text-slate-700/50 rotate-12"></i>
                <h2 class="text-lg font-bold text-white mb-6 relative z-10">Jalan Pintas</h2>

                <div class="space-y-3 relative z-10">
                    <a href="{{ route('admin.pengumuman.buat') }}"
                        class="flex items-center p-3 bg-slate-800/80 hover:bg-slate-700 border border-slate-700/50 rounded-xl transition-colors group">
                        <div
                            class="w-10 h-10 rounded-lg bg-indigo-500/20 text-indigo-300 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-100">Buat Pengumuman</p>
                            <p class="text-[11px] text-slate-400">Informasi ke pendaftar</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.laporan') }}"
                        class="flex items-center p-3 bg-slate-800/80 hover:bg-slate-700 border border-slate-700/50 rounded-xl transition-colors group">
                        <div
                            class="w-10 h-10 rounded-lg bg-emerald-500/20 text-emerald-200 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-print"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-100">Cetak Laporan PDF</p>
                            <p class="text-[11px] text-slate-400">Rekapitulasi data harian</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.pengumuman') }}"
                        class="flex items-center p-3 bg-slate-800/80 hover:bg-slate-700 border border-slate-700/50 rounded-xl transition-colors group">
                        <div
                            class="w-10 h-10 rounded-lg bg-rose-500/20 text-rose-200 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-100">Buka/Tutup Gelombang</p>
                            <p class="text-[11px] text-slate-400">Pengaturan akses sistem</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.system-settings.edit') }}"
                        class="flex items-center p-3 bg-indigo-900/30 hover:bg-indigo-900/40 border border-indigo-800/50 rounded-xl transition-colors group">
                        <div
                            class="w-10 h-10 rounded-lg bg-indigo-500/20 text-indigo-200 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-gear"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-100">System Settings</p>
                            <p class="text-[11px] text-slate-400">Identitas, aset, maintenance</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>

        <div class="mt-8 py-6 text-center text-sm text-slate-400 font-medium border-t border-slate-200">
            &copy; {{ date('Y') }} PPDB Online Pro - SMP NEGERI 1 PIRIME.
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const notifCount = {{ (int) ($notifCountPendaftarBaru ?? 0) }};
                const toast = document.getElementById('adminNewPendaftarToast');
                const toastText = document.getElementById('adminNewPendaftarToastText');

                const notifList = @json($notifPendaftarBaru ?? []);
                const firstName = notifList?.[0]?.nama_lengkap ?? '';

                if (notifCount > 0 && toast) {
                    if (toastText) {
                        const names = notifList.slice(0, 3).map(x => x.nama_lengkap).filter(Boolean);
                        toastText.textContent = names.length ?
                            `Ada ${notifCount} pendaftar baru. Contoh: ${names.join(', ')}.` :
                            `Ada ${notifCount} pendaftar baru yang menunggu verifikasi.`;
                    }
                    toast.classList.remove('hidden');
                    // Auto-hide after 6s
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 6000);
                }

                const trendLabels7 = @json($trendLabels7 ?? []);
                const trendData7 = @json($trendData7 ?? []);

                const trendLabelsMonth = @json($trendLabelsMonth ?? []);
                const trendDataMonth = @json($trendDataMonth ?? []);

                const trendEl = document.getElementById('trendChart');
                const rangeSelect = document.getElementById('trendRangeSelect');
                const trendSubtitle = document.getElementById('trendSubtitle');

                if (trendEl) {
                    const ctxTrend = trendEl.getContext('2d');
                    const makeGradient = () => {
                        const g = ctxTrend.createLinearGradient(0, 0, 0, 300);
                        g.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
                        g.addColorStop(1, 'rgba(99, 102, 241, 0.0)');
                        return g;
                    };

                    const buildChart = (labels, data) => {
                        return new Chart(ctxTrend, {
                            type: 'line',
                            data: {
                                labels,
                                datasets: [{
                                    label: 'Pendaftar Baru',
                                    data,
                                    borderColor: '#4f46e5',
                                    backgroundColor: makeGradient(),
                                    borderWidth: 3,
                                    pointBackgroundColor: '#ffffff',
                                    pointBorderColor: '#4f46e5',
                                    pointBorderWidth: 2,
                                    pointRadius: 4,
                                    pointHoverRadius: 6,
                                    fill: true,
                                    tension: 0.4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: false,
                                            drawBorder: false
                                        },
                                        ticks: {
                                            color: '#64748b'
                                        }
                                    },
                                    y: {
                                        grid: {
                                            color: '#f1f5f9',
                                            drawBorder: false
                                        },
                                        ticks: {
                                            color: '#64748b'
                                        },
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    };

                    let chartInstance = null;
                    const render = () => {
                        const val = rangeSelect?.value || '7d';

                        const labels = val === 'month' ? trendLabelsMonth : trendLabels7;
                        const data = val === 'month' ? trendDataMonth : trendData7;

                        const subtitleText = val === 'month' ? 'Statistik bulan ini' : 'Statistik 7 hari terakhir';
                        if (trendSubtitle) trendSubtitle.textContent = subtitleText;

                        if (chartInstance) chartInstance.destroy();
                        chartInstance = buildChart(labels, data);
                    };

                    render();
                    rangeSelect?.addEventListener('change', render);
                }

                const statusEl = document.getElementById('statusChart');
                if (statusEl) {
                    const ctxStatus = statusEl.getContext('2d');
                    new Chart(ctxStatus, {
                        type: 'doughnut',
                        data: {
                            labels: ['Diterima', 'Menunggu', 'Ditolak'],
                            datasets: [{
                                data: [
                                    @json((int) $diterima),
                                    @json((int) $belumVerifikasi),
                                    @json((int) $ditolak)
                                ],
                                backgroundColor: ['#10b981', '#f59e0b', '#f43f5e'],
                                borderWidth: 0,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '75%',
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                }

                // Queue table interactivity
                const queueSearch = document.getElementById('queueSearch');
                const queueTable = document.getElementById('queueTable');

                if (queueSearch && queueTable) {
                    const applyFilter = () => {
                        const q = (queueSearch.value || '').toLowerCase().trim();
                        const rows = queueTable.querySelectorAll('tbody tr');
                        rows.forEach(row => {
                            const text = row.innerText.toLowerCase();
                            row.style.display = q === '' || text.includes(q) ? '' : 'none';
                        });
                    };

                    queueSearch.addEventListener('input', applyFilter);
                    applyFilter();
                }
            });
        </script>
    @endpush
@endsection
