 @extends('siswa.layout')
 @section('title', 'Berkas Pendaftaran')
 @section('pageTitle', 'Berkas Pendaftaran')

 @section('content')
     <div class="max-w-5xl mx-auto space-y-6">

         {{-- Header --}}
         <div
             class="relative bg-gradient-to-r from-indigo-700 via-indigo-600 to-brand-700 rounded-2xl shadow-sm p-6 sm:p-8 overflow-hidden">
             <div
                 class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
             </div>
             <div class="relative z-10 flex items-center gap-4">
                 <div class="w-14 h-14 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center">
                     <i class="fas fa-file-upload text-2xl text-white"></i>
                 </div>
                 <div>
                     <h1 class="text-2xl font-extrabold text-white">Upload Berkas</h1>
                     <p class="text-indigo-100 text-sm">Kelola dokumen persyaratan pendaftaran Anda</p>
                 </div>
             </div>
         </div>

         @if (session('success'))
             <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 rounded-2xl p-4">
                 <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                     <i class="fas fa-check-circle"></i>
                 </div>
                 <p class="text-emerald-700 text-sm font-medium">{{ session('success') }}</p>
             </div>
         @endif

         @if ($errors->any())
             <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 rounded-2xl p-4">
                 <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                     <i class="fas fa-exclamation-triangle"></i>
                 </div>
                 <div>
                     <p class="text-rose-700 text-sm font-medium mb-1">Periksa kembali upload Anda:</p>
                     <ul class="list-disc list-inside text-rose-600 text-sm space-y-0.5">
                         @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
             </div>
         @endif

         <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
             {{-- Form Upload --}}
             <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                 <div class="p-6 border-b border-slate-50">
                     <h2 class="font-bold text-slate-800">Form Upload Berkas</h2>
                     <p class="text-xs text-slate-500 mt-0.5">Format: JPG/PNG/PDF, maksimal 2MB per file</p>
                 </div>

                 <form action="{{ route('siswa.ppdb.berkas.upload') }}" method="POST" enctype="multipart/form-data"
                     class="p-6 space-y-5">
                     @csrf

                     @php
                         $fields = [
                             'foto_profil' => ['Foto Profil', 'image', 'fas fa-id-badge'],
                             'foto' => ['Pas Foto 3x4', 'image', 'fas fa-camera'],
                             'kk' => ['Kartu Keluarga', 'document', 'fas fa-users'],
                             'akte' => ['Akta Kelahiran', 'document', 'fas fa-file'],
                             'ijazah' => ['Ijazah / Surat Keterangan Lulus', 'document', 'fas fa-graduation-cap'],
                             'kartu_nisn' => ['Kartu NISN', 'document', 'fas fa-id-card'],
                         ];
                     @endphp

                     @foreach ($fields as $field => $data)
                         @php
                             [$label, $type, $icon] = $data;
                             $hasFile = $pendaftar && $pendaftar->$field;
                         @endphp
                         <div
                             class="flex flex-col sm:flex-row sm:items-center gap-3 p-4 rounded-xl border {{ $hasFile ? 'border-emerald-200 bg-emerald-50/40' : 'border-slate-200 bg-slate-50/60' }}">
                             <div
                                 class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $hasFile ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-200 text-slate-500' }}">
                                 <i class="{{ $icon }}"></i>
                             </div>
                             <div class="flex-1">
                                 <label class="block text-sm font-bold text-slate-700">{{ $label }}</label>
                                 <label
                                     class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-colors">
                                     <i class="fas fa-cloud-arrow-up text-indigo-500"></i>
                                     Pilih File
                                     <input type="file" name="{{ $field }}" class="hidden"
                                         accept="{{ $type == 'image' ? 'image/*' : '.jpg,.jpeg,.png,.pdf' }}">
                                 </label>
                                 @if ($hasFile)
                                     <a href="{{ asset('storage/' . $pendaftar->$field) }}" target="_blank"
                                         class="ml-2 text-xs font-semibold text-emerald-600 hover:text-emerald-800">
                                         <i class="fas fa-eye mr-1"></i> Lihat file
                                     </a>
                                 @endif
                             </div>
                             <span class="text-xs font-bold {{ $hasFile ? 'text-emerald-600' : 'text-slate-400' }}">
                                 {{ $hasFile ? '✓ Terupload' : 'Belum upload' }}
                             </span>
                         </div>
                     @endforeach

                     <button type="submit"
                         class="inline-flex items-center justify-center w-full px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transition-all hover:-translate-y-0.5">
                         <i class="fas fa-upload mr-2"></i> Simpan Berkas
                     </button>
                 </form>
             </div>

             {{-- Sidebar info --}}
             <div class="space-y-6">
                 <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                     <h3 class="font-bold text-slate-800 mb-4 flex items-center">
                         <i class="fas fa-circle-info text-indigo-500 mr-2"></i> Informasi
                     </h3>
                     <ul class="space-y-3 text-sm text-slate-600">
                         <li class="flex gap-2"><i class="fas fa-check-circle text-emerald-500 mt-0.5"></i> Pastikan file
                             yang diupload jelas dan dapat dibaca.</li>
                         <li class="flex gap-2"><i class="fas fa-check-circle text-emerald-500 mt-0.5"></i> Format PDF, JPG,
                             atau PNG dengan ukuran maksimal 2MB.</li>
                         <li class="flex gap-2"><i class="fas fa-check-circle text-emerald-500 mt-0.5"></i> Berkas yang
                             lengkap mempercepat proses verifikasi.</li>
                     </ul>
                 </div>

                 <div class="bg-gradient-to-br from-indigo-600 to-brand-700 rounded-2xl p-6 text-white">
                     <div class="flex items-center gap-3 mb-3">
                         <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                             <i class="fas fa-paper-plane"></i>
                         </div>
                         <h3 class="font-bold">Butuh Bantuan?</h3>
                     </div>
                     <p class="text-sm text-indigo-100">Hubungi admin sekolah jika mengalami kendala saat mengupload berkas.
                     </p>
                 </div>
             </div>
         </div>
     </div>
 @endsection
