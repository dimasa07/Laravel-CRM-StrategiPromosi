<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = "alternatif";
    protected $primaryKey = "id_alternatif";
    public $timestamps = false;

    protected $fillable = [
        'kode_alternatif',
        'bauran_promosi',
        'jenis',
        'waktu_promosi',
        'skala_promosi',
    ];
}
