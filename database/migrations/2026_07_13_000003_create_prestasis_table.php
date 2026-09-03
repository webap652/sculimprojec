<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nama_prestasi');
            $table->year('tahun')->nullable();
            $table->enum('tingkat', ['kabupaten', 'provinsi', 'nasional', 'internasional', 'distrik'])->default('kabupaten');
            $table->string('juara')->nullable(); // 1, 2, 3, Harapan
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', ['akademik', 'non_akademik', 'guru', 'sekolah'])->default('akademik');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};

