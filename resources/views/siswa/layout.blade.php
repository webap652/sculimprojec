{{-- Layout Dashboard Siswa modern dengan sidebar + topbar --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Siswa') | PPDB SMP YPK Kotaraja</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Bootstrap CSS (untuk modal) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'Inter', 'sans-serif'],
                        display: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef3f8',
                            100: '#dce6f0',
                            200: '#b9cce0',
                            300: '#8faec7',
                            400: '#5c86a8',
                            500: '#2e5070',
                            600: '#1f3f5e',
                            700: '#173a63',
                            800: '#0f2c4a',
                            900: '#0a2540',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-scroll:hover::-webkit-scrollbar-thumb {
            background: #475569;
        }

        .hover-lift {
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, .12);
        }

        .fade-in {
            animation: fadeIn .5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>

    @stack('head')
</head>

@php
    use Illuminate\Support\Facades\Route;
    $current = Route::currentRouteName();
    $user = auth()->user();
    $pendaftarGlobal = $pendaftar ?? ($user ? $user->pendaftar : null);
@endphp

<body class="font-sans antialiased bg-slate-100 text-slate-800">
    <div class="min-h-screen flex">

        {{-- ===== SIDEBAR (Desktop) ===== --}}
        <aside
            class="w-[260px] shrink-0 bg-slate-900 text-slate-200 flex-col hidden md:flex fixed inset-y-0 left-0 z-40 sidebar-scroll overflow-y-auto">
            {{-- Brand --}}
            <div class="px-5 py-5 border-b border-slate-800 flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-brand-700 flex items-center justify-center shadow-lg shadow-indigo-900/40">
                    <i class="fas fa-school text-white"></i>
                </div>
                <div>
                    <div class="font-extrabold text-white text-sm leading-tight">Siswa Panel</div>
                    <div class="text-[11px] text-slate-400">PPDB SMP YPK Kotaraja</div>
                </div>
            </div>

            {{-- User mini --}}
            <div class="px-4 py-4 border-b border-slate-800">
                <div class="flex items-center gap-3 bg-slate-800/60 rounded-xl p-3">
                    @if ($pendaftarGlobal && $pendaftarGlobal->foto_profil)
                        <img src="{{ asset('storage/' . $pendaftarGlobal->foto_profil) }}"
                            class="w-10 h-10 rounded-full object-cover border-2 border-indigo-500">
                    @else
                        <div class="w-10 h-10 rounded-full bg-indigo-500/30 flex items-center justify-center">
                            <i class="fas fa-user text-indigo-300"></i>
                        </div>
                    @endif
                    <div class="min-w-0">
                        <div class="text-sm font-semibold text-white truncate">
                            {{ $pendaftarGlobal->nama_lengkap ?? ($user->name ?? 'Siswa') }}</div>
                        <div class="text-[11px] text-slate-400 truncate">{{ $pendaftarGlobal->nisn ?? 'Calon Siswa' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Nav --}}
            <nav class="px-3 py-4 space-y-1 flex-1">
                <div class="px-3 pb-1 text-[11px] text-slate-500 uppercase tracking-wider font-bold">Menu Utama</div>

                <a href="{{ route('siswa.dashboard') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ $current === 'siswa.dashboard' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/40' : 'text-slate-300 hover:bg-slate-800' }}">
                    <i class="fas fa-gauge w-5 mr-2 text-center"></i> Dashboard
                </a>

                <a href="{{ route('siswa.pendaftaran') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ $current === 'siswa.pendaftaran' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/40' : 'text-slate-300 hover:bg-slate-800' }}">
                    <i class="fas fa-edit w-5 mr-2 text-center"></i> Pendaftaran
                </a>

                <a href="{{ route('siswa.ppdb.berkas') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ $current === 'siswa.ppdb.berkas' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/40' : 'text-slate-300 hover:bg-slate-800' }}">
                    <i class="fas fa-file-upload w-5 mr-2 text-center"></i> Berkas
                </a>

                <a href="{{ route('siswa.status') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ $current === 'siswa.status' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/40' : 'text-slate-300 hover:bg-slate-800' }}">
                    <i class="fas fa-clipboard-check w-5 mr-2 text-center"></i> Status
                </a>

                <a href="{{ route('siswa.pengumuman') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ $current === 'siswa.pengumuman' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/40' : 'text-slate-300 hover:bg-slate-800' }}">
                    <i class="fas fa-bullhorn w-5 mr-2 text-center"></i> Pengumuman
                </a>

                <a href="{{ route('siswa.cetak') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ $current === 'siswa.cetak' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/40' : 'text-slate-300 hover:bg-slate-800' }}">
                    <i class="fas fa-print w-5 mr-2 text-center"></i> Cetak Bukti
                </a>

                <div class="pt-4 pb-1 px-3 text-[11px] text-slate-500 uppercase tracking-wider font-bold">Lainnya</div>

                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition-colors">
                    <i class="fas fa-globe w-5 mr-2 text-center"></i> Lihat Website
                </a>
            </nav>

            {{-- Logout --}}
            <div class="px-3 py-4 border-t border-slate-800">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();"
                    class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold text-rose-300 hover:bg-rose-500/10 transition-colors">
                    <i class="fas fa-sign-out-alt w-5 mr-2 text-center"></i> Logout
                </a>
                <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="hidden">@csrf
                </form>
            </div>
        </aside>

        {{-- ===== CONTENT ===== --}}
        <div class="flex-1 flex flex-col md:ml-[260px] w-full">

            {{-- Topbar --}}
            <header class="bg-white/90 backdrop-blur border-b border-slate-200 sticky top-0 z-30">
                <div class="px-4 sm:px-6 py-3.5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        {{-- Hamburger mobile --}}
                        <button id="mobileSidebarToggle"
                            class="md:hidden w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                            <i class="fas fa-bars text-slate-700"></i>
                        </button>
                        <div>
                            <div class="font-extrabold text-slate-900 leading-tight">@yield('pageTitle', 'Dashboard')</div>
                            <div class="text-xs text-slate-500">Selamat datang kembali 👋</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="hidden sm:flex items-center gap-2 text-sm text-slate-600">
                            <i class="fas fa-calendar-day text-slate-400"></i>
                            <span
                                class="font-medium">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form-top').submit();"
                            class="inline-flex items-center px-3 py-2 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 transition text-sm font-semibold">
                            <i class="fas fa-sign-out-alt mr-2"></i><span class="hidden sm:inline">Logout</span>
                        </a>
                    </div>
                    <form id="logout-form-top" action="{{ route('logout') }}" method="POST" class="hidden">@csrf
                    </form>
                </div>
            </header>

            {{-- Mobile sidebar overlay --}}
            <div id="mobileSidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"
                onclick="toggleMobileSidebar()"></div>
            <aside id="mobileSidebar"
                class="fixed top-0 left-0 h-full w-[260px] bg-slate-900 text-slate-200 z-50 transform -translate-x-full transition-transform md:hidden overflow-y-auto flex flex-col">
                <div class="px-5 py-5 border-b border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-brand-700 flex items-center justify-center">
                            <i class="fas fa-school text-white"></i>
                        </div>
                        <div>
                            <div class="font-extrabold text-white text-sm leading-tight">Siswa Panel</div>
                            <div class="text-[11px] text-slate-400">PPDB SMP YPK Kotaraja</div>
                        </div>
                    </div>
                    <button onclick="toggleMobileSidebar()" class="text-slate-400 hover:text-white p-1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="px-4 py-4 border-b border-slate-800">
                    <div class="flex items-center gap-3 bg-slate-800/60 rounded-xl p-3">
                        @if ($pendaftarGlobal && $pendaftarGlobal->foto_profil)
                            <img src="{{ asset('storage/' . $pendaftarGlobal->foto_profil) }}"
                                class="w-10 h-10 rounded-full object-cover border-2 border-indigo-500">
                        @else
                            <div class="w-10 h-10 rounded-full bg-indigo-500/30 flex items-center justify-center">
                                <i class="fas fa-user text-indigo-300"></i>
                            </div>
                        @endif
                        <div class="min-w-0">
                            <div class="text-sm font-semibold text-white truncate">
                                {{ $pendaftarGlobal->nama_lengkap ?? ($user->name ?? 'Siswa') }}</div>
                            <div class="text-[11px] text-slate-400 truncate">
                                {{ $pendaftarGlobal->nisn ?? 'Calon Siswa' }}</div>
                        </div>
                    </div>
                </div>
                <nav class="px-3 py-4 space-y-1 flex-1 overflow-y-auto">
                    <a href="{{ route('siswa.dashboard') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold {{ $current === 'siswa.dashboard' ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}"><i
                            class="fas fa-gauge w-5 mr-2 text-center"></i> Dashboard</a>
                    <a href="{{ route('siswa.pendaftaran') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold {{ $current === 'siswa.pendaftaran' ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}"><i
                            class="fas fa-edit w-5 mr-2 text-center"></i> Pendaftaran</a>
                    <a href="{{ route('siswa.ppdb.berkas') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold {{ $current === 'siswa.ppdb.berkas' ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}"><i
                            class="fas fa-file-upload w-5 mr-2 text-center"></i> Berkas</a>
                    <a href="{{ route('siswa.status') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold {{ $current === 'siswa.status' ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}"><i
                            class="fas fa-clipboard-check w-5 mr-2 text-center"></i> Status</a>
                    <a href="{{ route('siswa.pengumuman') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold {{ $current === 'siswa.pengumuman' ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}"><i
                            class="fas fa-bullhorn w-5 mr-2 text-center"></i> Pengumuman</a>
                    <a href="{{ route('siswa.cetak') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold {{ $current === 'siswa.cetak' ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}"><i
                            class="fas fa-print w-5 mr-2 text-center"></i> Cetak Bukti</a>
                    <div class="pt-3 pb-1 px-3 text-[11px] text-slate-500 uppercase font-bold">Lainnya</div>
                    <a href="{{ route('home') }}" target="_blank"
                        class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800"><i
                            class="fas fa-globe w-5 mr-2 text-center"></i> Lihat Website</a>
                </nav>
                <div class="px-3 py-4 border-t border-slate-800">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                        class="flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold text-rose-300 hover:bg-rose-500/10"><i
                            class="fas fa-sign-out-alt w-5 mr-2 text-center"></i> Logout</a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf</form>
                </div>
            </aside>

            {{-- Main content --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            <footer class="px-6 py-5 text-center text-xs text-slate-400 border-t border-slate-200">
                &copy; {{ date('Y') }} SMP YPK Kotaraja — PPDB Online. All rights reserved.
            </footer>
        </div>
    </div>

    <script>
        function toggleMobileSidebar() {
            document.getElementById('mobileSidebar').classList.toggle('-translate-x-full');
            document.getElementById('mobileSidebarOverlay').classList.toggle('hidden');
        }
    </script>

    {{-- Bootstrap JS (untuk modal) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
