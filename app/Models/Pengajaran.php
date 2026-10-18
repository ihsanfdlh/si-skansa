<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajaran extends Model
{
    protected $table = 'pengajarans';
    protected $primaryKey = 'id_pengajaran';

    protected $fillable = [
        'id_guru',
        'id_mapel',
        'id_kelas',
        'hari',
        'jam',
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id_mapel');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
