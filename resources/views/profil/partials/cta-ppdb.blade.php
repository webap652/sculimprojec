@php
    $ppdbOpen = \App\Models\Setting::ppdbIsOpen();
    $ppdbUrl = route('register.form');
@endphp
<div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl shadow-lg overflow-hidden relative">
    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-10 -mt-10"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-8 -mb-8"></div>
    <div class="relative z-10 p-6 text-center">
        <div class="w-14 h-14 mx-auto bg-accent-500 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-graduation-cap text-white text-xl"></i>
        </div>
        <h3 class="text-white font-bold text-lg mb-2">Bergabung Bersama Kami</h3>
        <p class="text-blue-100 text-sm mb-5">Daftarkan putra-putri Anda di SMP Negeri 1 Pirime. Cetak generasi emas
            Lanny Jaya.</p>
        @if ($ppdbOpen)
        <a href="{{ $ppdbUrl }}"
            class="inline-flex items-center bg-white hover:bg-blue-50 text-primary-700 px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-md hover:-translate-y-0.5">
            <i class="fas fa-user-plus mr-2"></i> Daftar PPDB
        </a>
        @else
        <span class="inline-flex items-center bg-rose-100 text-rose-700 px-6 py-3 rounded-xl font-bold text-sm"><i class="fas fa-lock mr-2"></i>Pendaftaran Ditutup</span>
        @endif
    </div>
</div>
