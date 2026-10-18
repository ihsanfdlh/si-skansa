<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajarans';
    protected $primaryKey = 'id_tahunajaran';

    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'status',
    ];

    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_tahunajaran', 'id_tahunajaran');
    }
}
