<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianBiaya extends Model
{
    use HasFactory;

    protected $table = "rincian_biaya";
    protected $primaryKey = "id_rincian_biaya";
    public $timestamps = false;

    protected $fillable = [
        'id_alternatif',
        'nama_rincian',
        'harga',
        'jumlah',
        'total',
    ];
}
