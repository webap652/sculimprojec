<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nama_lengkap');
            $table->string('nip')->nullable();
            $table->string('mapel')->nullable();
            $table->string('pendidikan')->nullable();
            $table->enum('status', ['ASN','PNS', 'Honorer', 'PPPk', 'Tetap Yayasan'])->default('Honorer');
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('jabatan')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};

