@php
    use Illuminate\Support\Facades\Route;
    $current = Route::currentRouteName();
    $relatedMap = [
        'profil' => [
            [
                'label' => 'Visi & Misi',
                'route' => 'profil.visi-misi',
                'icon' => 'fa-eye',
                'desc' => 'Visi, misi, tujuan dan moto sekolah',
            ],
            [
                'label' => 'Sambutan Kepsek',
                'route' => 'profil.sambutan',
                'icon' => 'fa-user-tie',
                'desc' => 'Sambutan kepala sekolah',
            ],
        ],
        'profil.visi-misi' => [
            [
                'label' => 'Profil Sekolah',
                'route' => 'profil',
                'icon' => 'fa-school',
                'desc' => 'Informasi lengkap sekolah',
            ],
            [
                'label' => 'Sejarah Sekolah',
                'route' => 'profil.sejarah',
                'icon' => 'fa-clock-rotate-left',
                'desc' => 'Perjalanan sekolah',
            ],
        ],
        'profil.sambutan' => [
            [
                'label' => 'Profil Sekolah',
                'route' => 'profil',
                'icon' => 'fa-school',
                'desc' => 'Informasi lengkap sekolah',
            ],
            [
                'label' => 'Visi & Misi',
                'route' => 'profil.visi-misi',
                'icon' => 'fa-eye',
                'desc' => 'Visi dan misi sekolah',
            ],
        ],
        'profil.sejarah' => [
            [
                'label' => 'Struktur Organisasi',
                'route' => 'profil.struktur',
                'icon' => 'fa-sitemap',
                'desc' => 'Struktur kepengurusan sekolah',
            ],
            [
                'label' => 'Guru & Staff',
                'route' => 'profil.guru-staff',
                'icon' => 'fa-chalkboard-user',
                'desc' => 'Tenaga pendidik',
            ],
        ],
        'profil.struktur' => [
            [
                'label' => 'Sejarah Sekolah',
                'route' => 'profil.sejarah',
                'icon' => 'fa-clock-rotate-left',
                'desc' => 'Perjalanan sekolah',
            ],
            [
                'label' => 'Fasilitas',
                'route' => 'profil.fasilitas',
                'icon' => 'fa-building',
                'desc' => 'Sarana dan prasarana',
            ],
        ],
        'profil.guru-staff' => [
            [
                'label' => 'Fasilitas',
                'route' => 'profil.fasilitas',
                'icon' => 'fa-building',
                'desc' => 'Sarana dan prasarana',
            ],
            [
                'label' => 'Prestasi',
                'route' => 'profil.prestasi',
                'icon' => 'fa-trophy',
                'desc' => 'Pencapaian sekolah',
            ],
        ],
        'profil.fasilitas' => [
            [
                'label' => 'Guru & Staff',
                'route' => 'profil.guru-staff',
                'icon' => 'fa-chalkboard-user',
                'desc' => 'Tenaga pendidik',
            ],
            [
                'label' => 'Prestasi',
                'route' => 'profil.prestasi',
                'icon' => 'fa-trophy',
                'desc' => 'Pencapaian sekolah',
            ],
        ],
        'profil.prestasi' => [
            [
                'label' => 'Fasilitas',
                'route' => 'profil.fasilitas',
                'icon' => 'fa-building',
                'desc' => 'Sarana dan prasarana',
            ],
            [
                'label' => 'Profil Sekolah',
                'route' => 'profil',
                'icon' => 'fa-school',
                'desc' => 'Informasi lengkap sekolah',
            ],
        ],
    ];

    $relatedItems = $relatedMap[$current] ?? $relatedMap['profil'];
@endphp

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
    <h3 class="font-bold text-slate-800 text-sm flex items-center mb-4">
        <i class="fas fa-link text-primary-600 mr-2"></i> Jelajahi Halaman Lain
    </h3>
    <div class="space-y-3">
        @foreach ($relatedItems as $item)
            <a href="{{ route($item['route']) }}"
                class="flex items-start gap-3 p-3 rounded-xl hover:bg-blue-50 transition-colors group">
                <div
                    class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-colors flex-shrink-0">
                    <i class="fas {{ $item['icon'] }} text-sm"></i>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-slate-700 group-hover:text-primary-600 transition-colors">
                        {{ $item['label'] }}</h4>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $item['desc'] }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
