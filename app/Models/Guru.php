<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
