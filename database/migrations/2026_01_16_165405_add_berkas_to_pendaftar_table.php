<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftars', 'foto')) {
                $table->string('foto')->nullable();
            }
            if (!Schema::hasColumn('pendaftars', 'kk')) {
                $table->string('kk')->nullable();
            }
            if (!Schema::hasColumn('pendaftars', 'akta')) {
                $table->string('akta')->nullable();
            }
            if (!Schema::hasColumn('pendaftars', 'skl')) {
                $table->string('skl')->nullable();
            }
            if (!Schema::hasColumn('pendaftars', 'rapor')) {
                $table->string('rapor')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropColumn(['foto', 'kk', 'akta', 'skl', 'rapor']);
        });
    }
};
