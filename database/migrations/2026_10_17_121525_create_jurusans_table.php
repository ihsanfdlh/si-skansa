<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurusans', function (Blueprint $table) {
            $table->id('id_jurusan');
            $table->string('kode_jurusan', 10)->nullable()->unique();
            $table->string('nama', 50);
            $table->foreignId('id_kepalajurusan')
                ->constrained(
                    table: 'gurus',
                    column: 'id_guru',
                    indexName: 'fk_jurusans_kepala'
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
        Schema::dropIfExists('jurusans');
    }
};
