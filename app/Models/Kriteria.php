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

    public function alternatif(){
        return $this->belongsToMany(Alternatif::class,
            'penilaian',
            'id_kriteria',
            'id_alternatif'
        );
    }

    public function penilaian(){
        return $this->hasMany(Penilaian::class, 'id_kriteria');
    }
}
