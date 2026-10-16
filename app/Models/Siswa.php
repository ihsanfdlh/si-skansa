<?php

namespace App\Models;

use App\Models\Orangtua;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'no_telp',
        'id_orangtua'
    ];
    public function orangtua(): BelongsTo {
        return $this->belongsTo(Orangtua::class, 'id_orangtua', 'id_orangtua');
    }
}
