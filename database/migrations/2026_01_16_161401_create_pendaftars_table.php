<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nomor_pendaftaran')->unique()->nullable();
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('nisn', 10)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_hp_siswa', 15)->nullable();
            $table->text('alamat');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->integer('anak_ke')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->string('nama_ayah');
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('no_hp_ayah', 15)->nullable();
            $table->string('nama_ibu');
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ibu', 15)->nullable();
            $table->string('penghasilan_orangtua')->nullable();
            $table->string('nama_sekolah');
            $table->string('npsn', 20)->nullable();
            $table->text('alamat_sekolah')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('foto')->nullable();
            $table->string('kk')->nullable();
            $table->string('akte')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('kartu_nisn')->nullable();
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};
