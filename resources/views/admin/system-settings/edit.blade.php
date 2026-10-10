@extends('layouts.admin')

@section('title', 'System Settings - Admin')
@section('pageTitle', 'System Settings')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-800">System Settings</h1>
                    <p class="text-sm text-slate-500 mt-1">Atur identitas sekolah, aset visual, kepemimpinan, program,
                        statistik, dan mode maintenance.</p>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.system-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-8">

                    {{-- ============================================================ --}}
                    {{-- IDENTITAS SEKOLAH --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
                            <div
                                class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center text-primary-600">
                                <i class="fas fa-school text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Identitas Sekolah</h2>
                                <p class="text-xs text-slate-500">Nama, NPSN, akreditasi, dll.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Nama Sekolah</label>
                                <input type="text" name="school[identity][name]"
                                    value="{{ old('school.identity.name', $settings['school.identity.name'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Slogan</label>
                                <input type="text" name="school[identity][slogan]"
                                    value="{{ old('school.identity.slogan', $settings['school.identity.slogan'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">NPSN</label>
                                <input type="text" name="school[identity][npsn]"
                                    value="{{ old('school.identity.npsn', $settings['school.identity.npsn'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Jenis Sekolah</label>
                                <input type="text" name="school[identity][jenis]"
                                    value="{{ old('school.identity.jenis', $settings['school.identity.jenis'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Akreditasi</label>
                                <input type="text" name="school[identity][akreditasi]"
                                    value="{{ old('school.identity.akreditasi', $settings['school.identity.akreditasi'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Tahun Berdiri</label>
                                <input type="text" name="school[identity][tahun_berdiri]"
                                    value="{{ old('school.identity.tahun_berdiri', $settings['school.identity.tahun_berdiri'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                        </div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- KONTAK --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
                            <div
                                class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                                <i class="fas fa-address-card text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Kontak & Alamat</h2>
                                <p class="text-xs text-slate-500">Informasi kontak dan jam operasional.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Alamat Lengkap</label>
                                <textarea name="school[contact][address]" rows="2"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.contact.address', $settings['school.contact.address'] ?? '') }}</textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Nama Kabupaten/Kota</label>
                                <input type="text" name="school[contact][kabupaten]"
                                    value="{{ old('school.contact.kabupaten', $settings['school.contact.kabupaten'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Email</label>
                                <input type="email" name="school[contact][email]"
                                    value="{{ old('school.contact.email', $settings['school.contact.email'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">No Telepon</label>
                                <input type="text" name="school[contact][phone]"
                                    value="{{ old('school.contact.phone', $settings['school.contact.phone'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Jam Operasional</label>
                                <input type="text" name="school[contact][jam_operasional]"
                                    value="{{ old('school.contact.jam_operasional', $settings['school.contact.jam_operasional'] ?? '07:00 - 15:00 WIT') }}"
                                    placeholder="07:00 - 15:00 WIT"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                        </div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- SOSIAL MEDIA --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
                            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center text-sky-600">
                                <i class="fas fa-share-alt text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Sosial Media</h2>
                                <p class="text-xs text-slate-500">Link media sosial sekolah.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Facebook (URL)</label>
                                <input type="url" name="school[social][facebook]"
                                    value="{{ old('school.social.facebook', $settings['school.social.facebook'] ?? '') }}"
                                    placeholder="https://facebook.com/..."
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Instagram (URL)</label>
                                <input type="url" name="school[social][instagram]"
                                    value="{{ old('school.social.instagram', $settings['school.social.instagram'] ?? '') }}"
                                    placeholder="https://instagram.com/..."
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Youtube (URL)</label>
                                <input type="url" name="school[social][youtube]"
                                    value="{{ old('school.social.youtube', $settings['school.social.youtube'] ?? '') }}"
                                    placeholder="https://youtube.com/..."
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Twitter / X (URL)</label>
                                <input type="url" name="school[social][twitter]"
                                    value="{{ old('school.social.twitter', $settings['school.social.twitter'] ?? '') }}"
                                    placeholder="https://x.com/..."
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">WhatsApp (No. HP)</label>
                                <input type="text" name="school[social][whatsapp]"
                                    value="{{ old('school.social.whatsapp', $settings['school.social.whatsapp'] ?? '') }}"
                                    placeholder="6281234567890"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                <p class="text-xs text-slate-400 mt-1">Nomor HP tanpa + atau spasi, contoh: 6282120445529
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- ASSET VISUAL --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
                            <div
                                class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">
                                <i class="fas fa-image text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Asset Visual</h2>
                                <p class="text-xs text-slate-500">Logo, favicon, dan gambar hero.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Logo Sekolah</label>
                                <input type="file" name="school[assets][logo]" class="mt-2 w-full text-sm" />
                                @php $logo = $settings['school.assets.logo'] ?? null; @endphp
                                @if ($logo)
                                    <div class="mt-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                                        <img src="{{ asset('storage/' . $logo) }}" class="h-16 w-auto rounded-lg" />
                                        <p class="text-xs text-slate-400 mt-1">Path: {{ $logo }}</p>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-slate-700">Favicon</label>
                                <input type="file" name="school[assets][favicon]" class="mt-2 w-full text-sm" />
                                @php $favicon = $settings['school.assets.favicon'] ?? null; @endphp
                                @if ($favicon)
                                    <div class="mt-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                                        <img src="{{ asset('storage/' . $favicon) }}" class="h-12 w-auto rounded-lg" />
                                    </div>
                                @endif
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Hero Image (Background)</label>
                                <input type="file" name="school[assets][hero_image]" class="mt-2 w-full text-sm" />
                                @php $heroImage = $settings['school.assets.hero_image'] ?? null; @endphp
                                @if ($heroImage)
                                    <div class="mt-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                                        <img src="{{ asset('storage/' . $heroImage) }}"
                                            class="h-28 w-full object-cover rounded-lg" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- HERO SECTION (LANDING) --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600">
                                <i class="fas fa-palette text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Hero Section (Halaman Depan)</h2>
                                <p class="text-xs text-slate-500">Konten hero pada halaman beranda.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Tag</label>
                                <input type="text" name="school[hero][tag]"
                                    value="{{ old('school.hero.tag', $settings['school.hero.tag'] ?? 'Selamat Datang di Website') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Judul Hero (boleh pakai HTML)</label>
                                <textarea name="school[hero][title]" rows="2"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.hero.title', $settings['school.hero.title'] ?? 'MEMBANGUN GENERASI <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-blue-400">EMAS LANNY JAYA</span>') }}</textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Subtitle Hero</label>
                                <textarea name="school[hero][subtitle]" rows="2"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.hero.subtitle', $settings['school.hero.subtitle'] ?? 'Mewujudkan peserta didik yang Beriman, Berilmu, Berkarakter, dan Peduli Lingkungan.') }}</textarea>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Tombol 1 (Teks)</label>
                                <input type="text" name="school[hero][button_text]"
                                    value="{{ old('school.hero.button_text', $settings['school.hero.button_text'] ?? 'Daftar PPDB') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Tombol 1 (URL)</label>
                                <input type="text" name="school[hero][button_url]"
                                    value="{{ old('school.hero.button_url', $settings['school.hero.button_url'] ?? '') }}"
                                    placeholder="{{ route('register.form') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Tombol 2 (Teks)</label>
                                <input type="text" name="school[hero][button_2_text]"
                                    value="{{ old('school.hero.button_2_text', $settings['school.hero.button_2_text'] ?? 'Visi & Misi Kami') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Tombol 2 (URL)</label>
                                <input type="text" name="school[hero][button_2_url]"
                                    value="{{ old('school.hero.button_2_url', $settings['school.hero.button_2_url'] ?? '') }}"
                                    placeholder="{{ route('profil.visi-misi') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                        </div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- PROFIL & KEPEMIMPINAN --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
                            <div
                                class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600">
                                <i class="fas fa-user-tie text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Profil & Kepemimpinan</h2>
                                <p class="text-xs text-slate-500">Kepala sekolah, visi, misi, tujuan, sambutan.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Nama Kepala Sekolah</label>
                                <input type="text" name="school[leadership][head_name]"
                                    value="{{ old('school.leadership.head_name', $settings['school.leadership.head_name'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">NIP Kepala Sekolah</label>
                                <input type="text" name="school[leadership][head_nip]"
                                    value="{{ old('school.leadership.head_nip', $settings['school.leadership.head_nip'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Foto Kepala Sekolah</label>
                                <input type="file" name="school[leadership][head_photo]"
                                    class="mt-2 w-full text-sm" />
                                @php $headPhoto = $settings['school.leadership.head_photo'] ?? null; @endphp
                                @if ($headPhoto)
                                    <div class="mt-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                                        <img src="{{ asset('storage/' . $headPhoto) }}" class="h-20 w-auto rounded-lg" />
                                    </div>
                                @endif
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Visi</label>
                                <textarea name="school[leadership][vision]" rows="3"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.leadership.vision', $settings['school.leadership.vision'] ?? '') }}</textarea>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Misi (setiap baris dipisah dengan enter
                                    atau titik koma)</label>
                                <textarea name="school[leadership][mission]" rows="4"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.leadership.mission', $settings['school.leadership.mission'] ?? '') }}</textarea>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Tujuan Sekolah (setiap baris = 1
                                    tujuan)</label>
                                <textarea name="school[leadership][goals]" rows="4"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.leadership.goals', $settings['school.leadership.goals'] ?? '') }}</textarea>
                            </div>

                            <div class="sm:col-span-1">
                                <label class="text-sm font-semibold text-slate-700">Moto</label>
                                <input type="text" name="school[leadership][motto]"
                                    value="{{ old('school.leadership.motto', $settings['school.leadership.motto'] ?? '') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Sambutan Kepala Sekolah</label>
                                <textarea name="school[leadership][head_welcome]" rows="4"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.leadership.head_welcome', $settings['school.leadership.head_welcome'] ?? '') }}</textarea>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">Harapan Kepala Sekolah</label>
                                <textarea name="school[leadership][head_harapan]" rows="3"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.leadership.head_harapan', $settings['school.leadership.head_harapan'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- PROGRAM UNGGULAN & NILAI --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center text-rose-600">
                                <i class="fas fa-star text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Program Unggulan & Nilai Sekolah</h2>
                                <p class="text-xs text-slate-500">Format: Nama|icon|Deskripsi (setiap baris = 1
                                    program/nilai)</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Program Unggulan</label>
                                <textarea name="school.programs" rows="6"
                                    placeholder="Program Literasi|book|Program pembiasaan membaca pagi&#10;OSIS|users|Organisasi siswa intra sekolah&#10;Pramuka|campground|Kegiatan kepramukaan"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.programs', $settings['school.programs'] ?? '') }}</textarea>
                                <p class="text-xs text-slate-400 mt-1">Format: <code>Nama|icon|Deskripsi</code> per baris
                                </p>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Nilai-Nilai Sekolah</label>
                                <textarea name="school.values" rows="6"
                                    placeholder="Integritas|shield-alt|Berperilaku jujur dan bertanggung jawab&#10;Mandiri|user-graduate|Mampu belajar secara mandiri"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('school.values', $settings['school.values'] ?? '') }}</textarea>
                                <p class="text-xs text-slate-400 mt-1">Format: <code>Nama|icon|Deskripsi</code> per baris
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- STATISTIK --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
                            <div class="w-10 h-10 rounded-xl bg-cyan-100 flex items-center justify-center text-cyan-600">
                                <i class="fas fa-chart-simple text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Statistik Sekolah</h2>
                                <p class="text-xs text-slate-500">Angka statistik yang ditampilkan di halaman profil.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Jumlah Kelas</label>
                                <input type="number" name="school.statistics.jumlah_kelas"
                                    value="{{ old('school.statistics.jumlah_kelas', $settings['school.statistics.jumlah_kelas'] ?? '9') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-700">Jumlah Rombel</label>
                                <input type="number" name="school.statistics.jumlah_rombel"
                                    value="{{ old('school.statistics.jumlah_rombel', $settings['school.statistics.jumlah_rombel'] ?? '0') }}"
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                        </div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- PENGATURAN PPDB / SPMB --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4 rounded-2xl border border-[#D4AF37]/40 bg-[#FFFCF2] p-5 sm:p-6">
                        <div class="flex items-center gap-3 border-b border-[#D4AF37]/30 pb-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#0A2540] text-[#D4AF37]"><i class="fas fa-graduation-cap text-lg"></i></div>
                            <div><h2 class="text-lg font-bold text-slate-800">Pengaturan PPDB / SPMB</h2><p class="text-xs text-slate-500">Kontrol pembukaan pendaftaran dan jadwal tahun ajaran.</p></div>
                        </div>
                        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white p-4">
                            <div><p class="font-bold text-slate-800">Pendaftaran Online</p><p class="text-sm text-slate-600">{{ \App\Models\Setting::ppdbIsOpen() ? 'Pendaftaran sedang dibuka.' : 'Pendaftaran sedang ditutup.' }}</p></div>
                            <label class="relative inline-flex cursor-pointer items-center"><input type="checkbox" name="ppdb_open" value="1" class="peer sr-only" @checked(old('ppdb_open', (bool) ($settings['ppdb_open'] ?? true)))><span class="h-7 w-12 rounded-full bg-rose-200 transition peer-checked:bg-emerald-500"></span><span class="absolute left-1 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span><span class="sr-only">Aktifkan PPDB</span></label>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div><label class="text-sm font-semibold text-slate-700">Tahun Ajaran</label><input type="text" name="ppdb_academic_year" value="{{ old('ppdb_academic_year', $settings['ppdb_academic_year'] ?? '2026/2027') }}" placeholder="2026/2027" pattern="\d{4}/\d{4}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm"></div>
                            <div><label class="text-sm font-semibold text-slate-700">Tanggal Mulai</label><input type="date" name="ppdb_start_date" value="{{ old('ppdb_start_date', $settings['ppdb_start_date'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm"></div>
                            <div><label class="text-sm font-semibold text-slate-700">Tanggal Tutup</label><input type="date" name="ppdb_end_date" value="{{ old('ppdb_end_date', $settings['ppdb_end_date'] ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm"></div>
                        </div>
                        <div><label class="text-sm font-semibold text-slate-700">Pesan Pendaftaran Ditutup</label><textarea name="ppdb_close_message" rows="3" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm">{{ old('ppdb_close_message', $settings['ppdb_close_message'] ?? 'Pendaftaran PPDB/SPMB Tahun Ajaran 2026/2027 saat ini telah ditutup. Mohon menunggu informasi pendaftaran berikutnya.') }}</textarea></div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- SISTEM --}}
                    {{-- ============================================================ --}}
                    <section class="space-y-4">
                        <div class="flex items-center gap-3 pb-2 border-b border-slate-200">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600">
                                <i class="fas fa-shield-halved text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Sistem</h2>
                                <p class="text-xs text-slate-500">Mode maintenance dan pengaturan sistem.</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between rounded-xl border border-slate-200 p-4 bg-slate-50">
                            <div>
                                <p class="font-bold text-slate-800">Maintenance Mode</p>
                                <p class="text-sm text-slate-600">Jika ON, landing system akan menampilkan halaman
                                    maintenance.</p>
                            </div>

                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="system.maintenance.enabled" class="sr-only"
                                    {{ old('system.maintenance.enabled', (bool) ($settings['system.maintenance.enabled'] ?? false)) ? 'checked' : '' }} />
                                <span class="relative w-11 h-6 bg-slate-200 rounded-full transition">
                                    <span
                                        class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-sm transition transform"></span>
                                </span>
                            </label>
                        </div>
                    </section>

                    {{-- ============================================================ --}}
                    {{-- ACTION BUTTONS --}}
                    {{-- ============================================================ --}}
                    <div class="flex justify-end gap-3 pt-2 border-t border-slate-200">
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 bg-white text-sm font-semibold hover:bg-slate-50">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition">
                            <i class="fas fa-save mr-2"></i> Simpan Settings
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
