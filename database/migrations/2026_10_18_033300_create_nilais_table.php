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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->foreignId('id_siswa')
                ->constrained('siswas', 'id_siswa')
                ->cascadeOnDelete();
            $table->foreignId('id_mapel')
                ->constrained('mata_pelajarans', 'id_mapel')
                ->cascadeOnDelete();
            $table->foreignId('id_tahunajaran')
                ->constrained('tahun_ajarans', 'id_tahunajaran')
                ->cascadeOnDelete();
            $table->decimal('nilai_pengetahuan', 5, 2)->default(0);
            $table->decimal('nilai_keterampilan', 5, 2)->default(0);
            $table->decimal('nilai_akhir', 5, 2)->default(0);
            $table->string('predikat', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
