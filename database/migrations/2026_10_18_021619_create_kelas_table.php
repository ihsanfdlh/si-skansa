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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->string('nama_kelas', 20)->nullable()->unique();
            $table->string('tingkat', 5);
            $table->string('tahun_ajaran', 10);
            $table->foreignId('id_jurusan')
                ->constrained(
                    table: 'jurusans',
                    column: 'id_jurusan',
                    indexName: 'fk_kelas_jurusan'
                )
                ->onDelete('restrict')
                ->nullable();
            $table->foreignId('id_walikelas')
                ->constrained(
                    table: 'gurus',
                    column: 'id_guru',
                    indexName: 'fk_kelas_walikelas'
                )
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
