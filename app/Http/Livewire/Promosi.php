<?php

namespace App\Http\Livewire;

use App\Models\Gambar;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Promosi extends Component
{
    use WithFileUploads;
 
    public $photo;
    public $dataGambar;
 
    public function save()
    {
        $this->validate([
            'photo' => 'image|max:2048', // 1MB Max
        ]);
 
        $gambar = new Gambar();
        $gambar->nama_gambar = 'img/'.$this->photo->hashName();

        $dataGambar = Gambar::all();
        $gambar->urutan = count($dataGambar)+1;

        $gambar->save();
        $this->photo->store('public/img');
        $this->photo = null;
        $this->refreshData();
    }

    public function delete($image)
    {
        $gambar = Gambar::where('nama_gambar', '=', $image)->first()->delete();
        Storage::delete('public/'. $image);
        
        $this->refreshData();
    }

    public function moveDown($image) 
    {
        $currentGambar = Gambar::where('nama_gambar', '=', $image)->first();
        $prevGambar = Gambar::where('urutan', '=', $currentGambar->urutan-1)->first();
        $currentGambar->update([
            'urutan' => $currentGambar->urutan-1
        ]);
        $prevGambar->update([
            'urutan' => $prevGambar->urutan+1
        ]);

        $this->refreshData();

    }

    public function moveUp($image) 
    {
        $currentGambar = Gambar::where('nama_gambar', '=', $image)->first();
        $nextGambar = Gambar::where('urutan', '=', $currentGambar->urutan+1)->first();
        $currentGambar->update([
            'urutan' => $currentGambar->urutan+1
        ]);
        $nextGambar->update([
            'urutan' => $nextGambar->urutan-1
        ]);

        $this->refreshData();

    }

    public function mount()
    {
        $this->refreshData();
    }

    public function render()
    {
        return view('livewire.promosi');
    }

    public function refreshData()
    {
        $gambar = Gambar::orderBy('urutan', 'ASC')->get();
        $this->dataGambar = [];
        foreach($gambar as $g){
            $this->dataGambar[] = $g->nama_gambar;
        }
    }
}
