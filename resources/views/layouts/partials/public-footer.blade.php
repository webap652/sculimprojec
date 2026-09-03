@php
    $schoolName = \App\Models\Setting::get('school.identity.name', 'SMP NEGERI 1 PIRIME');
    $slogan = \App\Models\Setting::get('school.identity.slogan', 'Cerdas, Mandiri, Berkarakter');
    $address = \App\Models\Setting::get('school.contact.address', 'Pirime, Lanny Jaya, Papua Pegunungan');
    $phone = \App\Models\Setting::get('school.contact.phone', '+62 821-2044-5529');
    $email = \App\Models\Setting::get('school.contact.email', 'info@smpn1pirime.sch.id');
    $facebook = \App\Models\Setting::get('school.social.facebook', '#');
    $instagram = \App\Models\Setting::get('school.social.instagram', '#');
    $youtube = \App\Models\Setting::get('school.social.youtube', '#');
    $whatsapp = \App\Models\Setting::get('school.social.whatsapp', '6282120445529');
    $footerLogo = \App\Models\Setting::getAssetUrl('school.assets.logo', 'images/logo sekolah.png');
@endphp

<footer class="relative bg-[#0A2540] text-white pt-16 pb-6 px-4 overflow-hidden">
    {{-- Decorative background --}}
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-white/5 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-gold-500/5 blur-3xl"></div>
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
            {{-- About --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-white/10 border border-white/10 flex items-center justify-center shadow-lg overflow-hidden flex-shrink-0">
                        <img src="{{ $footerLogo }}" alt="Logo {{ $schoolName }}"
                            onerror="this.src='{{ asset('images/logo sekolah.png') }}'"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-lg leading-tight">{{ $schoolName }}</h3>
                        <p class="text-xs text-gold-400 font-medium">{{ $slogan }}</p>
                    </div>
                </div>
                <p class="text-slate-300/80 text-sm leading-relaxed">
                    Mewujudkan peserta didik yang Beriman, Berilmu, Berkarakter, dan Peduli Lingkungan menuju Generasi
                    Emas Lanny Jaya.
                </p>

                {{-- Social Media --}}
                <div class="flex items-center gap-2.5 mt-6">
                    @if ($facebook && $facebook != '#')
                        <a href="{{ $facebook }}" target="_blank" aria-label="Facebook"
                            class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-slate-300 hover:bg-[#1877F2] hover:text-white hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                    @endif
                    @if ($instagram && $instagram != '#')
                        <a href="{{ $instagram }}" target="_blank" aria-label="Instagram"
                            class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-slate-300 hover:bg-gradient-to-tr hover:from-purple-600 hover:to-pink-500 hover:text-white hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                    @endif
                    @if ($youtube && $youtube != '#')
                        <a href="{{ $youtube }}" target="_blank" aria-label="YouTube"
                            class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-slate-300 hover:bg-[#FF0000] hover:text-white hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                    @endif
                    @if ($whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank"
                            aria-label="WhatsApp"
                            class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-slate-300 hover:bg-[#25D366] hover:text-white hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-bold text-white mb-5 text-sm uppercase tracking-wider flex items-center gap-2">
                    <span class="w-6 h-0.5 bg-gold-500 rounded-full"></span>Menu Cepat
                </h4>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('profil') }}"
                            class="text-slate-300/80 hover:text-gold-400 text-sm transition-colors flex items-center gap-2 group"><i
                                class="fas fa-chevron-right text-xs text-gold-500 group-hover:translate-x-1 transition-transform"></i>Profil
                            Sekolah</a></li>
                    <li><a href="{{ route('profil.visi-misi') }}"
                            class="text-slate-300/80 hover:text-gold-400 text-sm transition-colors flex items-center gap-2 group"><i
                                class="fas fa-chevron-right text-xs text-gold-500 group-hover:translate-x-1 transition-transform"></i>Visi
                            & Misi</a></li>
                    <li><a href="{{ route('ppdb') }}"
                            class="text-slate-300/80 hover:text-gold-400 text-sm transition-colors flex items-center gap-2 group"><i
                                class="fas fa-chevron-right text-xs text-gold-500 group-hover:translate-x-1 transition-transform"></i>PPDB</a>
                    </li>
                    <li><a href="{{ route('pengumuman') }}"
                            class="text-slate-300/80 hover:text-gold-400 text-sm transition-colors flex items-center gap-2 group"><i
                                class="fas fa-chevron-right text-xs text-gold-500 group-hover:translate-x-1 transition-transform"></i>Pengumuman</a>
                    </li>
                    <li><a href="{{ route('galeri') }}"
                            class="text-slate-300/80 hover:text-gold-400 text-sm transition-colors flex items-center gap-2 group"><i
                                class="fas fa-chevron-right text-xs text-gold-500 group-hover:translate-x-1 transition-transform"></i>Galeri</a>
                    </li>
                    <li><a href="{{ route('kontak') }}"
                            class="text-slate-300/80 hover:text-gold-400 text-sm transition-colors flex items-center gap-2 group"><i
                                class="fas fa-chevron-right text-xs text-gold-500 group-hover:translate-x-1 transition-transform"></i>Kontak</a>
                    </li>
                </ul>
            </div>

            {{-- Program Unggulan --}}
            <div>
                <h4 class="font-bold text-white mb-5 text-sm uppercase tracking-wider flex items-center gap-2">
                    <span class="w-6 h-0.5 bg-gold-500 rounded-full"></span>Program Unggulan
                </h4>
                <ul class="space-y-2.5">
                    @php
                        $programsRaw = \App\Models\Setting::get('school.programs', '');
                        $programLines = array_filter(explode(PHP_EOL, $programsRaw));
                        $count = 0;
                        $defaultPrograms = ['OSIS', 'Pramuka', 'Ekstrakurikuler', 'Literasi', 'Adiwiyata'];
                    @endphp
                    @foreach ($programLines as $line)
                        @php
                            if ($count >= 5) {
                                break;
                            }
                            $parts = explode('|', $line);
                            $count++;
                        @endphp
                        <li class="text-slate-300/80 text-sm flex items-center gap-2">
                            <i class="fas fa-check-circle text-gold-500 text-xs"></i>
                            {{ trim($parts[0] ?? '') }}
                        </li>
                    @endforeach
                    @if (count($programLines) == 0)
                        @foreach ($defaultPrograms as $dp)
                            <li class="text-slate-300/80 text-sm flex items-center gap-2">
                                <i class="fas fa-check-circle text-gold-500 text-xs"></i>{{ $dp }}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            {{-- Contact & Jam Operasional --}}
            <div>
                <h4 class="font-bold text-white mb-5 text-sm uppercase tracking-wider flex items-center gap-2">
                    <span class="w-6 h-0.5 bg-gold-500 rounded-full"></span>Hubungi Kami
                </h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 text-sm text-slate-300/80">
                        <i class="fas fa-map-marker-alt text-gold-500 mt-1"></i>
                        <span>{{ $address }}</span>
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-300/80">
                        <i class="fas fa-phone text-gold-500"></i>
                        <span>{{ $phone }}</span>
                    </li>
                    <li class="flex items-center gap-3 text-sm text-slate-300/80">
                        <i class="fas fa-envelope text-gold-500"></i>
                        <span>{{ $email }}</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm text-slate-300/80">
                        <i class="fas fa-clock text-gold-500 mt-1"></i>
                        <span>
                            Senin - Jumat:
                            {{ \App\Models\Setting::get('school.contact.jam_operasional', '07:00 - 15:00 WIT') }}<br>
                            Sabtu - Minggu: Tutup
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div
            class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-center text-xs text-slate-400">
            <p>© {{ date('Y') }} {{ $schoolName }}. All rights reserved.</p>
            <p class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-gold-500"></span>
                {{ $slogan }} - Official School Website
            </p>
            <p>{{ $address }}</p>
        </div>
    </div>
</footer>
