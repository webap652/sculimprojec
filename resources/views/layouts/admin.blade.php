{{-- Layout Admin dengan sidebar --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Admin')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#0f2851',
                        },
                    }
                }
            }
        }
    </script>

    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-100 text-slate-800">

    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-slate-100 hidden md:flex md:flex-col overflow-y-auto">
            <div class="px-5 py-5 border-b border-slate-800 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                    <i class="fas fa-school"></i>
                </div>
                <div>
                    <div class="font-bold text-sm leading-tight">Admin Panel</div>
                    <div class="text-xs text-slate-400">SMP NEGERI 1 PIRIME</div>
                </div>
            </div>

            <nav class="px-3 py-4 space-y-1 flex-1">
                @php
                    use Illuminate\Support\Facades\Route;
                    $current = Route::currentRouteName();
                @endphp

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ str_starts_with($current, 'admin.dashboard') ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-gauge mr-2"></i>
                    Dashboard
                </a>

                {{-- Profil Sekolah Group --}}
                <div class="pt-4 pb-1 px-3 text-xs text-slate-500 uppercase tracking-wider font-bold">Profil Sekolah
                </div>

                <a href="{{ route('admin.system-settings.edit') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ $current === 'admin.system-settings.edit' ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-gear mr-2"></i>
                    Pengaturan Website
                </a>

                <a href="{{ route('admin.guru.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ str_starts_with($current, 'admin.guru') ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-chalkboard-user mr-2"></i>
                    Guru
                </a>

                <a href="{{ route('admin.fasilitas.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ str_starts_with($current, 'admin.fasilitas') ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-building mr-2"></i>
                    Fasilitas
                </a>

                <a href="{{ route('admin.prestasi.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ str_starts_with($current, 'admin.prestasi') ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-trophy mr-2"></i>
                    Prestasi
                </a>

                <a href="{{ route('admin.sejarah.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ str_starts_with($current, 'admin.sejarah') ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-clock-rotate-left mr-2"></i>
                    Sejarah
                </a>

                <a href="{{ route('admin.struktur-organisasi.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ str_starts_with($current, 'admin.struktur-organisasi') ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-sitemap mr-2"></i>
                    Struktur Organisasi
                </a>

                <a href="{{ route('admin.galeri.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ str_starts_with($current, 'admin.galeri') ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-images mr-2"></i>
                    Galeri
                </a>

                {{-- PPDB Group --}}
                <div class="pt-4 pb-1 px-3 text-xs text-slate-500 uppercase tracking-wider font-bold">PPDB</div>

                <a href="{{ route('admin.pendaftar') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ $current === 'admin.pendaftar' ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-users mr-2"></i>
                    Pendaftar
                </a>

                <a href="{{ route('admin.laporan') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ $current === 'admin.laporan' ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-file-export mr-2"></i>
                    Laporan
                </a>

                {{-- Konten Group --}}
                <div class="pt-4 pb-1 px-3 text-xs text-slate-500 uppercase tracking-wider font-bold">Konten</div>

                <a href="{{ route('admin.pengumuman') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold transition-colors {{ str_starts_with($current, 'admin.pengumuman') ? 'bg-primary-600 text-white' : 'text-slate-200 hover:bg-slate-800' }}">
                    <i class="fas fa-bullhorn mr-2"></i>
                    Pengumuman
                </a>

            </nav>

            <div class="px-3 pb-4">
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Lihat Website
                </a>
                <div class="px-3 py-3 text-xs text-slate-400 border border-slate-800 rounded-xl mt-2">
                    <div class="font-semibold text-slate-200">SMP NEGERI 1 PIRIME</div>
                    <div class="mt-1">Pirime, Lanny Jaya, Papua Pegunungan</div>
                </div>
            </div>
        </aside>

        {{-- Content wrapper --}}
        <div class="flex-1 flex flex-col">
            {{-- Topbar --}}
            <header class="bg-white border-b border-slate-200">
                <div class="px-4 sm:px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button id="mobileSidebarToggle"
                            class="md:hidden w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition"
                            onclick="toggleMobileSidebar()">
                            <i class="fas fa-bars text-slate-700"></i>
                        </button>
                        <div>
                            <div class="font-extrabold text-slate-900">@yield('pageTitle', 'Dashboard')</div>
                            <div class="text-xs text-slate-500">Selamat datang kembali.</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="inline-flex items-center px-3 py-2 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 transition text-sm font-semibold">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </header>

            {{-- Mobile Sidebar Overlay --}}
            <div id="mobileSidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"
                onclick="toggleMobileSidebar()"></div>
            <aside id="mobileSidebar"
                class="fixed top-0 left-0 h-full w-64 bg-slate-900 text-slate-100 z-50 transform -translate-x-full transition-transform md:hidden overflow-y-auto">
                <div class="px-5 py-5 border-b border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                            <i class="fas fa-school"></i>
                        </div>
                        <div>
                            <div class="font-bold text-sm leading-tight">Admin Panel</div>
                            <div class="text-xs text-slate-400">SMP NEGERI 1 PIRIME</div>
                        </div>
                    </div>
                    <button onclick="toggleMobileSidebar()" class="text-slate-400 hover:text-white p-1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="px-3 py-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-semibold text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-gauge mr-2"></i>Dashboard</a>
                    <div class="pt-3 pb-1 px-3 text-xs text-slate-500 uppercase font-bold">Profil</div>
                    <a href="{{ route('admin.system-settings.edit') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-gear mr-2"></i>Pengaturan</a>
                    <a href="{{ route('admin.guru.index') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-chalkboard-user mr-2"></i>Guru</a>
                    <a href="{{ route('admin.fasilitas.index') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-building mr-2"></i>Fasilitas</a>
                    <a href="{{ route('admin.prestasi.index') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-trophy mr-2"></i>Prestasi</a>
                    <a href="{{ route('admin.sejarah.index') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-clock-rotate-left mr-2"></i>Sejarah</a>
                    <a href="{{ route('admin.struktur-organisasi.index') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-sitemap mr-2"></i>Struktur</a>
                    <a href="{{ route('admin.galeri.index') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-images mr-2"></i>Galeri</a>
                    <div class="pt-3 pb-1 px-3 text-xs text-slate-500 uppercase font-bold">PPDB</div>
                    <a href="{{ route('admin.pendaftar') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-users mr-2"></i>Pendaftar</a>
                    <a href="{{ route('admin.laporan') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-file-export mr-2"></i>Laporan</a>
                    <div class="pt-3 pb-1 px-3 text-xs text-slate-500 uppercase font-bold">Konten</div>
                    <a href="{{ route('admin.pengumuman') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm text-slate-200 hover:bg-slate-800"><i
                            class="fas fa-bullhorn mr-2"></i>Pengumuman</a>
                </nav>
            </aside>

            <script>
                function toggleMobileSidebar() {
                    document.getElementById('mobileSidebar').classList.toggle('-translate-x-full');
                    document.getElementById('mobileSidebarOverlay').classList.toggle('hidden');
                }
            </script>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            @stack('scripts')
        </div>
    </div>

</body>

</html>
