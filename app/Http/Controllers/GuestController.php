<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gambar;

class GuestController extends Controller
{
    public function index()
    {
        $gambar = Gambar::orderBy('urutan', 'ASC')->get();
        $dataGambar = [];
        foreach($gambar as $g){
            $dataGambar[] = $g->nama_gambar;
        }
        return view('welcome', ['images' => $dataGambar]);
    }
}
