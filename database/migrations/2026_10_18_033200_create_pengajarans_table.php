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
        Schema::create('pengajarans', function (Blueprint $table) {
            $table->id('id_pengajaran');
            $table->foreignId('id_guru')
                ->constrained('gurus', 'id_guru')
                ->cascadeOnDelete();
            $table->foreignId('id_mapel')
                ->constrained('mata_pelajarans', 'id_mapel')
                ->cascadeOnDelete();
            $table->foreignId('id_kelas')
                ->constrained('kelas', 'id_kelas')
                ->cascadeOnDelete();
            $table->string('hari', 15);
            $table->string('jam', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajarans');
    }
};
