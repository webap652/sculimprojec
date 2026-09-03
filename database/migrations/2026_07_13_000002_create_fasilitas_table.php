<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah')->default(1);
            $table->enum('status', ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Tidak Ada'])->default('Baik');
            $table->enum('kategori', [
                'ruang_kelas', 'perpustakaan', 'laboratorium', 'lapangan',
                'toilet', 'uks', 'ruang_guru', 'kantor', 'internet',
                'air_bersih', 'listrik', 'ibadah', 'lainnya'
            ])->default('ruang_kelas');
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};

