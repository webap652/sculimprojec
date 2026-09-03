@php
    use Illuminate\Support\Facades\Route;
    $current = Route::currentRouteName();
    $menuItems = [
        ['label' => 'Profil Sekolah', 'route' => 'profil', 'icon' => 'fa-school'],
        ['label' => 'Visi & Misi', 'route' => 'profil.visi-misi', 'icon' => 'fa-eye'],
        ['label' => 'Sambutan Kepsek', 'route' => 'profil.sambutan', 'icon' => 'fa-user-tie'],
        ['label' => 'Sejarah', 'route' => 'profil.sejarah', 'icon' => 'fa-clock-rotate-left'],
        ['label' => 'Struktur Organisasi', 'route' => 'profil.struktur', 'icon' => 'fa-sitemap'],
        ['label' => 'Guru & Staff', 'route' => 'profil.guru-staff', 'icon' => 'fa-chalkboard-user'],
        ['label' => 'Fasilitas', 'route' => 'profil.fasilitas', 'icon' => 'fa-building'],
        ['label' => 'Prestasi', 'route' => 'profil.prestasi', 'icon' => 'fa-trophy'],
    ];
@endphp

{{-- Horizontal Sub Navigation --}}
<div class="mb-10 overflow-x-auto scrollbar-hide">
    <nav class="flex gap-2 min-w-max pb-2">
        @foreach ($menuItems as $item)
            <a href="{{ route($item['route']) }}"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 whitespace-nowrap {{ $current === $item['route'] ? 'bg-primary-600 text-white shadow-md shadow-primary-500/30' : 'bg-white text-slate-600 border border-slate-200 hover:border-primary-300 hover:text-primary-600 hover:bg-primary-50' }}">
                <i class="fas {{ $item['icon'] }} text-xs"></i>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
</div>
