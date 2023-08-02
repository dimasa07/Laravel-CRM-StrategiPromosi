<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $table = "gambar";
    protected $primaryKey = "id_gambar";
    public $timestamps = false;

    protected $fillable = [
        'nama_gambar',
        'urutan',
    ];
}
