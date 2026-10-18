<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
