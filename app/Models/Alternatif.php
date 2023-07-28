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

    public function rincian_biaya(){
        return $this->hasMany(RincianBiaya::class, 'id_alternatif');
    }

    public function hasil(){
        return $this->hasMany(Hasil::class, 'id_alternatif');
    }

    public function kriteria(){
        return $this->belongsToMany(Kriteria::class,
            'penilaian',
            'id_alternatif',
            'id_kriteria'
        );
    }

    public function penilaian(){
        return $this->hasMany(Penilaian::class, 'id_alternatif');
    }

    public function totalHarga(){
        $totalHarga =  0;
        foreach($this->rincian_biaya as $rincian){
            $totalHarga += $rincian->total;
        }
        return $totalHarga;
    }
}
