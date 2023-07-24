<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = "pendaftar";
    protected $primaryKey = "id_pendaftar";
    public $timestamps = false;

    protected $fillable = [
        'nama_siswa',
        'asal_sekolah',
        'tahun_ajaran',
        'nama_ortu',
        'kontak',
    ];

    
}
