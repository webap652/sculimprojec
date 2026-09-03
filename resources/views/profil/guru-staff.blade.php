  @extends('layouts.app')

  @section('title', 'Guru & Staff - SMP NEGERI 1 PIRIME')
  @section('description',
      'Dedikasi dan profesionalisme tenaga pendidik dan kependidikan dalam mencetak generasi unggul
      SMP Negeri 1 Pirime.')

      @php
          $jabatanList = $gurus->pluck('jabatan')->filter()->unique()->values();
          $jumlahHonorer = $gurus->where('status', 'Honorer')->count();
      @endphp

  @section('hero')
      @php $breadcrumb = ['Beranda', 'Profil', 'Guru & Staff']; @endphp
      @include('layouts.partials.public-hero', [
          'title' => 'Guru & Staff',
          'desc' =>
              'Dedikasi dan profesionalisme tenaga pendidik dan kependidikan dalam mencetak generasi unggul.',
          'bg' => asset('images/hero-bg/hero bg (2).png'),
          'breadcrumb' => $breadcrumb,
      ])
  @endsection

  @section('content')
      @php
          $navy = '#0A2540';
          $gold = '#D4AF37';
      @endphp

      <style>
          .staf-card {
              transition: transform .35s ease, box-shadow .35s ease;
          }

          .staf-card:hover {
              transform: translateY(-8px);
              box-shadow: 0 20px 40px -12px rgba(10, 37, 64, 0.25);
          }

          .staf-card:hover .staf-photo {
              transform: scale(1.06);
          }

          .staf-photo {
              transition: transform .5s ease;
          }

          .badge-gold {
              background: linear-gradient(135deg, #D4AF37, #f0d476);
          }
      </style>

      <div class="bg-[#F5F7FA]">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
              @include('profil.partials.sidebar')

              {{-- Section Heading --}}
              <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10" data-aos="fade-up">
                  <div>
                      <div class="inline-flex items-center gap-2 font-semibold text-sm uppercase tracking-widest mb-2"
                          style="color: {{ $gold }}">
                          <span class="w-10 h-0.5 rounded-full" style="background: {{ $gold }}"></span>
                          Tim Kami
                      </div>
                      <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0A2540]">Guru & Tenaga Kependidikan</h2>
                      <p class="text-slate-500 mt-3 max-w-2xl leading-relaxed">
                          Para pendidik profesional yang berdedikasi mendampingi peserta didik meraih prestasi dan masa
                          depan
                          yang gemilang.
                      </p>
                  </div>
                  <div
                      class="hidden md:flex items-center gap-3 bg-white rounded-2xl shadow-sm px-5 py-3 border border-slate-100">
                      <div class="w-12 h-12 rounded-xl bg-[#0A2540] text-white flex items-center justify-center">
                          <i class="fas fa-medal text-xl" style="color: {{ $gold }}"></i>
                      </div>
                      <div>
                          <div class="text-2xl font-extrabold text-[#0A2540]">{{ $gurus->count() }}</div>
                          <div class="text-xs text-slate-500">Guru & Staff</div>
                      </div>
                  </div>
              </div>

              {{-- Statistics --}}
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10" data-aos="fade-up">
                  <div
                      class="relative overflow-hidden rounded-2xl bg-[#0A2540] text-white p-6 shadow-lg hover:-translate-y-1 transition-all duration-300">
                      <div class="absolute -right-6 -top-6 w-28 h-28 rounded-full bg-white/5"></div>
                      <div class="absolute -right-2 -top-2 w-16 h-16 rounded-full bg-white/5"></div>
                      <div class="flex items-center justify-between">
                          <div>
                              <div class="counter text-4xl font-extrabold" data-target="{{ $jumlahGuru }}">0</div>
                              <p class="text-white/70 text-sm mt-1 font-medium">Total Guru</p>
                          </div>
                          <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">
                              👨‍🏫
                          </div>
                      </div>
                  </div>

                  <div
                      class="relative overflow-hidden rounded-2xl bg-white text-[#0A2540] p-6 shadow-lg border border-slate-100 hover:-translate-y-1 transition-all duration-300">
                      <div class="absolute -right-6 -top-6 w-28 h-28 rounded-full"
                          style="background: {{ $gold }}11">
                      </div>
                      <div class="flex items-center justify-between">
                          <div>
                              <div class="counter text-4xl font-extrabold" data-target="{{ $jumlahHonorer }}">0</div>
                              <p class="text-slate-500 text-sm mt-1 font-medium">Tenaga Kependidikan</p>
                          </div>
                          <div class="w-14 h-14 rounded-2xl bg-[#F5F7FA] flex items-center justify-center text-2xl">
                              👥
                          </div>
                      </div>
                  </div>

                  <div
                      class="relative overflow-hidden rounded-2xl bg-white text-[#0A2540] p-6 shadow-lg border border-slate-100 hover:-translate-y-1 transition-all duration-300">
                      <div class="absolute -right-6 -top-6 w-28 h-28 rounded-full"
                          style="background: {{ $gold }}11">
                      </div>
                      <div class="flex items-center justify-between">
                          <div>
                              <div class="text-4xl font-extrabold truncate max-w-[180px]">
                                  {{ $data['kepala_sekolah'] ?? 'Kepala Sekolah' }}</div>
                              <p class="text-slate-500 text-sm mt-1 font-medium">Kepala Sekolah</p>
                          </div>
                          <div class="w-14 h-14 rounded-2xl bg-[#F5F7FA] flex items-center justify-center text-2xl">
                              👑
                          </div>
                      </div>
                  </div>
              </div>

              {{-- Search & Filter --}}
              <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-10" data-aos="fade-up">
                  <div class="flex flex-col md:flex-row gap-4">
                      <div class="relative flex-1">
                          <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                          <input type="text" id="searchGuru" placeholder="Cari nama guru..."
                              class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:border-[#0A2540] focus:ring-2 focus:ring-[#D4AF37]/30 outline-none transition text-sm">
                      </div>
                      <div class="relative">
                          <select id="filterJabatan" onchange="filterByJabatan(this.value)"
                              class="w-full md:w-64 pl-4 pr-10 py-3 rounded-xl border border-slate-200 focus:border-[#0A2540] focus:ring-2 focus:ring-[#D4AF37]/30 outline-none transition text-sm bg-white appearance-none">
                              <option value="all">Semua Jabatan</option>
                              @foreach ($jabatanList as $jabatan)
                                  <option value="{{ $jabatan }}">{{ $jabatan }}</option>
                              @endforeach
                          </select>
                          <i
                              class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                      </div>
                  </div>
              </div>

              {{-- Guru Cards Grid --}}
              @if ($gurus->count() > 0)
                  <div class="grid grid-cols-4 gap-2 sm:gap-3 lg:gap-6" id="guruGrid">
                      @foreach ($gurus as $guru)
                          <div class="staf-card guru-card group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden"
                              data-mapel="{{ strtolower($guru->mapel ?? '-') }}"
                              data-jabatan="{{ strtolower($guru->jabatan ?? '-') }}"
                              data-name="{{ strtolower($guru->nama_lengkap) }}"
                              data-foto="{{ $guru->foto ? asset('storage/' . $guru->foto) : '' }}"
                              data-nama="{{ $guru->nama_lengkap }}" data-nip="{{ $guru->nip ?? '' }}"
                              data-jabatan-foto="{{ $guru->jabatan ?? '' }}" data-status="{{ $guru->status ?? '' }}"
                              data-pendidikan="{{ $guru->pendidikan ?? '' }}" data-mapel-foto="{{ $guru->mapel ?? '' }}"
                              data-email="{{ $guru->email ?? '' }}" data-nohp="{{ $guru->no_hp ?? '' }}"
                              data-aos="fade-up">
                              {{-- Foto half-body tampil penuh (rasio 3:4) --}}
                              <div class="relative aspect-[3/4] bg-[#F5F7FA] overflow-hidden">
                                  @if ($guru->foto)
                                      <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama_lengkap }}"
                                          class="staf-photo w-full h-full object-cover object-top" loading="lazy">
                                  @else
                                      <div
                                          class="w-full h-full bg-gradient-to-br from-[#0A2540] to-[#1d3a5f] flex items-center justify-center">
                                          <div
                                              class="w-24 h-24 rounded-full bg-white/10 border-4 border-white/30 flex items-center justify-center text-5xl font-bold text-white">
                                              {{ strtoupper(substr($guru->nama_lengkap, 0, 1)) }}
                                          </div>
                                      </div>
                                  @endif
                                  {{-- Badge posisi --}}
                                  @if ($guru->status)
                                      <div class="absolute top-3 right-3">
                                          <span
                                              class="px-3 py-1 rounded-full text-xs font-semibold text-white shadow {{ $guru->status == 'ASN' ? 'bg-[#0A2540]' : 'badge-gold text-[#0A2540]' }}">{{ $guru->status }}</span>
                                      </div>
                                  @endif
                              </div>

                              {{-- Info --}}
                              <div class="p-2 sm:p-4 lg:p-5 text-center">
                                  <h3
                                      class="font-semibold leading-tight text-[11px] sm:text-sm lg:text-base text-[#0A2540]">
                                      {{ $guru->nama_lengkap }}</h3>
                                  @if ($guru->jabatan)
                                      <p class="text-[10px] sm:text-xs lg:text-sm font-semibold mt-0.5 sm:mt-1 truncate"
                                          style="color: {{ $gold }}">{{ $guru->jabatan }}</p>
                                  @endif
                                  @if ($guru->nip)
                                      <p
                                          class="hidden sm:block text-[10px] lg:text-xs text-slate-400 mt-0.5 lg:mt-1 truncate">
                                          NIP. {{ $guru->nip }}</p>
                                  @endif

                                  <div class="mt-2 sm:mt-3 space-y-1 text-[10px] lg:text-xs text-slate-500">
                                      @if ($guru->pendidikan)
                                          <p class="hidden sm:flex items-center justify-center gap-1.5 truncate"><i
                                                  class="fas fa-graduation-cap text-slate-400"></i>{{ $guru->pendidikan }}
                                          </p>
                                      @endif
                                      @if ($guru->mapel)
                                          <p class="flex items-center justify-center gap-1.5 truncate"><i
                                                  class="fas fa-book-open text-slate-400"></i>{{ $guru->mapel }}</p>
                                      @endif
                                  </div>

                                  <button type="button" onclick="openProfile(this)"
                                      class="group/link mt-2 sm:mt-4 lg:mt-5 inline-flex items-center justify-center gap-1 w-full py-1.5 sm:py-2 lg:py-2.5 rounded-lg sm:rounded-xl text-[10px] lg:text-sm font-semibold text-white transition-all duration-300 hover:opacity-90 cursor-pointer"
                                      style="background: {{ $navy }}">
                                      <span class="hidden lg:inline">Lihat Profil</span>
                                      <span class="lg:hidden"><i class="fas fa-eye"></i></span>
                                      <i
                                          class="fas fa-arrow-right hidden lg:inline group-hover/link:translate-x-1 transition-transform duration-300"></i>
                                  </button>
                              </div>
                          </div>
                      @endforeach
                  </div>
              @else
                  <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center" data-aos="fade-up">
                      <div class="w-20 h-20 mx-auto rounded-2xl bg-[#F5F7FA] flex items-center justify-center mb-4">
                          <i class="fas fa-chalkboard-user text-3xl" style="color: {{ $gold }}"></i>
                      </div>
                      <h3 class="text-xl font-bold text-[#0A2540]">Data Guru Belum Tersedia</h3>
                      <p class="text-slate-400 mt-2">Admin sekolah akan segera melengkapi data guru dan tenaga
                          kependidikan.
                      </p>
                  </div>
              @endif
          </div>
      </div>

      {{-- Modal Detail Profil --}}
      <div id="profileModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6">
          <div class="absolute inset-0 bg-[#0A2540]/70 backdrop-blur-sm" onclick="closeProfile()"></div>
          <div
              class="relative bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto animate-fade-in-up">
              <button type="button" onclick="closeProfile()"
                  class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-white/90 hover:bg-white text-slate-600 hover:text-[#0A2540] flex items-center justify-center shadow-md transition">
                  <i class="fas fa-times"></i>
              </button>

              <div class="relative h-56 sm:h-64 bg-[#0A2540] overflow-hidden">
                  <div class="absolute inset-0 opacity-20"
                      style="background-image: radial-gradient(circle at 20% 30%, #D4AF37 2px, transparent 2px), radial-gradient(circle at 80% 70%, #D4AF37 2px, transparent 2px); background-size: 40px 40px;">
                  </div>
                  <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent"></div>
                  <div class="absolute bottom-0 left-6 sm:left-10 translate-y-1/2">
                      <div id="modalPhoto"
                          class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl border-4 border-white shadow-xl overflow-hidden bg-[#F5F7FA] flex items-center justify-center">
                          <img id="modalPhotoImg" src="" alt="Foto Guru"
                              class="hidden w-full h-full object-cover object-top">
                          <span id="modalPhotoInitial"
                              class="w-full h-full flex items-center justify-center text-5xl font-extrabold text-white bg-gradient-to-br from-[#0A2540] to-[#1d3a5f]">-</span>
                      </div>
                  </div>
              </div>

              <div class="pt-16 sm:pt-20 px-6 sm:px-10 pb-8">
                  <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                      <div>
                          <h3 id="modalNama" class="text-2xl sm:text-3xl font-extrabold text-[#0A2540]"></h3>
                          <p id="modalJabatan" class="text-base font-semibold mt-1" style="color: {{ $gold }}">
                          </p>
                          <p id="modalNip" class="text-sm text-slate-400 mt-1"></p>
                      </div>
                      <span id="modalStatus"
                          class="self-start px-4 py-1.5 rounded-full text-xs font-bold text-white shrink-0"></span>
                  </div>

                  <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
                      <div class="flex items-center gap-3 rounded-xl bg-[#F5F7FA] px-4 py-3">
                          <div
                              class="w-10 h-10 rounded-lg bg-[#0A2540] text-white flex items-center justify-center shrink-0">
                              <i class="fas fa-graduation-cap" style="color: {{ $gold }}"></i>
                          </div>
                          <div class="min-w-0">
                              <p class="text-xs text-slate-400">Pendidikan</p>
                              <p id="modalPendidikan" class="text-sm font-semibold text-slate-700 truncate">-</p>
                          </div>
                      </div>
                      <div class="flex items-center gap-3 rounded-xl bg-[#F5F7FA] px-4 py-3">
                          <div
                              class="w-10 h-10 rounded-lg bg-[#0A2540] text-white flex items-center justify-center shrink-0">
                              <i class="fas fa-book-open" style="color: {{ $gold }}"></i>
                          </div>
                          <div class="min-w-0">
                              <p class="text-xs text-slate-400">Mata Pelajaran</p>
                              <p id="modalMapel" class="text-sm font-semibold text-slate-700 truncate">-</p>
                          </div>
                      </div>
                      <div class="flex items-center gap-3 rounded-xl bg-[#F5F7FA] px-4 py-3">
                          <div
                              class="w-10 h-10 rounded-lg bg-[#0A2540] text-white flex items-center justify-center shrink-0">
                              <i class="fas fa-envelope" style="color: {{ $gold }}"></i>
                          </div>
                          <div class="min-w-0">
                              <p class="text-xs text-slate-400">Email</p>
                              <p id="modalEmail" class="text-sm font-semibold text-slate-700 truncate">-</p>
                          </div>
                      </div>
                      <div class="flex items-center gap-3 rounded-xl bg-[#F5F7FA] px-4 py-3">
                          <div
                              class="w-10 h-10 rounded-lg bg-[#0A2540] text-white flex items-center justify-center shrink-0">
                              <i class="fab fa-whatsapp" style="color: {{ $gold }}"></i>
                          </div>
                          <div class="min-w-0">
                              <p class="text-xs text-slate-400">No. HP / WhatsApp</p>
                              <p id="modalNoHp" class="text-sm font-semibold text-slate-700 truncate">-</p>
                          </div>
                      </div>
                  </div>

                  <div class="mt-6 flex flex-col sm:flex-row gap-3">
                      <a id="modalEmailLink" href="#" target="_blank"
                          class="flex-1 inline-flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold text-white transition hover:opacity-90"
                          style="background: {{ $navy }}">
                          <i class="fas fa-envelope"></i> Kirim Email
                      </a>
                      <a id="modalWaLink" href="#" target="_blank"
                          class="flex-1 inline-flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold bg-green-500 text-white transition hover:bg-green-600">
                          <i class="fab fa-whatsapp"></i> Chat WhatsApp
                      </a>
                  </div>
              </div>
          </div>
      </div>
  @endsection

  @push('scripts')
      <script>
          function openProfile(btn) {
              const card = btn.closest('.guru-card');
              const foto = card.dataset.foto || '';
              const nama = card.dataset.nama || '';
              const nip = card.dataset.nip || '';
              const jabatan = card.dataset.jabatanFoto || '';
              const status = card.dataset.status || '';
              const pendidikan = card.dataset.pendidikan || '';
              const mapel = card.dataset.mapelFoto || '';
              const email = card.dataset.email || '';
              const nohp = card.dataset.nohp || '';

              // Foto
              const photoImg = document.getElementById('modalPhotoImg');
              const photoInitial = document.getElementById('modalPhotoInitial');
              if (foto) {
                  photoImg.src = foto;
                  photoImg.classList.remove('hidden');
                  photoInitial.classList.add('hidden');
              } else {
                  photoImg.classList.add('hidden');
                  photoInitial.classList.remove('hidden');
                  photoInitial.textContent = (nama.charAt(0) || '-').toUpperCase();
              }

              // Info
              document.getElementById('modalNama').textContent = nama;
              document.getElementById('modalJabatan').textContent = jabatan;
              document.getElementById('modalNip').textContent = nip ? 'NIP. ' + nip : '';

              // Status badge
              const statusEl = document.getElementById('modalStatus');
              if (status) {
                  statusEl.style.display = 'inline-flex';
                  statusEl.textContent = status;
                  statusEl.className = 'self-start px-4 py-1.5 rounded-full text-xs font-bold text-white shrink-0 ' +
                      (status === 'ASN' ? 'bg-[#0A2540]' : 'badge-gold text-[#0A2540]');
              } else {
                  statusEl.style.display = 'none';
              }

              document.getElementById('modalPendidikan').textContent = pendidikan || '-';
              document.getElementById('modalMapel').textContent = mapel || '-';
              document.getElementById('modalEmail').textContent = email || '-';
              document.getElementById('modalNoHp').textContent = nohp || '-';
              document.getElementById('modalEmailLink').href = email ? 'mailto:' + email : '#';
              document.getElementById('modalWaLink').href = nohp ? 'https://wa.me/' + nohp.replace(/[^0-9]/g, '') : '#';

              document.body.style.overflow = 'hidden';
              const modal = document.getElementById('profileModal');
              modal.classList.remove('hidden');
              modal.classList.add('flex');
          }

          function closeProfile() {
              const modal = document.getElementById('profileModal');
              modal.classList.add('hidden');
              modal.classList.remove('flex');
              document.body.style.overflow = '';
          }

          document.addEventListener('keydown', function(e) {
              if (e.key === 'Escape') closeProfile();
          });

          function applyFilters() {
              const query = (document.getElementById('searchGuru')?.value || '').toLowerCase().trim();
              const jabatan = (document.getElementById('filterJabatan')?.value || 'all').toLowerCase();
              document.querySelectorAll('.guru-card').forEach(card => {
                  const name = card.dataset.name || '';
                  const cardJabatan = card.dataset.jabatan || '';
                  const matchName = name.includes(query);
                  const matchJabatan = jabatan === 'all' || cardJabatan === jabatan;
                  card.style.display = (matchName && matchJabatan) ? 'block' : 'none';
              });
          }

          function filterByJabatan() {
              applyFilters();
          }

          document.addEventListener('DOMContentLoaded', function() {
              const searchInput = document.getElementById('searchGuru');
              if (searchInput) {
                  searchInput.addEventListener('input', applyFilters);
              }
          });
      </script>
  @endpush
