<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orangtua extends Model
{
    protected $primaryKey = 'id_orangtua';

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp'
    ];
    public function siswas(): HasMany {
        return $this->hasMany(Siswa::class, 'id_orangtua', 'id_orangtua');
    }
}
