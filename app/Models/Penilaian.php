<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = "penilaian";
    protected $primaryKey = "id_penilaian";
    public $timestamps = false;

    protected $fillable = [
        'id_alternatif',
        'id_kriteria',
        'bobot',
    ];

    public function alternatif(){
        return $this->belongsTo(Alternatif::class, 'id_alternatif');
    }

    public function kriteria(){
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    } 
}
