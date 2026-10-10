@php
    $title = $title ?? '';
    $desc = $desc ?? '';
    $bg = $bg ?? asset('images/hero-bg/hero bg (2).png');
    $breadcrumb = $breadcrumb ?? [];
@endphp

<section class="relative bg-white overflow-hidden pb-4 md:pb-10">
    {{-- Background Image Full Coverage --}}
    <div class="absolute inset-0 z-0">
        <img class="h-full w-full object-cover object-center" src="{{ $bg }}"
            onerror="this.onerror=null;this.src='{{ asset('images/hero-bg/hero bg (2).png') }}'"
            alt="Hero">
        {{-- Navy Gradient Overlay untuk kontras premium --}}
        <div
            class="absolute inset-0 bg-gradient-to-r from-primary-950/95 via-primary-900/85 to-primary-800/60 sm:via-primary-900/70">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
    </div>

    <style>
        @keyframes heroFloatUpDown {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .hero-float-updown {
            animation: heroFloatUpDown 3.6s ease-in-out infinite;
            will-change: transform;
        }

        @keyframes heroFadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-fade-in-up {
            opacity: 0;
            animation: heroFadeInUp 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-14 pb-6 md:pt-20 md:pb-14 lg:pt-24 lg:pb-20">
        <div class="max-w-2xl">
            @php $heroAddress = \App\Models\Setting::get('school.contact.address', 'Pirime, Lanny Jaya, Papua Pegunungan'); @endphp
            <div
                class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/20 text-gold-400 text-xs font-semibold uppercase tracking-wider mb-4 shadow-sm backdrop-blur-sm hero-fade-in-up">
                <i class="fas fa-map-marker-alt mr-2"></i>
                {{ $heroAddress }}
            </div>

            @if (!empty($breadcrumb))
                <div class="text-sm font-semibold text-white bg-white/10 border border-white/20 inline-flex items-center px-4 py-2 rounded-full backdrop-blur-sm hero-fade-in-up mb-3"
                    style="animation-delay: 0.1s;">
                    <i class="fas fa-home mr-2 text-gold-400"></i>
                    {!! implode(' <span class="text-white/50">›</span> ', $breadcrumb) !!}
                </div>
            @endif

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white drop-shadow-lg leading-tight mb-4 hero-fade-in-up"
                style="animation-delay: 0.2s;">
                {!! $title !!}
            </h1>

            @if (!empty($desc))
                <p class="text-sm sm:text-base text-slate-200 mb-6 max-w-lg leading-relaxed hero-fade-in-up"
                    style="animation-delay: 0.3s;">
                    {{ $desc }}
                </p>
            @endif

            {{-- Gold accent bar --}}
            <div class="w-20 h-1.5 bg-gradient-to-r from-gold-500 to-gold-400 rounded-full hero-fade-in-up"
                style="animation-delay: 0.4s;"></div>
        </div>
    </div>
</section>
