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
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreignId('id_jurusan')
                ->nullable()
                ->after('no_telp')
                ->constrained('jurusans', 'id_jurusan')
                ->nullOnDelete();

            $table->foreignId('id_kelas')
                ->nullable()
                ->after('id_jurusan')
                ->constrained('kelas', 'id_kelas')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['id_jurusan']);
            $table->dropForeign(['id_kelas']);
            $table->dropColumn(['id_jurusan', 'id_kelas']);
        });
    }
};
