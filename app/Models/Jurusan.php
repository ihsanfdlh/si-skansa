<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $primaryKey = 'id_jurusan';

    protected $fillable = [
        'kode_jurusan',
        'nama',
        'id_kepalajurusan',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_kepalajurusan', 'id_guru');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_jurusan', 'id_jurusan');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_jurusan', 'id_jurusan');
    }

    public function mataPelajaran(): HasMany
    {
        return $this->hasMany(MataPelajaran::class, 'id_jurusan', 'id_jurusan');
    }
}
