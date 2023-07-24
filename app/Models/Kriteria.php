<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = "kriteria";
    protected $primaryKey = "id_kriteria";
    public $timestamps = false;

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'keterangan',
        'bobot',
        'jenis',
    ];
}
