  @extends('layouts.app')

  @section('title', 'PPDB - SMP NEGERI 1 PIRIME')

  @section('hero')
      @php
          $breadcrumb = ['Beranda', 'PPDB'];
      @endphp

      @include('layouts.partials.public-hero', [
          'title' => 'PPDB',
          'desc' =>
              'Informasi penerimaan peserta didik baru SMP Negeri 1 Pirime. Daftar PPDB online dan cek jadwal penting.',
          'bg' => asset('images/hero-bg/hero bg (2).png'),
          'breadcrumb' => $breadcrumb,
      ])
  @endsection

  @section('content')
      @if (session('error'))
          <div class="mx-auto mt-6 max-w-3xl rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-center text-sm font-medium text-rose-700">{{ session('error') }}</div>
      @endif
      <style>
          .ppdb-card {
              transition: transform 0.3s;
          }

          .ppdb-card:hover {
              transform: translateY(-5px);
          }

          .timeline {
              position: relative;
              padding-left: 30px;
          }

          .timeline::before {
              content: '';
              position: absolute;
              left: 15px;
              top: 0;
              bottom: 0;
              width: 2px;
              background: #0A2540;
          }

          .timeline-item {
              position: relative;
              margin-bottom: 30px;
          }

          .timeline-item::before {
              content: '';
              position: absolute;
              left: -22px;
              top: 5px;
              width: 12px;
              height: 12px;
              border-radius: 50%;
              background: #053bee;
              border: 3px solid white;
              box-shadow: 0 0 0 3px #0630ec;
          }
      </style>

      <div class="bg-[#F8FAFC]">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

              {{-- PPDB Online Link --}}
              <div class="text-center mb-14" data-aos="fade-up">
                  <div
                      class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold border border-primary-100 mb-4">
                      <i class="fas fa-user-graduate text-gold-500"></i>
                      <span>Penerimaan Peserta Didik Baru</span>
                  </div>
                  <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900">PPDB Online</h2>
                  <div class="w-20 h-1.5 bg-gradient-to-r from-primary-500 to-gold-500 mx-auto rounded-full mt-4"></div>
                  <p class="mt-4 text-slate-500 text-lg">Tahun Ajaran {{ $data['ppdb_academic_year'] }}</p>
                  <div class="mt-5 inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-bold {{ $data['ppdb_open'] ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}"><i class="fas {{ $data['ppdb_open'] ? 'fa-circle-check' : 'fa-lock' }}"></i>{{ $data['ppdb_open'] ? 'PENDAFTARAN DIBUKA' : 'PENDAFTARAN DITUTUP' }}</div>
              </div>

              {{-- Stepper --}}
              <div class="max-w-4xl mx-auto mb-14" data-aos="fade-up">
                  <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 md:p-8">
                      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                          @php
                              $steps = [
                                  ['icon' => 'fa-user-plus', 'label' => 'Daftar Akun', 'desc' => 'Buat akun online'],
                                  [
                                      'icon' => 'fa-file-upload',
                                      'label' => 'Isi Formulir',
                                      'desc' => 'Lengkapi data diri',
                                  ],
                                  [
                                      'icon' => 'fa-check-double',
                                      'label' => 'Verifikasi',
                                      'desc' => 'Pemeriksaan berkas',
                                  ],
                                  ['icon' => 'fa-bullhorn', 'label' => 'Pengumuman', 'desc' => 'Hasil seleksi'],
                                  ['icon' => 'fa-user-check', 'label' => 'Daftar Ulang', 'desc' => 'Konfirmasi masuk'],
                              ];
                          @endphp
                          @foreach ($steps as $i => $step)
                              <div class="flex items-center gap-3 md:gap-2 flex-1 {{ $i > 0 ? 'md:ml-2' : '' }}">
                                  <div class="flex items-center gap-3 md:gap-2 w-full {{ $i > 0 ? 'md:flex-col' : '' }}">
                                      @if ($i > 0)
                                          <div
                                              class="hidden md:block w-8 h-0.5 bg-gradient-to-r from-primary-300 to-primary-500 -mr-2">
                                          </div>
                                      @endif
                                      <div class="flex flex-col md:items-center text-center flex-1">
                                          <div
                                              class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-gradient-to-br from-primary-700 to-primary-900 text-gold-400 flex items-center justify-center shadow-lg shadow-primary-900/20 mb-2">
                                              <i class="fas {{ $step['icon'] }} text-lg md:text-xl"></i>
                                          </div>
                                          <span
                                              class="text-xs md:text-sm font-bold text-primary-900">{{ $step['label'] }}</span>
                                          <span
                                              class="hidden md:block text-[10px] text-slate-400">{{ $step['desc'] }}</span>
                                      </div>
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>
              </div>

              <div class="max-w-3xl mx-auto">
                  <div class="bg-white shadow-lg border border-slate-100 rounded-3xl ppdb-card">
                      <div class="p-10 text-center">
                          <div
                              class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-primary-700 to-primary-900 text-gold-400 flex items-center justify-center mb-6 shadow-lg">
                              <i class="fas fa-laptop fa-2x"></i>
                          </div>
                          <h4 class="text-2xl font-bold text-primary-900 mb-3">Sistem PPDB Online</h4>
                          <p class="text-slate-600 mb-8">Lakukan pendaftaran secara online melalui Computer Based Test
                              (CBT) untuk kemudahan dan efisiensi.</p>
                          @if ($data['ppdb_open'])
                              <a href="{{ route('register.form') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-600 hover:to-gold-700 text-primary-900 px-8 py-4 rounded-full font-bold transition-all shadow-lg shadow-gold-500/30 hover:-translate-y-1"><i class="fas fa-user-plus mr-2"></i> Daftar Sekarang</a>
                          @else
                              <div class="mx-auto max-w-xl rounded-2xl border border-rose-200 bg-rose-50 p-5 text-left text-rose-800"><div class="flex items-start gap-3"><i class="fas fa-lock mt-1"></i><div><p class="font-bold">Pendaftaran Sedang Ditutup</p><p class="mt-1 text-sm">{{ $data['ppdb_close_message'] }}</p></div></div></div>
                          @endif
                      </div>
                  </div>
              </div>

              {{-- PPDB Content: Persyaratan, Alur, Jadwal --}}
              <div class="mt-14 grid grid-cols-1 gap-10 lg:grid-cols-2">
                  <div
                      class="bg-white shadow-lg border border-slate-100 rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300">
                      <div class="p-8 md:p-10">
                          <h3 class="text-2xl font-extrabold text-primary-900 mb-3">Persyaratan PPDB</h3>
                          <p class="text-slate-500">Dokumen yang perlu disiapkan untuk pendaftaran</p>

                          <div class="mt-8 grid grid-cols-1 gap-6">
                              <div class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-100">
                                  <div class="flex items-center gap-4 mb-4">
                                      <div
                                          class="w-14 h-14 bg-gradient-to-br from-primary-700 to-primary-900 text-gold-400 rounded-2xl flex items-center justify-center shadow-lg">
                                          <i class="fas fa-file-alt"></i>
                                      </div>
                                      <h4 class="text-lg font-bold text-primary-900">Dokumen Administrasi</h4>
                                  </div>
                                  <ul class="space-y-2.5 text-slate-700">
                                      <li class="flex items-start gap-2"><i
                                              class="fas fa-check-circle text-gold-500 mt-1"></i> Akta
                                          Kelahiran</li>
                                      <li class="flex items-start gap-2"><i
                                              class="fas fa-check-circle text-gold-500 mt-1"></i>
                                          Kartu Keluarga</li>
                                      <li class="flex items-start gap-2"><i
                                              class="fas fa-check-circle text-gold-500 mt-1"></i>
                                          Rapor SD/MI</li>
                                      <li class="flex items-start gap-2"><i
                                              class="fas fa-check-circle text-gold-500 mt-1"></i>
                                          Surat Keterangan Lulus</li>
                                  </ul>
                              </div>

                              <div class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-100">
                                  <div class="flex items-center gap-4 mb-4">
                                      <div
                                          class="w-14 h-14 bg-gradient-to-br from-gold-500 to-gold-600 text-primary-900 rounded-2xl flex items-center justify-center shadow-lg">
                                          <i class="fas fa-images"></i>
                                      </div>
                                      <h4 class="text-lg font-bold text-primary-900">Dokumen Foto</h4>
                                  </div>
                                  <ul class="space-y-2.5 text-slate-700">
                                      <li class="flex items-start gap-2"><i
                                              class="fas fa-check-circle text-gold-500 mt-1"></i> Pas
                                          Foto 3x4 (4 lembar)</li>
                                      <li class="flex items-start gap-2"><i
                                              class="fas fa-check-circle text-gold-500 mt-1"></i> Pas
                                          Foto 4x6 (2 lembar)</li>
                                      <li class="flex items-start gap-2"><i
                                              class="fas fa-check-circle text-gold-500 mt-1"></i> Foto
                                          Copy Ijazah</li>
                                      <li class="flex items-start gap-2"><i
                                              class="fas fa-check-circle text-gold-500 mt-1"></i> Foto
                                          Copy SKHUN</li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div
                      class="bg-white shadow-lg border border-slate-100 rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300">
                      <div class="p-8 md:p-10">
                          <h3 class="text-2xl font-extrabold text-primary-900 mb-3">Alur Pendaftaran</h3>
                          <p class="text-slate-500">Langkah-langkah pendaftaran PPDB</p>

                          <div class="mt-8">
                              <div class="timeline">
                                  @php
                                      $alur = [
                                          [
                                              'title' => 'Pendaftaran Online',
                                              'desc' =>
                                                  'Lakukan pendaftaran melalui website PPDB online dan lengkapi formulir pendaftaran.',
                                          ],
                                          [
                                              'title' => 'Upload Berkas',
                                              'desc' =>
                                                  'Upload semua dokumen persyaratan yang telah dipindai dalam format PDF atau JPG.',
                                          ],
                                          [
                                              'title' => 'Verifikasi Administrasi',
                                              'desc' =>
                                                  'Tim administrasi akan memverifikasi kelengkapan dan keabsahan berkas Anda.',
                                          ],
                                          [
                                              'title' => 'Pengumuman Hasil',
                                              'desc' =>
                                                  'Hasil seleksi akan diumumkan melalui website dan dapat dicek melalui aplikasi.',
                                          ],
                                          [
                                              'title' => 'Daftar Ulang',
                                              'desc' =>
                                                  'Bagi yang diterima, lakukan daftar ulang dengan membawa berkas asli ke sekolah.',
                                          ],
                                      ];
                                  @endphp
                                  @foreach ($alur as $i => $a)
                                      <div class="timeline-item">
                                          <div class="flex items-center gap-2 mb-1">
                                              <span
                                                  class="w-6 h-6 rounded-full bg-primary-900 text-gold-400 text-xs font-bold flex items-center justify-center flex-shrink-0">{{ $i + 1 }}</span>
                                              <h5 class="font-bold text-primary-900">{{ $a['title'] }}</h5>
                                          </div>
                                          <p class="text-slate-600 text-sm leading-relaxed">{{ $a['desc'] }}</p>
                                      </div>
                                  @endforeach
                              </div>
                          </div>

                          {{-- Jadwal --}}
                          <div class="mt-12">
                              <h3 class="text-2xl font-extrabold text-primary-900 mb-3">Jadwal PPDB</h3>
                              <p class="text-slate-500">Timeline penting PPDB {{ $data['ppdb_academic_year'] }}</p>

                              <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                  <div
                                      class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-100 hover:shadow-lg transition-all group">
                                      <i
                                          class="fas fa-calendar-plus text-primary-700 text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                                      <h4 class="font-bold text-primary-900">Pendaftaran Online</h4>
                                      <p class="text-slate-500">Tahun Ajaran {{ $data['ppdb_academic_year'] }}</p>
                                  </div>
                                  <div
                                      class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-100 hover:shadow-lg transition-all group">
                                      <i
                                          class="fas fa-bullhorn text-gold-500 text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                                      <h4 class="font-bold text-primary-900">Pengumuman Hasil</h4>
                                      <p class="text-slate-500">Tahun Ajaran {{ $data['ppdb_academic_year'] }}</p>
                                  </div>
                                  <div
                                      class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-100 hover:shadow-lg transition-all group">
                                      <i
                                          class="fas fa-user-check text-gold-500 text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                                      <h4 class="font-bold text-primary-900">Daftar Ulang</h4>
                                      <p class="text-slate-500">Tahun Ajaran {{ $data['ppdb_academic_year'] }}</p>
                                  </div>
                                  <div
                                      class="bg-[#F8FAFC] rounded-2xl p-6 border border-slate-100 hover:shadow-lg transition-all group">
                                      <i
                                          class="fas fa-school text-primary-700 text-3xl mb-3 group-hover:scale-110 transition-transform"></i>

                                      <p class="text-slate-500">Tahun Ajaran {{ $data['ppdb_academic_year'] }}</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              {{-- Status Check --}}
              <div class="mt-14" data-aos="fade-up">
                  <div
                      class="bg-gradient-to-br from-primary-800 to-primary-950 rounded-3xl shadow-2xl overflow-hidden relative">
                      <div class="absolute -right-10 -top-10 w-64 h-64 rounded-full bg-gold-500/10 blur-3xl"></div>
                      <div class="absolute -left-10 -bottom-10 w-64 h-64 rounded-full bg-white/5 blur-3xl"></div>
                      <div class="relative z-10 p-8 md:p-12 text-center">
                          <div
                              class="w-16 h-16 mx-auto rounded-2xl bg-white/10 border border-white/20 text-gold-400 flex items-center justify-center mb-6 shadow-lg">
                              <i class="fas fa-search text-2xl"></i>
                          </div>
                          <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-3">Cek Status Pendaftaran</h3>
                          <p class="text-blue-100/80 max-w-xl mx-auto mb-8">Masukkan nama lengkap untuk melihat status
                              pendaftaran PPDB Anda di SMP Negeri 1 Pirime.</p>
                          <div class="max-w-lg mx-auto">
                              <div class="flex flex-col sm:flex-row gap-3">
                                  <input type="text" id="cekNama" placeholder="Masukkan nama lengkap..."
                                      class="flex-1 px-5 py-4 rounded-xl bg-white/10 border border-white/20 placeholder-blue-200/60 text-white focus:outline-none focus:ring-4 focus:ring-gold-500/30 focus:border-gold-400 transition-all">
                                  <button type="button" onclick="cekStatus()"
                                      class="bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-600 hover:to-gold-700 text-primary-900 px-8 py-4 rounded-xl font-bold transition-all shadow-lg shadow-gold-500/30 hover:-translate-y-0.5">
                                      <i class="fas fa-search mr-2"></i> Cek Status
                                  </button>
                              </div>
                              <div id="statusResult" class="mt-6 hidden"></div>
                          </div>
                      </div>
                  </div>
              </div>

              {{-- FAQ --}}
              <div class="mt-14" data-aos="fade-up">
                  <div class="text-center mb-10">
                      <div
                          class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold border border-primary-100 mb-4">
                          <i class="fas fa-question-circle text-gold-500"></i>
                          <span>Butuh Bantuan?</span>
                      </div>
                      <h3 class="text-3xl font-extrabold text-primary-900">Pertanyaan yang Sering Diajukan</h3>
                      <div class="w-20 h-1.5 bg-gradient-to-r from-primary-500 to-gold-500 mx-auto rounded-full mt-4">
                      </div>
                  </div>
                  <div class="max-w-3xl mx-auto space-y-4">
                      @php
                          $faqs = [
                              [
                                  'q' => 'Kapan batas akhir pendaftaran PPDB?',
                                  'a' =>
                                      'Pendaftaran PPDB berlangsung setiap tahun pada bulan Juni. Informasi tanggal pasti akan diumumkan melalui website dan pengumuman resmi sekolah.',
                              ],
                              [
                                  'q' => 'Dokumen apa saja yang harus disiapkan?',
                                  'a' =>
                                      'Siapkan Akta Kelahiran, Kartu Keluarga, Rapor SD/MI, Surat Keterangan Lulus, dan pas foto. Semua dokumen diunggah saat mengisi formulir online.',
                              ],
                              [
                                  'q' => 'Bagaimana cara mengetahui hasil seleksi?',
                                  'a' =>
                                      'Hasil seleksi dapat dicek melalui halaman Cek Status Pendaftaran di website ini dengan memasukkan nama lengkap Anda.',
                              ],
                              [
                                  'q' => 'Apakah PPDB ini gratis?',
                                  'a' =>
                                      'Ya, seluruh proses PPDB di SMP Negeri 1 Pirime tidak dipungut biaya apapun (gratis).',
                              ],
                          ];
                      @endphp
                      @foreach ($faqs as $i => $faq)
                          <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                              <button type="button" onclick="toggleFaq(this)"
                                  class="w-full flex items-center justify-between gap-4 p-5 text-left hover:bg-[#F8FAFC] transition-colors">
                                  <span class="font-semibold text-primary-900 flex items-center gap-3">
                                      <span
                                          class="w-8 h-8 rounded-full bg-primary-50 text-primary-700 text-sm font-bold flex items-center justify-center flex-shrink-0">{{ $i + 1 }}</span>
                                      {{ $faq['q'] }}
                                  </span>
                                  <i class="fas fa-chevron-down text-gold-500 transition-transform duration-300"></i>
                              </button>
                              <div class="faq-body hidden px-5 pb-5 pl-16">
                                  <p class="text-slate-600 text-sm leading-relaxed">{{ $faq['a'] }}</p>
                              </div>
                          </div>
                      @endforeach
                  </div>
              </div>

              {{-- CTA Section --}}
              <div class="mt-14" data-aos="fade-up">
                  <div
                      class="bg-gradient-to-br from-primary-700 to-primary-950 text-white rounded-3xl shadow-2xl border border-primary-700/50 overflow-hidden relative">
                      <div class="absolute top-0 right-0 w-64 h-64 bg-gold-500/10 rounded-full blur-3xl -mr-20 -mt-20">
                      </div>
                      <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full blur-2xl -ml-16 -mb-16"></div>
                      <div class="relative z-10 p-10 md:p-14 text-center">
                          <span
                              class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-gold-500/20 text-gold-400 text-sm font-semibold border border-gold-500/30 mb-6">Generasi
                              Emas Lanny Jaya</span>
                          <h3 class="text-2xl md:text-3xl font-extrabold mb-4">Siap Bergabung dengan SMP Negeri 1 Pirime?
                          </h3>
                          <p class="text-blue-100/80 max-w-xl mx-auto mb-8">Daftarkan diri Anda sekarang dan jadilah bagian
                              dari
                              komunitas pendidikan berkualitas.</p>
                          <div class="flex flex-col md:flex-row gap-4 justify-center">
                              @if ($data['ppdb_open'])
                              <a href="{{ route('register.form') }}"
                                  class="bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-600 hover:to-gold-700 text-primary-900 px-8 py-4 rounded-full font-bold transition-all inline-flex items-center justify-center shadow-lg shadow-gold-500/30 hover:-translate-y-1">
                                  <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                              </a>
                              @else
                              <div class="inline-flex items-center justify-center rounded-full bg-rose-100 px-8 py-4 font-bold text-rose-700"><i class="fas fa-lock mr-2"></i>Pendaftaran Ditutup</div>
                              @endif
                              <a href="{{ route('login.form') }}"
                                  class="bg-white/10 hover:bg-white/20 text-white px-8 py-4 rounded-full font-bold transition-all inline-flex items-center justify-center border border-white/20 backdrop-blur-sm hover:-translate-y-1">
                                  <i class="fas fa-sign-in-alt mr-2 text-gold-400"></i> Masuk ke Akun
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  @endsection

  @push('scripts')
      <script>
          function toggleFaq(btn) {
              const body = btn.nextElementSibling;
              const icon = btn.querySelector('i');
              const isHidden = body.classList.contains('hidden');
              // Close all
              document.querySelectorAll('.faq-body').forEach(b => {
                  b.classList.add('hidden');
              });
              document.querySelectorAll('.faq-body').forEach(b => {
                  const ic = b.previousElementSibling.querySelector('i');
                  if (ic) ic.style.transform = 'rotate(0deg)';
              });
              if (isHidden) {
                  body.classList.remove('hidden');
                  icon.style.transform = 'rotate(180deg)';
              }
          }

          function cekStatus() {
              const nama = document.getElementById('cekNama')?.value.trim();
              const result = document.getElementById('statusResult');
              if (!nama) {
                  result.classList.remove('hidden');
                  result.innerHTML =
                      '<div class="p-4 rounded-xl bg-red-500/20 border border-red-400/30 text-red-200 text-sm">Mohon masukkan nama lengkap terlebih dahulu.</div>';
                  return;
              }
              result.classList.remove('hidden');
              result.innerHTML =
                  '<div class="p-4 rounded-xl bg-white/10 border border-white/20 text-white text-sm"><i class="fas fa-spinner fa-spin mr-2"></i>Memeriksa status...</div>';
              fetch('{{ route('api.cek-status-pendaftaran') }}?nama=' + encodeURIComponent(nama))
                  .then(res => res.json())
                  .then(data => {
                      if (data.success) {
                          const d = data.data;
                          const status = d.status || 'Menunggu';
                          const color = status === 'Diterima' ?
                              'bg-emerald-500/20 border-emerald-400/40 text-emerald-200' :
                              (status === 'Ditolak' ? 'bg-red-500/20 border-red-400/40 text-red-200' :
                                  'bg-amber-500/20 border-amber-400/40 text-amber-200');
                          result.innerHTML =
                              '<div class="p-5 rounded-xl bg-white/10 border border-white/20 backdrop-blur-sm text-left">' +
                              '<div class="flex items-center justify-between mb-3">' +
                              '<span class="font-bold text-white">' + d.nama + '</span>' +
                              '<span class="px-3 py-1 rounded-full text-xs font-bold ' + color + '">' + status +
                              '</span>' +
                              '</div>' +
                              '<p class="text-blue-100/80 text-sm mb-1"><i class="fas fa-id-card mr-2 text-gold-400"></i>Nomor Pendaftaran: ' +
                              (d.nomor_pendaftaran || '-') + '</p>' +
                              '<p class="text-blue-100/80 text-sm"><i class="fas fa-calendar mr-2 text-gold-400"></i>Tanggal Daftar: ' +
                              (d.tanggal_daftar || '-') + '</p>' +
                              '</div>';
                      } else {
                          result.innerHTML =
                              '<div class="p-5 rounded-xl bg-white/10 border border-white/20 backdrop-blur-sm text-left">' +
                              '<p class="text-red-200 text-sm"><i class="fas fa-exclamation-circle mr-2"></i>' + (data
                                  .message || 'Data tidak ditemukan') + '</p>' +
                              '</div>';
                      }
                  })
                  .catch(() => {
                      result.innerHTML =
                          '<div class="p-4 rounded-xl bg-red-500/20 border border-red-400/30 text-red-200 text-sm">Terjadi kesalahan. Silakan coba lagi.</div>';
                  });
          }
      </script>
  @endpush
