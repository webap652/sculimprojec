<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');

        // DATA DIRI
        $table->string('nisn')->nullable();
        $table->string('nama_lengkap')->nullable();
        $table->string('jenis_kelamin')->nullable();
        $table->string('tempat_lahir')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->string('agama')->nullable();
        $table->string('alamat')->nullable();

        // DATA ORANG TUA
        $table->string('nama_ayah')->nullable();
        $table->string('pekerjaan_ayah')->nullable();
        $table->string('nama_ibu')->nullable();
        $table->string('pekerjaan_ibu')->nullable();
        $table->string('no_hp_ortu')->nullable();

        // DATA SEKOLAH ASAL
        $table->string('sekolah_asal')->nullable();
        $table->string('tahun_lulus')->nullable();

        // BERKAS
        $table->string('foto')->nullable();
        $table->string('kk')->nullable();
        $table->string('akte')->nullable();
        $table->string('ijazah')->nullable();

        // STATUS
        $table->enum('status', ['belum-verifikasi', 'diterima', 'ditolak'])
              ->default('belum-verifikasi');

        $table->timestamps();

        // RELASI USER
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

};
