@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Biodata Pendaftaran</h3>

    <form action="{{ route('siswa.ppdb.update') }}" method="POST">
        @csrf

        <div class="card shadow-sm mb-3">
            <div class="card-header bg-primary text-white">Data Siswa</div>
            <div class="card-body">

                <div class="mb-3">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" class="form-control" value="{{ $pendaftar->nama }}">
                </div>

                <div class="mb-3">
                    <label>NISN *</label>
                    <input type="text" name="nisn" class="form-control" value="{{ $pendaftar->nisn }}">
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="Laki-laki" {{ $pendaftar->jenis_kelamin=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $pendaftar->jenis_kelamin=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="col">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $pendaftar->tempat_lahir }}">
                    </div>

                    <div class="col">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pendaftar->tanggal_lahir }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Alamat *</label>
                    <textarea name="alamat" class="form-control">{{ $pendaftar->alamat }}</textarea>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-header bg-secondary text-white">Data Orang Tua</div>
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col">
                        <label>Nama Ayah *</label>
                        <input type="text" name="nama_ayah" class="form-control" value="{{ $pendaftar->nama_ayah }}">
                    </div>
                    <div class="col">
                        <label>Pekerjaan Ayah *</label>
                        <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ $pendaftar->pekerjaan_ayah }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label>Nama Ibu *</label>
                        <input type="text" name="nama_ibu" class="form-control" value="{{ $pendaftar->nama_ibu }}">
                    </div>
                    <div class="col">
                        <label>Pekerjaan Ibu *</label>
                        <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ $pendaftar->pekerjaan_ibu }}">
                    </div>
                </div>

            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-header bg-dark text-white">Data Sekolah Asal</div>
            <div class="card-body">

                <div class="mb-3">
                    <label>Sekolah Asal *</label>
                    <input type="text" name="sekolah_asal" class="form-control" value="{{ $pendaftar->sekolah_asal }}">
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
