@extends('siswa.layout')

@section('title', 'Formulir Pendaftaran PPDB')
@section('pageTitle', 'Pendaftaran')

@section('content')
    @php
        $student = $data ?? null;
        $steps = [
            ['title' => 'Data Pribadi', 'short' => 'Pribadi', 'icon' => 'fa-user'],
            ['title' => 'Sekolah Asal', 'short' => 'Sekolah', 'icon' => 'fa-school'],
            ['title' => 'Orang Tua', 'short' => 'Orang Tua', 'icon' => 'fa-users'],
            ['title' => 'Upload Berkas', 'short' => 'Berkas', 'icon' => 'fa-folder-open'],
            ['title' => 'Review & Simpan', 'short' => 'Review', 'icon' => 'fa-check'],
        ];
        $uploadFields = [
            'foto_profil' => ['label' => 'Foto Profil', 'icon' => 'fa-camera', 'accept' => 'image/*', 'hint' => 'JPG atau PNG, maksimal 2 MB'],
            'foto' => ['label' => 'Pas Foto 3x4', 'icon' => 'fa-id-card', 'accept' => 'image/*', 'hint' => 'JPG atau PNG, maksimal 2 MB'],
            'kk' => ['label' => 'Kartu Keluarga', 'icon' => 'fa-file-lines', 'accept' => '.jpg,.jpeg,.png,.pdf', 'hint' => 'JPG, PNG, atau PDF, maksimal 5 MB'],
            'akte' => ['label' => 'Akta Kelahiran', 'icon' => 'fa-file-lines', 'accept' => '.jpg,.jpeg,.png,.pdf', 'hint' => 'JPG, PNG, atau PDF, maksimal 5 MB'],
            'ijazah' => ['label' => 'Ijazah / Surat Keterangan Lulus', 'icon' => 'fa-graduation-cap', 'accept' => '.jpg,.jpeg,.png,.pdf', 'hint' => 'JPG, PNG, atau PDF, maksimal 5 MB'],
            'kartu_nisn' => ['label' => 'Kartu NISN', 'icon' => 'fa-address-card', 'accept' => '.jpg,.jpeg,.png,.pdf', 'hint' => 'JPG, PNG, atau PDF, maksimal 5 MB'],
        ];
    @endphp

    <div class="min-h-screen bg-slate-100 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <div class="mb-6 flex items-center justify-between gap-4">
                <div>
                    <p class="mb-1 text-sm font-semibold text-indigo-600">PPDB ONLINE</p>
                    <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Formulir Pendaftaran</h1>
                    <p class="mt-1 text-sm text-slate-500">Lengkapi data secara bertahap, lalu simpan sekali di tahap terakhir.</p>
                </div>
                <div class="hidden rounded-2xl bg-white p-3 shadow-sm sm:block"><i class="fas fa-clipboard-check text-2xl text-indigo-600"></i></div>
            </div>

            @if (session('sukses'))
                <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">{{ session('sukses') }}</div>
            @endif
            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    <p class="font-semibold">Periksa kembali data Anda:</p>
                    <ul class="mt-1 list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form id="registrationForm" action="{{ route('siswa.pendaftaran.simpan') }}" method="POST" enctype="multipart/form-data" class="overflow-hidden rounded-2xl bg-white shadow-xl shadow-slate-200/60">
                @csrf
                <div class="overflow-x-auto border-b border-slate-200 px-4 py-5 sm:px-8">
                    <div class="mx-auto flex min-w-[620px] items-start justify-between">
                        @foreach ($steps as $index => $step)
                            <div class="step-indicator flex flex-1 items-center {{ $index === 0 ? 'active' : '' }}" data-step="{{ $index }}">
                                <div class="flex flex-col items-center gap-2 text-center">
                                    <span class="step-circle flex h-9 w-9 items-center justify-center rounded-full border-2 border-indigo-600 bg-indigo-600 text-sm font-bold text-white transition-all"><i class="fas {{ $step['icon'] }} text-xs"></i></span>
                                    <span class="step-label whitespace-nowrap text-[11px] font-semibold text-indigo-600 sm:text-xs">{{ $step['short'] }}</span>
                                </div>
                                @if ($index < count($steps) - 1)<span class="step-line mx-2 mt-[-20px] h-0.5 flex-1 bg-slate-200 transition-colors"></span>@endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-5 sm:p-8">
                    <section class="wizard-step" data-step="0">
                        <div class="mb-6 border-b border-slate-100 pb-4"><h2 class="text-xl font-bold text-slate-900"><i class="fas fa-user mr-2 text-indigo-600"></i>Data Pribadi</h2><p class="mt-1 text-sm text-slate-500">Masukkan identitas calon peserta didik.</p></div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            @php $personal = [['nama_lengkap', 'Nama Lengkap', 'text', true], ['nisn', 'NISN', 'text', true], ['nik', 'NIK', 'text', false], ['tempat_lahir', 'Tempat Lahir', 'text', true], ['tanggal_lahir', 'Tanggal Lahir', 'date', true], ['desa', 'Desa/Kelurahan', 'text', false], ['kecamatan', 'Kecamatan', 'text', false], ['kabupaten', 'Kabupaten', 'text', false], ['provinsi', 'Provinsi', 'text', false]]; @endphp
                            @foreach ($personal as [$field, $label, $type, $required])
                                <div><label for="{{ $field }}" class="mb-1.5 block text-sm font-semibold text-slate-700">{{ $label }} @if ($required)<span class="text-rose-500">*</span>@endif</label><input id="{{ $field }}" type="{{ $type }}" name="{{ $field }}" value="{{ old($field, $student?->{$field}) }}" @required($required) data-label="{{ $label }}" class="form-input w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"></div>
                            @endforeach
                            <div><label for="jenis_kelamin" class="mb-1.5 block text-sm font-semibold text-slate-700">Jenis Kelamin <span class="text-rose-500">*</span></label><select id="jenis_kelamin" name="jenis_kelamin" required data-label="Jenis Kelamin" class="form-input w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"><option value="">Pilih jenis kelamin</option>@foreach (['Laki-laki', 'Perempuan'] as $option)<option value="{{ $option }}" @selected(old('jenis_kelamin', $student?->jenis_kelamin) === $option)>{{ $option }}</option>@endforeach</select></div>
                            <div><label for="agama" class="mb-1.5 block text-sm font-semibold text-slate-700">Agama <span class="text-rose-500">*</span></label><select id="agama" name="agama" required data-label="Agama" class="form-input w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"><option value="">Pilih agama</option>@foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $option)<option value="{{ $option }}" @selected(old('agama', $student?->agama) === $option)>{{ $option }}</option>@endforeach</select></div>
                            <div class="md:col-span-2"><label for="alamat" class="mb-1.5 block text-sm font-semibold text-slate-700">Alamat <span class="text-rose-500">*</span></label><textarea id="alamat" name="alamat" rows="3" required data-label="Alamat" class="form-input w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">{{ old('alamat', $student?->alamat) }}</textarea></div>
                        </div>
                    </section>

                    <section class="wizard-step hidden" data-step="1">
                        <div class="mb-6 border-b border-slate-100 pb-4"><h2 class="text-xl font-bold text-slate-900"><i class="fas fa-school mr-2 text-indigo-600"></i>Sekolah Asal</h2><p class="mt-1 text-sm text-slate-500">Lengkapi informasi sekolah sebelumnya.</p></div>
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2"><div><label for="nama_sekolah" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Sekolah <span class="text-rose-500">*</span></label><input id="nama_sekolah" name="nama_sekolah" required data-label="Nama Sekolah" value="{{ old('nama_sekolah', $student?->nama_sekolah) }}" class="form-input w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"></div><div><label for="npsn" class="mb-1.5 block text-sm font-semibold text-slate-700">NPSN</label><input id="npsn" name="npsn" value="{{ old('npsn', $student?->npsn) }}" class="form-input w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"></div><div class="md:col-span-2"><label for="alamat_sekolah" class="mb-1.5 block text-sm font-semibold text-slate-700">Alamat Sekolah</label><textarea id="alamat_sekolah" name="alamat_sekolah" rows="4" class="form-input w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">{{ old('alamat_sekolah', $student?->alamat_sekolah) }}</textarea></div></div>
                    </section>

                    <section class="wizard-step hidden" data-step="2">
                        <div class="mb-6 border-b border-slate-100 pb-4"><h2 class="text-xl font-bold text-slate-900"><i class="fas fa-users mr-2 text-indigo-600"></i>Data Orang Tua</h2><p class="mt-1 text-sm text-slate-500">Data ini membantu panitia menghubungi keluarga.</p></div>
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            @foreach (['ayah' => 'Ayah', 'ibu' => 'Ibu'] as $parent => $title)
                                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-5"><h3 class="mb-4 font-bold text-slate-800"><i class="fas fa-user-tie mr-2 text-indigo-500"></i>Data {{ $title }}</h3><div class="space-y-4"><div><label for="nama_{{ $parent }}" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama {{ $title }} <span class="text-rose-500">*</span></label><input id="nama_{{ $parent }}" name="nama_{{ $parent }}" required data-label="Nama {{ $title }}" value="{{ old('nama_'.$parent, $student?->{'nama_'.$parent}) }}" class="form-input w-full rounded-xl border-slate-200 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"></div><div><label for="pendidikan_{{ $parent }}" class="mb-1.5 block text-sm font-semibold text-slate-700">Pendidikan {{ $title }}</label><select id="pendidikan_{{ $parent }}" name="pendidikan_{{ $parent }}" class="form-input w-full rounded-xl border-slate-200 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"><option value="">Pilih pendidikan</option>@foreach (['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Tidak'] as $option)<option value="{{ $option }}" @selected(old('pendidikan_'.$parent, $student?->{'pendidikan_'.$parent}) === $option)>{{ $option }}</option>@endforeach</select></div><div><label for="pekerjaan_{{ $parent }}" class="mb-1.5 block text-sm font-semibold text-slate-700">Pekerjaan {{ $title }} <span class="text-rose-500">*</span></label><input id="pekerjaan_{{ $parent }}" name="pekerjaan_{{ $parent }}" required data-label="Pekerjaan {{ $title }}" value="{{ old('pekerjaan_'.$parent, $student?->{'pekerjaan_'.$parent}) }}" class="form-input w-full rounded-xl border-slate-200 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"></div><div><label for="no_hp_{{ $parent }}" class="mb-1.5 block text-sm font-semibold text-slate-700">No. HP {{ $title }}</label><input id="no_hp_{{ $parent }}" name="no_hp_{{ $parent }}" value="{{ old('no_hp_'.$parent, $student?->{'no_hp_'.$parent}) }}" class="form-input w-full rounded-xl border-slate-200 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"></div></div></div>
                            @endforeach
                        </div>
                        <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50/70 p-5"><label for="penghasilan_orangtua" class="mb-1.5 block text-sm font-semibold text-slate-700">Penghasilan Orang Tua</label><select id="penghasilan_orangtua" name="penghasilan_orangtua" class="form-input w-full rounded-xl border-slate-200 bg-white px-3.5 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"><option value="">Pilih penghasilan</option>@foreach (['< 1 juta', '1-3 juta', '3-5 juta', '> 5 juta', 'Lainnya'] as $option)<option value="{{ $option }}" @selected(old('penghasilan_orangtua', $student?->penghasilan_orangtua) === $option)>{{ $option }}</option>@endforeach</select></div>
                    </section>

                    <section class="wizard-step hidden" data-step="3">
                        <div class="mb-6 border-b border-slate-100 pb-4"><h2 class="text-xl font-bold text-slate-900"><i class="fas fa-folder-open mr-2 text-indigo-600"></i>Upload Berkas</h2><p class="mt-1 text-sm text-slate-500">Pilih berkas yang diperlukan. Berkas lama tetap aman sampai Anda menyimpan perubahan.</p></div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            @foreach ($uploadFields as $field => $file)
                                <div class="file-card rounded-2xl border border-slate-200 bg-slate-50/70 p-4 transition hover:border-indigo-200 hover:bg-indigo-50/30"><div class="mb-3 flex items-start gap-3"><span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600"><i class="fas {{ $file['icon'] }}"></i></span><div><h3 class="text-sm font-bold text-slate-800">{{ $file['label'] }}</h3><p class="mt-1 text-xs text-slate-500">{{ $file['hint'] }}</p></div></div><input id="{{ $field }}" type="file" name="{{ $field }}" accept="{{ $file['accept'] }}" class="file-input block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-xs text-slate-500 file:mr-3 file:border-0 file:bg-indigo-600 file:px-3 file:py-2.5 file:text-xs file:font-semibold file:text-white hover:file:bg-indigo-700"><div class="file-preview mt-3 hidden overflow-hidden rounded-xl border border-indigo-100 bg-white p-2"><img class="preview-image max-h-32 w-full rounded-lg object-contain" alt="Pratinjau {{ $file['label'] }}"><p class="preview-name mt-1 truncate text-xs text-slate-500"></p></div>@if ($student?->{$field})<div class="mt-3 flex items-center justify-between gap-2"><span class="text-xs font-semibold text-emerald-600"><i class="fas fa-check-circle mr-1"></i>Berkas tersimpan</span><a href="{{ asset('storage/'.$student->{$field}) }}" target="_blank" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Lihat File</a></div>@endif</div>
                            @endforeach
                        </div>
                    </section>

                    <section class="wizard-step hidden" data-step="4">
                        <div class="mb-6 border-b border-slate-100 pb-4"><h2 class="text-xl font-bold text-slate-900"><i class="fas fa-clipboard-check mr-2 text-indigo-600"></i>Review & Simpan</h2><p class="mt-1 text-sm text-slate-500">Pastikan data sudah benar sebelum menyimpan.</p></div>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                            @foreach ([['title' => 'Data Pribadi', 'step' => 0, 'fields' => ['nama_lengkap' => 'Nama Lengkap', 'nisn' => 'NISN', 'nik' => 'NIK', 'jenis_kelamin' => 'Jenis Kelamin', 'tempat_lahir' => 'Tempat Lahir', 'tanggal_lahir' => 'Tanggal Lahir', 'agama' => 'Agama', 'alamat' => 'Alamat']], ['title' => 'Sekolah Asal', 'step' => 1, 'fields' => ['nama_sekolah' => 'Nama Sekolah', 'npsn' => 'NPSN', 'alamat_sekolah' => 'Alamat Sekolah']], ['title' => 'Data Orang Tua', 'step' => 2, 'fields' => ['nama_ayah' => 'Nama Ayah', 'nama_ibu' => 'Nama Ibu', 'penghasilan_orangtua' => 'Penghasilan Orang Tua']]] as $review)
                                <div class="rounded-2xl border border-slate-200 p-4"><div class="mb-3 flex items-center justify-between"><h3 class="font-bold text-slate-800">{{ $review['title'] }}</h3><button type="button" data-jump="{{ $review['step'] }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Edit</button></div><dl class="space-y-2 text-sm">@foreach ($review['fields'] as $field => $label)<div class="flex gap-3"><dt class="w-32 shrink-0 text-slate-500">{{ $label }}</dt><dd data-review="{{ $field }}" class="font-medium text-slate-800">{{ old($field, $student?->{$field}) ?: '-' }}</dd></div>@endforeach</dl></div>
                            @endforeach
                            <div class="rounded-2xl border border-slate-200 p-4"><div class="mb-3 flex items-center justify-between"><h3 class="font-bold text-slate-800">Berkas</h3><button type="button" data-jump="3" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Edit</button></div><ul class="space-y-2 text-sm">@foreach ($uploadFields as $field => $file)<li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i><span>{{ $file['label'] }}</span><span data-review-file-name="{{ $field }}" class="ml-auto max-w-[45%] truncate text-xs text-slate-400">{{ $student?->{$field} ? 'Tersimpan' : 'Belum dipilih' }}</span></li>@endforeach</ul></div>
                        </div>
                        <div class="mt-5 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800"><i class="fas fa-circle-info mr-2"></i>Data akan disimpan bersama berkas baru melalui satu tombol di bawah.</div>
                    </section>

                    <div id="wizardError" class="mt-5 hidden rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700"></div>
                    <div class="mt-8 flex items-center justify-between gap-3 border-t border-slate-100 pt-5"><button type="button" id="previousButton" class="invisible rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"><i class="fas fa-arrow-left mr-2"></i>Kembali</button><button type="button" id="nextButton" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700"><span id="nextLabel">Berikutnya</span><i class="fas fa-arrow-right ml-2"></i></button><button type="submit" id="submitButton" class="hidden rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700"><i class="fas fa-check mr-2"></i>Simpan Data Pendaftaran</button></div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('registrationForm');
            const panels = [...document.querySelectorAll('.wizard-step')];
            const indicators = [...document.querySelectorAll('.step-indicator')];
            const previous = document.getElementById('previousButton');
            const next = document.getElementById('nextButton');
            const submit = document.getElementById('submitButton');
            const nextLabel = document.getElementById('nextLabel');
            const errorBox = document.getElementById('wizardError');
            let currentStep = 0;
            const requiredByStep = [['nama_lengkap', 'nisn', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat'], ['nama_sekolah'], ['nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu'], [],];

            function updateReview() {
                document.querySelectorAll('[data-review]').forEach((target) => { const source = document.getElementById(target.dataset.review); target.textContent = source?.value || '-'; });
                document.querySelectorAll('[data-review-file-name]').forEach((target) => { const source = document.getElementById(target.dataset.reviewFileName); if (source?.files?.length) target.textContent = source.files[0].name; });
            }
            function showStep(step) {
                currentStep = step;
                panels.forEach((panel, index) => panel.classList.toggle('hidden', index !== step));
                indicators.forEach((indicator, index) => { indicator.classList.toggle('active', index === step); indicator.classList.toggle('complete', index < step); const circle = indicator.querySelector('.step-circle'); const label = indicator.querySelector('.step-label'); circle.classList.toggle('border-indigo-600', index <= step); circle.classList.toggle('bg-indigo-600', index <= step); circle.classList.toggle('bg-white', index > step); circle.classList.toggle('text-white', index <= step); circle.classList.toggle('text-slate-400', index > step); label.classList.toggle('text-indigo-600', index <= step); label.classList.toggle('text-slate-400', index > step); const line = indicator.querySelector('.step-line'); if (line) line.classList.toggle('bg-indigo-600', index < step); });
                previous.classList.toggle('invisible', step === 0); next.classList.toggle('hidden', step === panels.length - 1); submit.classList.toggle('hidden', step !== panels.length - 1); nextLabel.textContent = step === panels.length - 2 ? 'Review Data' : 'Berikutnya'; errorBox.classList.add('hidden'); if (step === panels.length - 1) updateReview(); window.scrollTo({ top: 0, behavior: 'smooth' });
            }
            function validateStep(step) { errorBox.classList.add('hidden'); for (const field of requiredByStep[step] || []) { const input = document.getElementById(field); if (!input?.value.trim()) { input.focus(); errorBox.textContent = `${input.dataset.label || field} wajib diisi.`; errorBox.classList.remove('hidden'); return false; } } return true; }
            next.addEventListener('click', () => { if (validateStep(currentStep)) showStep(currentStep + 1); });
            previous.addEventListener('click', () => { if (currentStep > 0) showStep(currentStep - 1); });
            document.querySelectorAll('[data-jump]').forEach((button) => button.addEventListener('click', () => showStep(Number(button.dataset.jump))));
            document.querySelectorAll('.file-input').forEach((input) => input.addEventListener('change', () => { const card = input.closest('.file-card'); const preview = card.querySelector('.file-preview'); const image = card.querySelector('.preview-image'); const name = card.querySelector('.preview-name'); const selected = input.files[0]; if (!selected) return; name.textContent = `File baru: ${selected.name}`; if (selected.type.startsWith('image/')) { image.src = URL.createObjectURL(selected); } else { image.removeAttribute('src'); } preview.classList.remove('hidden'); }));
            form.addEventListener('submit', (event) => { for (let step = 0; step < requiredByStep.length; step++) { if (!validateStep(step)) { event.preventDefault(); showStep(step); return; } } });
            showStep(0);
        });
    </script>
@endsection
