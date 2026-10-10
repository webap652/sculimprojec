@php
    use App\Models\Setting;
    $schoolName = Setting::get('school.identity.name', 'SMP NEGERI 1 PIRIME');
    $schoolDesc = Setting::get('school.identity.slogan', 'Cerdas, Mandiri, Berkarakter');
    $address = Setting::get('school.contact.address', 'Pirime, Lanny Jaya, Papua Pegunungan');
    $phone = Setting::get('school.contact.phone', '+62 821-2044-5529');
    $email = Setting::get('school.contact.email', 'info@smpn1pirime.sch.id');
    $logo = Setting::get('school.assets.logo', 'images/logo sekolah.png');
    $logoUrl = Setting::getAssetUrl('school.assets.logo', 'images/logo sekolah.png');
    $pageTitle = trim(View::getSections()['title'] ?? 'SMP Negeri 1 Pirime | Cerdas, Mandiri, Berkarakter');
    $pageDesc = trim(
        View::getSections()['description'] ??
            'Website resmi SMP Negeri 1 Pirime - Mewujudkan peserta didik yang Beriman, Berilmu, Berkarakter, dan Peduli Lingkungan menuju Generasi Emas Lanny Jaya.',
    );
    $currentUrl = url()->current();
    $canonical = $currentUrl;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Standard Meta --}}
    <title>@yield('title', $schoolName)</title>
    <meta name="description" content="@yield('description', $schoolDesc)">
    <meta name="keywords" content="SMP Negeri 1 Pirime, SMPN 1 Pirime, Lanny Jaya, Papua Pegunungan, sekolah, pendidikan">
    <meta name="author" content="{{ $schoolName }}">
    <link rel="canonical" href="{{ $canonical }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SMP Negeri 1 Pirime">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDesc }}">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:image" content="{{ $logoUrl }}">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDesc }}">
    <meta name="twitter:image" content="{{ $logoUrl }}">
    <meta name="twitter:site" content="@smpn1pirime">

    {{-- Favicon --}}
    @php $favicon = Setting::get('school.assets.favicon'); @endphp
    @if ($favicon)
        <link rel="icon" href="{{ str_starts_with($favicon, 'images/') ? asset($favicon) : asset('storage/' . ltrim($favicon, '/')) }}" type="image/png">
    @else
        <link rel="icon" href="{{ $logoUrl }}" type="image/png">
    @endif

    {{-- JSON-LD Schema.org --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "School",
        "name": "{{ $schoolName }}",
        "description": "{{ $schoolDesc }}",
        "url": "{{ url('/') }}",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ $address }}",
            "addressLocality": "Pirime",
            "addressRegion": "Lanny Jaya",
            "addressCountry": "ID"
        },
        "telephone": "{{ $phone }}",
        "email": "{{ $email }}",
        "logo": "{{ $logoUrl }}",
        "sameAs": [
            "{{ Setting::get('school.social.facebook', '#') }}",
            "{{ Setting::get('school.social.instagram', '#') }}",
            "{{ Setting::get('school.social.youtube', '#') }}"
        ]
    }
    </script>

    {{-- BreadcrumbList Schema --}}
    @hasSection('breadcrumb_schema')
        @yield('breadcrumb_schema')
    @else
        <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" }
        ]
    }
    </script>
    @endif

    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
                        primary: {
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
                            950: '#06182e',
                        },
                        secondary: {
                            50: '#eef3f7',
                            100: '#dce6ee',
                            200: '#b9cddd',
                            300: '#8facc4',
                            400: '#5d87a6',
                            500: '#2e5f7d',
                            600: '#1f4a63',
                            700: '#173a63',
                            800: '#0f2b47',
                            900: '#0a2038',
                        },
                        gold: {
                            50: '#fbf7e9',
                            100: '#f6eecb',
                            200: '#eddba0',
                            300: '#e3c76e',
                            400: '#dab949',
                            500: '#d4af37',
                            600: '#b8942e',
                            700: '#977a26',
                            800: '#6e5a1e',
                            900: '#4d3f16',
                        },
                        accent: {
                            500: '#d4af37',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite'
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '10%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        }
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

        .page-section {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.1);
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    @stack('head')
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-800">
    @if (!request()->routeIs('siswa.pendaftaran') && !View::hasSection('hidePublicNavigation'))
        @include('layouts.partials.public-navbar')
    @endif

    @yield('hero')

    <main id="main-content">
        @yield('content')
    </main>

    @include('layouts.partials.public-footer')

    {{-- Floating Buttons: Back-to-Top & WhatsApp --}}
    <div class="fixed bottom-5 right-5 z-[90] flex flex-col gap-3">
        <button type="button" id="backToTop" aria-label="Kembali ke atas"
            class="w-11 h-11 rounded-full bg-primary-900 text-white shadow-lg shadow-primary-900/30 flex items-center justify-center opacity-0 translate-y-4 pointer-events-none transition-all duration-300 hover:bg-primary-700 hover:-translate-y-1">
            <i class="fas fa-arrow-up"></i>
        </button>
        @php
            $waFloating = \App\Models\Setting::get('school.social.whatsapp', '6282120445529');
        @endphp
        @if ($waFloating)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $waFloating) }}" target="_blank" rel="noopener"
                aria-label="Chat WhatsApp"
                class="w-14 h-14 rounded-full bg-[#25D366] text-white shadow-xl shadow-emerald-500/30 flex items-center justify-center text-2xl hover:scale-110 transition-transform duration-300 group relative">
                <i class="fab fa-whatsapp"></i>
                <span
                    class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-white text-slate-800 text-xs font-semibold px-3 py-1.5 rounded-lg shadow-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">Hubungi
                    Kami</span>
            </a>
        @endif
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            duration: 600,
            offset: 50,
            easing: 'ease-out-cubic'
        });

        // Back-to-Top button
        const backToTop = document.getElementById('backToTop');
        if (backToTop) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 400) {
                    backToTop.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                    backToTop.classList.add('opacity-100', 'translate-y-0');
                } else {
                    backToTop.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                    backToTop.classList.remove('opacity-100', 'translate-y-0');
                }
            });
            backToTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Counter Up Animation with Intersection Observer
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            if (counters.length === 0) return;

            const animateCounter = (el) => {
                const target = parseInt(el.dataset.target) || 0;
                const duration = 2000;
                const step = Math.max(1, Math.floor(target / (duration / 16)));
                let current = 0;

                const update = () => {
                    current += step;
                    if (current >= target) {
                        el.textContent = target.toLocaleString('id-ID');
                        return;
                    }
                    el.textContent = current.toLocaleString('id-ID');
                    requestAnimationFrame(update);
                };

                update();
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(counter => observer.observe(counter));
        });
    </script>

    @stack('scripts')
</body>

</html>
