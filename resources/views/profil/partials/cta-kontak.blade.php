@php
    $telepon = \App\Models\Setting::get('school.contact.phone', '-');
    $email = \App\Models\Setting::get('school.contact.email', '-');
    $alamat = \App\Models\Setting::get('school.contact.address', '-');
@endphp
<div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl shadow-lg overflow-hidden relative">
    <div class="absolute top-0 left-0 w-32 h-32 bg-white opacity-5 rounded-full -ml-12 -mt-12"></div>
    <div class="relative z-10 p-6 text-center">
        <div class="w-14 h-14 mx-auto bg-blue-500 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-headset text-white text-xl"></i>
        </div>
        <h3 class="text-white font-bold text-lg mb-2">Hubungi Kami</h3>
        <p class="text-slate-300 text-sm mb-4">Punya pertanyaan? Tim kami siap membantu.</p>
        <div class="space-y-2 text-left">
            <div class="flex items-center gap-3 text-sm text-slate-300">
                <i class="fas fa-phone text-blue-400 w-4"></i>
                <span>{{ $telepon }}</span>
            </div>
            <div class="flex items-center gap-3 text-sm text-slate-300">
                <i class="fas fa-envelope text-blue-400 w-4"></i>
                <span>{{ $email }}</span>
            </div>
            <div class="flex items-start gap-3 text-sm text-slate-300">
                <i class="fas fa-map-marker-alt text-blue-400 w-4 mt-0.5"></i>
                <span>{{ $alamat }}</span>
            </div>
        </div>
    </div>
</div>
