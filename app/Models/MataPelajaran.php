<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajarans';
    protected $primaryKey = 'id_mapel';

    protected $fillable = [
        'kode_mapel'
        'nama_mapel',
        'kelompok',
        'id_jurusan',
    ];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function pengajaran(): HasMany
    {
        return $this->hasMany(Pengajaran::class, 'id_mapel', 'id_mapel');
    }

    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_mapel', 'id_mapel');
    }
}
