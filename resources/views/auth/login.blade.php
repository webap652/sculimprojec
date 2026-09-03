<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPDB SMP NEGERI 1 PIRIME</title>

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'Poppins', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            cyan: '#D4AF37', // Aksen emas (gold) sesuai palet sekolah
                            blue: '#173A63', // Warna biru tombol disesuaikan secondary
                            navy: '#0A2540', // Navy solid untuk teks kontras
                            dark: '#030712', // Hitam gelap pekat
                        }
                    }
                }
            }
        }
    </script>
</head>

<body
    class="min-h-screen flex flex-col items-center justify-center py-10 px-4 sm:px-6 lg:px-8 font-sans antialiased relative overflow-x-hidden text-slate-100 selection:bg-brand-blue selection:text-brand-dark">

    <!-- Latar Belakang Gambar Pegunungan Papua dengan Overlay Gelap & Transparan -->
    <div class="absolute inset-0 w-full h-full -z-20">
        <!-- Gambar bentang alam pegunungan tinggi berselimut kabut/awan mirip lanskap Papua Pegunungan -->
        <img src="https://images.unsplash.com/photo-1542224566-6e85f2e6772f?q=80&w=2070&auto=format&fit=crop"
            alt="Papua Highlands Landscape"
            class="w-full h-full object-cover object-center scale-105 filter blur-[1px]">
        <!-- Gradient Overlay untuk menjaga keterbacaan teks (Cyan to Dark Navy) -->
        <div
            class="absolute inset-0 bg-gradient-to-b from-[#173A63]/80 via-[#0A2540]/90 to-[#020617]/95 blend-multiply">
        </div>
    </div>

    <!-- Container Utama -->
    <div class="w-full max-w-md z-10 flex flex-col items-center">

        <!-- Logo Tut Wuri Handayani (Professional Drop Shadow & Hover) -->
        <!-- Logo SMP Negeri 1 Pirime (lokal, biar selalu tampil di HP/laptop) -->
        <div class="mb-4 drop-shadow-[0_10px_20px_rgba(34,211,238,0.25)] transition-all duration-300 hover:scale-105">
            <img src="{{ asset('images/logo sekolah.png') }}" alt="Logo SMP Negeri 1 Pirime"
                class="h-20 sm:h-24 w-auto object-contain">
        </div>

        <!-- Judul Berwarna Kontras Terang -->
        <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight text-center drop-shadow-md">
            Masuk ke Akun Anda
        </h2>
        <p
            class="text-xs sm:text-sm font-semibold text-cyan-200/90 text-center mt-1.5 max-w-xs sm:max-w-sm leading-relaxed drop-shadow-sm">
            Masuk untuk akses dashboard siswa atau admin PPDB
        </p>

        <!-- Navigasi Tab (Sesuai Referensi Gambar - Tab Login Kini Aktif) -->
        <div class="flex flex-row space-x-3 my-6 w-full max-w-[340px]">
            <!-- Tab Register (Inactive - Translucent Glass Style) -->
            <a href="{{ route('register.form') }}"
                class="flex-1 text-center bg-white/10 hover:bg-white/20 text-white font-extrabold text-sm py-3 px-4 rounded-full shadow-md border border-white/20 backdrop-blur-md transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                <i class="fas fa-user-plus text-cyan-300"></i>
                <span>Register Akun</span>
            </a>
            <!-- Tab Login (Active - Solid Glass Blue) -->
            <a href="{{ route('login') }}"
                class="flex-1 text-center bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-600 hover:to-gold-700 text-primary-900 font-extrabold text-sm py-3 px-4 rounded-full shadow-[0_4px_14px_rgba(212,175,55,0.4)] transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                <i class="fas fa-sign-in-alt text-primary-900"></i>
                <span>Login</span>
            </a>
        </div>

        <!-- Notification Status Alert (Gaya Transparan Modern) -->
        @if (session('status'))
            <div
                class="w-full mb-4 p-4 rounded-xl bg-emerald-500/20 border border-emerald-500/30 text-emerald-200 text-sm flex items-center gap-3 backdrop-blur-md shadow-lg animate-pulse">
                <i class="fas fa-check-circle text-emerald-400 text-lg"></i>
                <span class="font-medium">{{ session('status') }}</span>
            </div>
        @endif

        <!-- Login Form Card (Glassmorphic Container) -->
        <div
            class="w-full bg-slate-900/60 backdrop-blur-xl rounded-2xl shadow-[0_25px_60px_rgba(0,0,0,0.5)] p-6 sm:p-8 border border-white/10">
            <form class="space-y-5" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Input Field: Email -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-cyan-200">Alamat
                        Email</label>
                    <div class="relative rounded-lg shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-cyan-400/80 text-sm"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none block w-full pl-10 pr-4 py-2.5 sm:py-3 bg-white/10 border border-white/10 placeholder-slate-400 text-white rounded-lg focus:outline-none focus:ring-4 focus:ring-brand-blue/30 focus:border-brand-blue sm:text-sm transition-all focus:bg-slate-900/40 @error('email') border-red-400 ring-2 ring-red-400/20 @enderror"
                            placeholder="contoh@domain.com" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-300 font-medium flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Input Field: Password -->
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center">
                        <label for="password"
                            class="block text-xs font-bold uppercase tracking-wider text-cyan-200">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs font-semibold text-brand-blue hover:text-cyan-300 transition-colors">
                                Lupa Password?
                            </a>
                        @endif
                    </div>
                    <div class="relative rounded-lg shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-cyan-400/80 text-sm"></i>
                        </div>
                        <input id="password" name="password" type="password" required
                            class="appearance-none block w-full pl-10 pr-4 py-2.5 sm:py-3 bg-white/10 border border-white/10 placeholder-slate-400 text-white rounded-lg focus:outline-none focus:ring-4 focus:ring-brand-blue/30 focus:border-brand-blue sm:text-sm transition-all focus:bg-slate-900/40 @error('password') border-red-400 ring-2 ring-red-400/20 @enderror"
                            placeholder="Masukkan password Anda">
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-300 font-medium flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Opsi Tambahan: Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 rounded bg-white/10 border-white/20 text-brand-blue focus:ring-brand-blue/30 focus:ring-offset-slate-900">
                        <label for="remember_me"
                            class="ml-2 block text-xs sm:text-sm text-slate-300 font-medium cursor-pointer select-none">
                            Ingat saya di perangkat ini
                        </label>
                    </div>
                </div>

                <!-- Tombol Submit (Vibrant Primary Blue) -->
                <div class="pt-2">
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-primary-900 bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-600 hover:to-gold-700 focus:outline-none focus:ring-4 focus:ring-gold-500/30 transition-all duration-200 shadow-lg shadow-gold-500/30 hover:shadow-xl active:scale-[0.99] overflow-hidden">
                        <!-- Efek cahaya kilat di hover -->
                        <span
                            class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></span>
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i
                                class="fas fa-sign-in-alt text-primary-900 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                        <span class="ml-4">Masuk Sekarang</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Info Berwarna Putih Bersih (Profesional & Presisi) -->
        <div class="mt-8 text-white/60 text-[11px] sm:text-xs text-center font-medium tracking-wide drop-shadow-sm">
            &copy; {{ date('Y') }} Sistem PPDB SMP NEGERI 1 PIRIME. Hak Cipta Dilindungi.
        </div>
    </div>

    <!-- Animasi Shimmer Efek via CSS Kustom -->
    <style>
        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }
    </style>
</body>

</html>
