@extends('layouts.app')

@section('title', 'Kontak - SMP NEGERI 1 PIRIME')

@section('hero')
    @php
        $breadcrumb = ['Beranda', 'Kontak'];
    @endphp
    @include('layouts.partials.public-hero', [
        'title' => 'KONTAK',
        'desc' => 'Hubungi SMP Negeri 1 Pirime. Informasi kontak, alamat, dan jam operasional.',
        'bg' => asset('images/hero-bg/hero bg (2).png'),
        'breadcrumb' => $breadcrumb,
    ])
@endsection

@section('content')
    <section class="py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold border border-primary-100 mb-4">
                    <i class="fas fa-headset text-gold-500"></i>
                    <span>Hubungi Kami</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900">Informasi Kontak</h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-primary-500 to-gold-500 mx-auto rounded-full mt-4"></div>
                <p class="mt-4 text-slate-500 max-w-2xl mx-auto">Kami siap membantu Anda. Hubungi kami melalui berbagai
                    kanal komunikasi berikut.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

                <!-- Left: Info Kontak -->
                <div data-aos="fade-up">
                    <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-8">
                        <h2 class="text-2xl font-extrabold text-primary-900 mb-6">Informasi Kontak</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div
                                class="text-center bg-[#F8FAFC] rounded-2xl p-5 border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all group">
                                <div
                                    class="w-14 h-14 mx-auto rounded-2xl bg-gradient-to-br from-primary-700 to-primary-900 text-gold-400 flex items-center justify-center mb-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="fas fa-phone text-lg"></i>
                                </div>
                                <h3 class="font-bold text-primary-900 mb-1">Telepon</h3>
                                <p class="text-slate-600 text-sm">{{ $data['telepon'] ?? '-' }}</p>
                            </div>

                            <div
                                class="text-center bg-[#F8FAFC] rounded-2xl p-5 border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all group">
                                <div
                                    class="w-14 h-14 mx-auto rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 text-white flex items-center justify-center mb-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="fas fa-envelope text-lg"></i>
                                </div>
                                <h3 class="font-bold text-primary-900 mb-1">Email</h3>
                                <p class="text-slate-600 text-sm break-all">{{ $data['email'] ?? '-' }}</p>
                            </div>
                        </div>

                        <div
                            class="mt-5 text-center bg-[#F8FAFC] rounded-2xl p-5 border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all group">
                            <div
                                class="w-14 h-14 mx-auto rounded-2xl bg-gradient-to-br from-gold-500 to-gold-600 text-primary-900 flex items-center justify-center mb-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-map-marker-alt text-lg"></i>
                            </div>
                            <h3 class="font-bold text-primary-900 mb-1">Alamat</h3>
                            <p class="text-slate-600">{{ $data['alamat'] ?? '-' }}</p>
                        </div>

                        <div class="mt-7">
                            <h3 class="text-center font-bold text-primary-900 mb-3">Media Sosial</h3>
                            <div class="flex justify-center gap-3">
                                @if ($data['facebook'] ?? '#')
                                    <a href="{{ $data['facebook'] }}" target="_blank"
                                        class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition hover:-translate-y-1 shadow-lg"><i
                                            class="fab fa-facebook-f"></i></a>
                                @endif
                                @if ($data['twitter'] ?? '#')
                                    <a href="{{ $data['twitter'] }}" target="_blank"
                                        class="w-12 h-12 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition hover:-translate-y-1 shadow-lg"><i
                                            class="fab fa-twitter"></i></a>
                                @endif
                                @if ($data['instagram'] ?? '#')
                                    <a href="{{ $data['instagram'] }}" target="_blank"
                                        class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-600 to-pink-500 text-white flex items-center justify-center hover:scale-110 transition shadow-lg"><i
                                            class="fab fa-instagram"></i></a>
                                @endif
                                @if ($data['youtube'] ?? '#')
                                    <a href="{{ $data['youtube'] }}" target="_blank"
                                        class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition hover:-translate-y-1 shadow-lg"><i
                                            class="fab fa-youtube"></i></a>
                                @endif
                                @if ($data['whatsapp'] ?? '#')
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $data['whatsapp']) }}"
                                        target="_blank"
                                        class="w-12 h-12 rounded-full bg-emerald-500 text-white flex items-center justify-center hover:bg-emerald-600 transition hover:-translate-y-1 shadow-lg"><i
                                            class="fab fa-whatsapp"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Lokasi & Jam Operasional -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-8">
                        <h2 class="text-2xl font-extrabold text-primary-900 mb-6">Lokasi Sekolah</h2>
                        <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-lg">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6500000000005!2d140.675!3d-2.583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMsKwMzQnMTAuOCJTIDE0MMKwNDAnMzAuMCJF!5e0!3m2!1sen!2sid!4v1634567890123!5m2!1sen!2sid"
                                width="100%" height="350" style="border:0;" allowfullscreen loading="lazy"></iframe>
                        </div>

                        <div class="mt-8 bg-[#F8FAFC] border border-slate-100 rounded-2xl p-6">
                            <h3 class="font-bold text-primary-900 mb-3">Jam Operasional</h3>
                            <div class="space-y-3 text-slate-700">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-clock text-gold-500 mt-1"></i>
                                    <div>
                                        <p class="font-semibold text-primary-900">Senin - Jumat</p>
                                        <p class="text-sm text-slate-600">
                                            {{ $data['jam_operasional'] ?? '07:00 - 15:00 WIT' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-calendar-times text-amber-500 mt-1"></i>
                                    <div>
                                        <p class="font-semibold text-primary-900">Sabtu - Minggu</p>
                                        <p class="text-sm text-slate-600">Tutup</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA -->
                        <div
                            class="mt-6 bg-gradient-to-br from-primary-700 to-primary-950 rounded-2xl p-6 text-center relative overflow-hidden">
                            <div class="absolute -right-6 -top-6 w-28 h-28 rounded-full bg-gold-500/10 blur-2xl"></div>
                            <h3 class="text-white font-bold text-lg mb-2">Butuh Bantuan?</h3>
                            <p class="text-blue-100/80 text-sm mb-4">Hubungi kami untuk pertanyaan seputar PPDB atau
                                informasi sekolah.</p>
                            @if ($data['whatsapp'] ?? '#')
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $data['whatsapp']) }}"
                                    target="_blank"
                                    class="inline-flex items-center bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all hover:-translate-y-0.5 shadow-lg">
                                    <i class="fab fa-whatsapp mr-2"></i> Hubungi via WA
                                </a>
                            @else
                                <a href="tel:{{ $data['telepon'] ?? '#' }}"
                                    class="inline-flex items-center bg-white hover:bg-blue-50 text-primary-700 px-6 py-3 rounded-xl font-bold text-sm transition-all hover:-translate-y-0.5 shadow-lg">
                                    <i class="fas fa-phone mr-2"></i> Hubungi Telepon
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
