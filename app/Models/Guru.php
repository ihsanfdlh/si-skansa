<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Model
{
    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nama',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'no_telp',
    ];
    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'id_kepalajurusan', 'id_guru');
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_walikelas', 'id_guru');
    }

    public function pengajaran(): HasMany
    {
        return $this->hasMany(Pengajaran::class, 'id_guru', 'id_guru');
    }
}
