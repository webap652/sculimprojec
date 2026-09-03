@php
    $items = $items ?? collect();
@endphp

@if ($items->count() > 0)
    <div class="flex flex-col">
        @foreach ($items as $pengumuman)
            <div
                class="group border-b border-slate-100 last:border-0 py-5 first:pt-0 last:pb-0 hover:bg-slate-50/50 transition-colors px-2 rounded-lg">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-1.5">
                            <span class="text-xs font-medium text-slate-400 flex items-center">
                                <i class="far fa-calendar-alt mr-1.5"></i>
                                {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y') : $pengumuman->created_at->format('d M Y') }}
                            </span>
                            @if (!empty($pengumuman->jenis))
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-[11px] font-semibold text-blue-600 uppercase tracking-wider">
                                    {{ $pengumuman->jenis }}
                                </span>
                            @endif
                        </div>

                        <h3
                            class="text-base font-bold text-slate-800 leading-snug mb-2 group-hover:text-blue-600 transition-colors">
                            {{ $pengumuman->judul }}
                        </h3>

                        <p class="text-slate-600 text-sm line-clamp-2 leading-relaxed">
                            {{ $pengumuman->isi ? Str::limit(strip_tags($pengumuman->isi), 150) : 'Tidak ada deskripsi detail.' }}
                        </p>
                    </div>

                    <div class="md:text-right shrink-0 mt-2 md:mt-0">
                        <a href="{{ route('pengumuman.show', $pengumuman) }}"
                            class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700">
                            Detail <i class="fas fa-chevron-right text-[10px] ml-1.5"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-10">
        <i class="fas fa-inbox text-3xl text-slate-300 mb-3"></i>
        <h4 class="text-base font-semibold text-slate-700">Belum ada data</h4>
        <p class="text-sm text-slate-500 mt-1">Saat ini belum ada pengumuman untuk kategori ini.</p>
    </div>
@endif
