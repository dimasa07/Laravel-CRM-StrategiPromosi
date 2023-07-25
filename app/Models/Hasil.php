<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $table = "hasil";
    protected $primaryKey = "id_hasil";
    public $timestamps = false;

    protected $fillable = [
        'id_alternatif',
        'nilai',
        'urutan',
    ];

    public function alternatif(){
        return $this->belongsTo(Alternatif::class, 'id_alternatif');
    }
}
