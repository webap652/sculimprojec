@php
    $items = $items ?? collect();
    $itemsWithImage = $items->filter(function ($item) {
        return !empty($item->gambar);
    });
@endphp

@if ($itemsWithImage->count() > 0)
    <div class="grid grid-cols-1 gap-3">
        @foreach ($itemsWithImage as $pengumuman)
            @php
                $gambarUrl = asset('storage/pengumuman/' . $pengumuman->gambar);
            @endphp
            <div
                class="flex items-center justify-between p-4 border border-slate-200 rounded-xl hover:border-blue-300 transition-colors bg-slate-50/50">

                <div class="flex items-center gap-4 min-w-0">
                    <div
                        class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                        <i class="fas fa-file-image text-lg"></i>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-sm font-bold text-slate-800 truncate">
                            {{ $pengumuman->judul }}
                        </h3>
                        <div class="text-xs text-slate-500 mt-0.5">
                            {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y') : $pengumuman->created_at->format('d M Y') }}
                            @if (!empty($pengumuman->jenis))
                                • {{ $pengumuman->jenis }}
                            @endif
                        </div>
                    </div>
                </div>

                <a href="{{ $gambarUrl }}" download target="_blank"
                    class="ml-4 shrink-0 px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-50 hover:text-blue-600 transition-colors shadow-sm">
                    <i class="fas fa-download mr-1.5"></i> Unduh
                </a>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-10">
        <i class="fas fa-folder-open text-3xl text-slate-300 mb-3"></i>
        <h4 class="text-base font-semibold text-slate-700">Belum ada berkas</h4>
        <p class="text-sm text-slate-500 mt-1">Tidak ada dokumen atau gambar yang tersedia untuk diunduh saat ini.</p>
    </div>
@endifss
</div>
@endif
