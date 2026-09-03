<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdbs', function (Blueprint $table) {
            $table->id();

            // Relasi user
            $table->unsignedBigInteger('user_id');

            // Biodata siswa
            $table->string('nama');
            $table->string('nisn')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');

            // Orang tua
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();

            // Sekolah asal
            $table->string('sekolah_asal');
            $table->text('alamat_sekolah_asal')->nullable();

            // Upload berkas
            $table->string('foto')->nullable();
            $table->string('kk')->nullable();

            // Status verifikasi admin
            $table->string('status')->default('Menunggu Verifikasi');

            $table->timestamps();

            // Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdbs');
    }
};
