{{-- Navbar Public - SMP NEGERI 1 PIRIME --}}

@php
    use Illuminate\Support\Facades\Route;
    use App\Models\Setting;

    $navSchoolName = Setting::get('school.identity.name', 'SMP NEGERI 1 PIRIME');
    $navSlogan = Setting::get('school.identity.slogan', 'Cerdas, Mandiri, Berkarakter');
    $navMotto = Setting::get('school.leadership.motto', 'Cerdas, Mandiri, Berkarakter');
    $navPhone = Setting::get('school.contact.phone', '+62 821-2044-5529');
    $navEmail = Setting::get('school.contact.email', 'info@smpn1pirime.sch.id');
    $navLogo = Setting::getAssetUrl('school.assets.logo', 'images/logo sekolah.png');

    // Daftar route untuk menu Profil (untuk active state)
    $profilRoutes = [
        'profil',
        'profil.visi-misi',
        'profil.sambutan',
        'profil.sejarah',
        'profil.struktur',
        'profil.guru-staff',
        'profil.fasilitas',
        'profil.prestasi',
    ];

    $isProfilActive = request()->routeIs($profilRoutes);
@endphp

{{-- Top Contact Ribbon --}}
<div class="bg-primary-900 text-white text-xs sm:text-sm py-2 px-4 hidden md:block border-b border-white/10">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-2 text-gray-300">
            <i class="fas fa-bullhorn text-gold-500 animate-pulse"></i>
            <span>{{ $navMotto }}</span>
        </div>
        <div class="flex items-center space-x-6">
            <div class="flex items-center space-x-2 text-gray-300">
                <i class="fas fa-phone text-gold-400"></i>
                <span>{{ $navPhone }}</span>
            </div>
            <div class="flex items-center space-x-2 text-gray-300">
                <i class="fas fa-envelope text-gold-400"></i>
                <span>{{ $navEmail }}</span>
            </div>
        </div>
    </div>
</div>

<nav id="main-nav"
    class="bg-white/90 backdrop-blur-md shadow-md sticky top-0 z-50 border-b border-slate-100/60 supports-[backdrop-filter]:bg-white/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- Logo & Nama Sekolah --}}
            <a href="{{ route('home') }}" class="flex items-center group">
                <div class="flex-shrink-0 flex items-center space-x-3">
                    <div
                        class="w-12 h-12 bg-primary-50 rounded-full flex items-center justify-center border-2 border-gold-500 overflow-hidden shadow-sm transition-all duration-300 group-hover:border-primary-600 group-hover:shadow-md">
                        <img src="{{ $navLogo }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/logo sekolah.png') }}';"
                            alt="Logo {{ $navSchoolName }}" class="w-full h-full object-cover">
                    </div>
                    <div class="leading-tight">
                        <h1
                            class="font-bold text-lg md:text-xl text-primary-900 tracking-tight leading-none transition-colors duration-300 group-hover:text-primary-700">
                            {{ $navSchoolName }}
                        </h1>
                        <p class="text-[11px] md:text-xs text-gold-600 mt-1 font-semibold tracking-wide">
                            <i class="fas fa-graduation-cap mr-1"></i>{{ $navSlogan }}
                        </p>
                    </div>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex lg:items-center lg:space-x-7">

                {{-- Beranda --}}
                <a href="{{ route('home') }}"
                    class="nav-desktop relative text-gray-600 hover:text-primary-900 font-medium text-sm py-2 transition-all duration-300 hover:-translate-y-0.5 {{ request()->routeIs('home') ? 'text-primary-900 font-semibold' : '' }}">
                    Beranda
                    <span
                        class="absolute left-0 -bottom-0.5 h-0.5 bg-gold-500 transition-all duration-300 {{ request()->routeIs('home') ? 'w-full' : 'w-0' }}"></span>
                </a>

                {{-- Profil Dropdown (Desktop: hover, Tablet: klik) --}}
                <div class="relative" id="profil-dropdown-wrap">
                    <button type="button" id="profil-btn"
                        class="relative flex items-center text-gray-600 hover:text-primary-900 font-medium text-sm py-2 transition-all duration-300  hover:-translate-y-0.5 {{ $isProfilActive ? 'text-primary-900 font-semibold' : '' }}">
                        Profil
                        <i id="profil-chevron"
                            class="fas fa-chevron-down text-[10px] ml-1 mt-0.5 transition-transform duration-300"></i>
                        <span
                            class="absolute left-0 -bottom-0.5 h-0.5 bg-gold-500 transition-all duration-300 {{ $isProfilActive ? 'w-full' : 'w-0' }}"></span>
                    </button>

                    {{-- Dropdown Panel --}}
                    <div id="profil-dropdown"
                        class="absolute left-0 top-full mt-2 w-72 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 border-t-4 border-gold-500 z-50 overflow-hidden opacity-0 invisible translate-y-2 scale-95 transition-all duration-300 ease-out">
                        <div class="py-2">
                            <a href="{{ route('profil') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil') ? 'text-primary-900 bg-primary-50 font-semibold border-l-4 border-gold-500' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                                <i class="fas fa-school w-5 text-center mr-1 text-gold-600"></i> Profil Sekolah
                            </a>
                            <a href="{{ route('profil.sambutan') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.sambutan') ? 'text-primary-900 bg-primary-50 font-semibold border-l-4 border-gold-500' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                                <i class="fas fa-microphone-alt w-5 text-center mr-1 text-gold-600"></i> Sambutan Kepala
                                Sekolah
                            </a>
                            <a href="{{ route('profil.sejarah') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.sejarah') ? 'text-primary-900 bg-primary-50 font-semibold border-l-4 border-gold-500' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                                <i class="fas fa-landmark w-5 text-center mr-1 text-gold-600"></i> Sejarah Sekolah
                            </a>
                            <a href="{{ route('profil.visi-misi') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.visi-misi') ? 'text-primary-900 bg-primary-50 font-semibold border-l-4 border-gold-500' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                                <i class="fas fa-bullseye w-5 text-center mr-1 text-gold-600"></i> Visi, Misi &amp;
                                Tujuan
                            </a>
                            <a href="{{ route('profil.struktur') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.struktur') ? 'text-primary-900 bg-primary-50 font-semibold border-l-4 border-gold-500' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                                <i class="fas fa-sitemap w-5 text-center mr-1 text-gold-600"></i> Struktur Organisasi
                            </a>
                            <a href="{{ route('profil.guru-staff') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.guru-staff') ? 'text-primary-900 bg-primary-50 font-semibold border-l-4 border-gold-500' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                                <i class="fas fa-users w-5 text-center mr-1 text-gold-600"></i> Guru &amp; Staff
                            </a>
                            <a href="{{ route('profil.fasilitas') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.fasilitas') ? 'text-primary-900 bg-primary-50 font-semibold border-l-4 border-gold-500' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                                <i class="fas fa-building w-5 text-center mr-1 text-gold-600"></i> Fasilitas
                            </a>
                            <a href="{{ route('profil.prestasi') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.prestasi') ? 'text-primary-900 bg-primary-50 font-semibold border-l-4 border-gold-500' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                                <i class="fas fa-trophy w-5 text-center mr-1 text-gold-600"></i> Prestasi
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Menu lain --}}
                <a href="{{ route('ppdb') }}"
                    class="relative text-gray-600 hover:text-primary-900 font-medium text-sm py-2 transition-all duration-300  hover:-translate-y-0.5 {{ request()->routeIs('ppdb') ? 'text-primary-900 font-semibold' : '' }}">
                    PPDB
                    <span
                        class="absolute left-0 -bottom-0.5 h-0.5 bg-gold-500 transition-all duration-300 {{ request()->routeIs('ppdb') ? 'w-full' : 'w-0' }}"></span>
                </a>
                <a href="{{ route('pengumuman') }}"
                    class="relative text-gray-600 hover:text-primary-900 font-medium text-sm py-2 transition-all duration-300  hover:-translate-y-0.5 {{ request()->routeIs('pengumuman') ? 'text-primary-900 font-semibold' : '' }}">
                    Pengumuman
                    <span
                        class="absolute left-0 -bottom-0.5 h-0.5 bg-gold-500 transition-all duration-300 {{ request()->routeIs('pengumuman') ? 'w-full' : 'w-0' }}"></span>
                </a>
                <a href="{{ route('galeri') }}"
                    class="relative text-gray-600 hover:text-primary-900 font-medium text-sm py-2 transition-all duration-300  hover:-translate-y-0.5 {{ request()->routeIs('galeri') ? 'text-primary-900 font-semibold' : '' }}">
                    Galeri
                    <span
                        class="absolute left-0 -bottom-0.5 h-0.5 bg-gold-500 transition-all duration-300 {{ request()->routeIs('galeri') ? 'w-full' : 'w-0' }}"></span>
                </a>
                <a href="{{ route('kesiswaan') }}"
                    class="relative text-gray-600 hover:text-primary-900 font-medium text-sm py-2 transition-all duration-300  hover:-translate-y-0.5 {{ request()->routeIs('kesiswaan') ? 'text-primary-900 font-semibold' : '' }}">
                    Kesiswaan
                    <span
                        class="absolute left-0 -bottom-0.5 h-0.5 bg-gold-500 transition-all duration-300 {{ request()->routeIs('kesiswaan') ? 'w-full' : 'w-0' }}"></span>
                </a>
                <a href="{{ route('guru') }}"
                    class="relative text-gray-600 hover:text-primary-900 font-medium text-sm py-2 transition-all duration-300  hover:-translate-y-0.5 {{ request()->routeIs('guru') ? 'text-primary-900 font-semibold' : '' }}">
                    Guru
                    <span
                        class="absolute left-0 -bottom-0.5 h-0.5 bg-gold-500 transition-all duration-300 {{ request()->routeIs('guru') ? 'w-full' : 'w-0' }}"></span>
                </a>
                <a href="{{ route('kontak') }}"
                    class="relative text-gray-600 hover:text-primary-900 font-medium text-sm py-2 transition-all duration-300  hover:-translate-y-0.5 {{ request()->routeIs('kontak') ? 'text-primary-900 font-semibold' : '' }}">
                    Kontak
                    <span
                        class="absolute left-0 -bottom-0.5 h-0.5 bg-gold-500 transition-all duration-300 {{ request()->routeIs('kontak') ? 'w-full' : 'w-0' }}"></span>
                </a>
            </div>

            {{-- Auth / Login (Desktop) --}}
            <div class="hidden lg:flex items-center">
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="bg-gradient-to-r from-primary-700 to-primary-900 hover:from-primary-800 hover:to-primary-950 text-white px-5 py-2.5 rounded-full font-medium text-sm flex items-center transition-all duration-300 shadow-lg shadow-primary-900/20 hover:shadow-xl hover:-translate-y-0.5">
                            <i class="fas fa-tachometer-alt mr-2"></i> Admin
                        </a>
                    @elseif(auth()->user()->role === 'siswa')
                        <a href="{{ route('siswa.dashboard') }}"
                            class="bg-gradient-to-r from-primary-700 to-primary-900 hover:from-primary-800 hover:to-primary-950 text-white px-5 py-2.5 rounded-full font-medium text-sm flex items-center transition-all duration-300 shadow-lg shadow-primary-900/20 hover:shadow-xl hover:-translate-y-0.5">
                            <i class="fas fa-user-graduate mr-2"></i> Dashboard
                        </a>
                    @endif
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();"
                        title="Keluar"
                        class="ml-2 w-10 h-10 flex items-center justify-center text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-full transition-all duration-300">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login.form') }}"
                        class="bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-600 hover:to-gold-700 text-primary-900 px-6 py-2.5 rounded-full font-semibold text-sm flex items-center transition-all duration-300 shadow-lg shadow-gold-500/30 hover:shadow-xl hover:-translate-y-0.5">
                        <i class="far fa-user mr-2"></i> Login
                    </a>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <div class="flex items-center lg:hidden">
                <button type="button" id="mobile-toggle" aria-label="Toggle menu"
                    class="text-primary-900 hover:text-primary-700 focus:outline-none p-2 transition-colors duration-300">
                    <i id="mobile-toggle-icon" class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="lg:hidden bg-white border-t border-slate-100 overflow-hidden" style="display:none;">
        <div class="px-4 pt-3 pb-6 space-y-1 max-h-[calc(100vh-5rem)] overflow-y-auto">

            {{-- Beranda --}}
            <a href="{{ route('home') }}"
                class="mobile-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300 {{ request()->routeIs('home') ? 'text-primary-900 bg-primary-50 font-semibold' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                <i class="fas fa-home w-6 text-center mr-2 text-gold-600"></i> Beranda
            </a>

            {{-- Profil Accordion --}}
            <div>
                <button type="button" id="profil-accordion-btn"
                    class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300 {{ $isProfilActive ? 'text-primary-900 bg-primary-50 font-semibold' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                    <span class="flex items-center">
                        <i class="fas fa-school w-6 text-center mr-2 text-gold-600"></i> Profil
                    </span>
                    <i id="profil-accordion-chevron"
                        class="fas fa-chevron-down text-[10px] transition-transform duration-300"></i>
                </button>

                <div id="profil-accordion-menu"
                    class="mt-1 ml-3 border-l-2 border-gold-500 bg-slate-100 rounded-r-lg overflow-hidden"
                    style="display:none;">
                    <a href="{{ route('profil') }}"
                        class="mobile-link block pl-4 pr-3 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil') ? 'text-primary-900 bg-primary-100 font-semibold' : 'text-slate-700 hover:bg-blue-100 hover:text-primary-900' }}">
                        Profil Sekolah
                    </a>
                    <a href="{{ route('profil.sambutan') }}"
                        class="mobile-link block pl-4 pr-3 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.sambutan') ? 'text-primary-900 bg-primary-100 font-semibold' : 'text-slate-700 hover:bg-blue-100 hover:text-primary-900' }}">
                        Sambutan Kepala Sekolah
                    </a>
                    <a href="{{ route('profil.sejarah') }}"
                        class="mobile-link block pl-4 pr-3 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.sejarah') ? 'text-primary-900 bg-primary-100 font-semibold' : 'text-slate-700 hover:bg-blue-100 hover:text-primary-900' }}">
                        Sejarah Sekolah
                    </a>
                    <a href="{{ route('profil.visi-misi') }}"
                        class="mobile-link block pl-4 pr-3 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.visi-misi') ? 'text-primary-900 bg-primary-100 font-semibold' : 'text-slate-700 hover:bg-blue-100 hover:text-primary-900' }}">
                        Visi, Misi &amp; Tujuan
                    </a>
                    <a href="{{ route('profil.struktur') }}"
                        class="mobile-link block pl-4 pr-3 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.struktur') ? 'text-primary-900 bg-primary-100 font-semibold' : 'text-slate-700 hover:bg-blue-100 hover:text-primary-900' }}">
                        Struktur Organisasi
                    </a>
                    <a href="{{ route('profil.guru-staff') }}"
                        class="mobile-link block pl-4 pr-3 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.guru-staff') ? 'text-primary-900 bg-primary-100 font-semibold' : 'text-slate-700 hover:bg-blue-100 hover:text-primary-900' }}">
                        Guru &amp; Staff
                    </a>
                    <a href="{{ route('profil.fasilitas') }}"
                        class="mobile-link block pl-4 pr-3 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.fasilitas') ? 'text-primary-900 bg-primary-100 font-semibold' : 'text-slate-700 hover:bg-blue-100 hover:text-primary-900' }}">
                        Fasilitas
                    </a>
                    <a href="{{ route('profil.prestasi') }}"
                        class="mobile-link block pl-4 pr-3 py-2.5 text-sm font-medium transition-colors duration-300 {{ request()->routeIs('profil.prestasi') ? 'text-primary-900 bg-primary-100 font-semibold' : 'text-slate-700 hover:bg-blue-100 hover:text-primary-900' }}">
                        Prestasi
                    </a>
                </div>
            </div>

            {{-- Menu lain --}}
            <a href="{{ route('ppdb') }}"
                class="mobile-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300 {{ request()->routeIs('ppdb') ? 'text-primary-900 bg-primary-50 font-semibold' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                <i class="fas fa-user-graduate w-6 text-center mr-2 text-gold-600"></i> PPDB
            </a>
            <a href="{{ route('pengumuman') }}"
                class="mobile-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300 {{ request()->routeIs('pengumuman') ? 'text-primary-900 bg-primary-50 font-semibold' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                <i class="fas fa-bullhorn w-6 text-center mr-2 text-gold-600"></i> Pengumuman
            </a>
            <a href="{{ route('galeri') }}"
                class="mobile-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300 {{ request()->routeIs('galeri') ? 'text-primary-900 bg-primary-50 font-semibold' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                <i class="fas fa-images w-6 text-center mr-2 text-gold-600"></i> Galeri
            </a>
            <a href="{{ route('kesiswaan') }}"
                class="mobile-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300 {{ request()->routeIs('kesiswaan') ? 'text-primary-900 bg-primary-50 font-semibold' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                <i class="fas fa-star w-6 text-center mr-2 text-gold-600"></i> Kesiswaan
            </a>
            <a href="{{ route('guru') }}"
                class="mobile-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300 {{ request()->routeIs('guru') ? 'text-primary-900 bg-primary-50 font-semibold' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                <i class="fas fa-chalkboard-teacher w-6 text-center mr-2 text-gold-600"></i> Guru
            </a>
            <a href="{{ route('kontak') }}"
                class="mobile-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-300 {{ request()->routeIs('kontak') ? 'text-primary-900 bg-primary-50 font-semibold' : 'text-slate-700 hover:bg-blue-50 hover:text-primary-900' }}">
                <i class="fas fa-envelope w-6 text-center mr-2 text-gold-600"></i> Kontak
            </a>

            {{-- Auth / Login (Mobile) --}}
            <div class="pt-3 border-t border-slate-100 mt-3">
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="mobile-link flex items-center justify-center px-4 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-primary-700 to-primary-900 hover:from-primary-800 hover:to-primary-950 transition-all duration-300 shadow-lg shadow-primary-900/20">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard Admin
                        </a>
                    @elseif(auth()->user()->role === 'siswa')
                        <a href="{{ route('siswa.dashboard') }}"
                            class="mobile-link flex items-center justify-center px-4 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-primary-700 to-primary-900 hover:from-primary-800 hover:to-primary-950 transition-all duration-300 shadow-lg shadow-primary-900/20">
                            <i class="fas fa-user-graduate mr-2"></i> Dashboard Siswa
                        </a>
                    @endif
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-nav-mobile').submit();"
                        class="flex items-center justify-center px-4 py-3 mt-2 rounded-xl text-sm font-semibold text-red-600 bg-red-50 hover:bg-red-100 transition-all duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                    </a>
                    <form id="logout-form-nav-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login.form') }}"
                        class="mobile-link flex items-center justify-center px-4 py-3 rounded-xl text-sm font-semibold text-primary-900 bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-600 hover:to-gold-700 transition-all duration-300 shadow-lg shadow-gold-500/30">
                        <i class="far fa-user mr-2"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    (function() {
        'use strict';

        // ====== Helper ======
        function $(id) {
            return document.getElementById(id);
        }

        // ====== MOBILE MENU (toggle + accordion) ======
        const mobileToggle = $('mobile-toggle');
        const mobileToggleIcon = $('mobile-toggle-icon');
        const mobileMenu = $('mobile-menu');
        const accordionBtn = $('profil-accordion-btn');
        const accordionMenu = $('profil-accordion-menu');
        const accordionChevron = $('profil-accordion-chevron');

        function setMobileMenu(open) {
            if (!mobileMenu) return;
            if (open) {
                mobileMenu.style.display = 'block';
                mobileToggleIcon.classList.remove('fa-bars');
                mobileToggleIcon.classList.add('fa-times');
            } else {
                mobileMenu.style.display = 'none';
                mobileToggleIcon.classList.remove('fa-times');
                mobileToggleIcon.classList.add('fa-bars');
            }
        }

        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                const isHidden = mobileMenu.style.display === 'none';
                setMobileMenu(isHidden);
            });
        }

        // Accordion Profil - smooth height + chevron rotate 180deg
        function toggleAccordion(forceOpen) {
            if (!accordionMenu) return;
            const isHidden = accordionMenu.style.display === 'none';
            const shouldOpen = typeof forceOpen === 'boolean' ? forceOpen : isHidden;

            if (shouldOpen) {
                accordionMenu.style.display = 'block';
                const targetHeight = accordionMenu.scrollHeight + 'px';
                accordionMenu.style.height = '0px';
                accordionMenu.style.overflow = 'hidden';
                accordionMenu.style.transition = 'height 0.3s ease-in-out';
                // force reflow
                void accordionMenu.offsetHeight;
                accordionMenu.style.height = targetHeight;
                if (accordionChevron) accordionChevron.style.transform = 'rotate(180deg)';
            } else {
                const targetHeight = accordionMenu.scrollHeight + 'px';
                accordionMenu.style.height = targetHeight;
                // force reflow
                void accordionMenu.offsetHeight;
                accordionMenu.style.height = '0px';
                if (accordionChevron) accordionChevron.style.transform = 'rotate(0deg)';
                setTimeout(function() {
                    accordionMenu.style.display = 'none';
                }, 300);
            }
        }

        if (accordionBtn) {
            accordionBtn.addEventListener('click', function() {
                toggleAccordion();
            });
        }

        // Tutup mobile menu saat link diklik
        document.querySelectorAll('.mobile-link').forEach(function(link) {
            link.addEventListener('click', function() {
                setMobileMenu(false);
            });
        });

        // ====== DESKTOP / TABLET: Profil Dropdown ======
        const profilWrap = $('profil-dropdown-wrap');
        const profilBtn = $('profil-btn');
        const profilDropdown = $('profil-dropdown');
        const profilChevron = $('profil-chevron');

        let desktopOpen = false;

        function setProfilDropdown(open) {
            if (!profilDropdown) return;
            desktopOpen = open;
            if (open) {
                profilDropdown.classList.remove('opacity-0', 'invisible', 'translate-y-2', 'scale-95');
                profilChevron.style.transform = 'rotate(180deg)';
            } else {
                profilDropdown.classList.add('opacity-0', 'invisible', 'translate-y-2', 'scale-95');
                profilChevron.style.transform = 'rotate(0deg)';
            }
        }

        function isDesktop() {
            return window.innerWidth >= 1024;
        }

        if (profilWrap && profilBtn && profilDropdown) {
            // Hover (desktop >= 1280px)
            profilWrap.addEventListener('mouseenter', function() {
                if (window.innerWidth >= 1280) setProfilDropdown(true);
            });
            profilWrap.addEventListener('mouseleave', function() {
                if (window.innerWidth >= 1280) setProfilDropdown(false);
            });

            // Klik (tablet 1024-1279px, dan fallback desktop)
            profilBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (window.innerWidth < 1280) {
                    setProfilDropdown(!desktopOpen);
                }
            });

            // Klik di luar dropdown menutup
            document.addEventListener('click', function(e) {
                if (!profilWrap.contains(e.target)) {
                    setProfilDropdown(false);
                }
            });
        }

        // Tutup dropdown/mobile saat resize ke desktop
        window.addEventListener('resize', function() {
            if (isDesktop()) {
                setMobileMenu(false);
            }
            if (window.innerWidth >= 1280) {
                setProfilDropdown(false);
            }
        });
    })();
</script>
