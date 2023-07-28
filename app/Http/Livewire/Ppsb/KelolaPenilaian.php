<?php

namespace App\Http\Livewire\Ppsb;

use Livewire\Component;

use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;

use App\Services\PenilaianService;
use App\Services\AlternatifService;
use App\Services\KriteriaService;

class KelolaPenilaian extends Component
{
    public $dataAlternatif;
    public $dataKriteria;
    public $dataPenilaian;
    public $detailPenilaian;
    public $state = [];

    public function render()
    {
        return view('livewire.ppsb.kelola-penilaian');
    }

    public function mount(){
        $this->dataAlternatif = Alternatif::all();
        $this->dataKriteria = Kriteria::all();
        $this->dataPenilaian = Penilaian::all();
        $this->state = [
            'id_alternatif' => '',
            'id_kriteria' => '',
            'bobot' => '',
        ];
    }

    public function tambah()
    {
        $this->resetErrorBag();

        $this->validate([
            'state.id_alternatif' => 'required',
            'state.id_kriteria' => 'required',
            'state.bobot' => 'required',
        ],[
            'state.id_alternatif.required' => 'Pilih jenis alternatif.',
            'state.id_kriteria.required' => 'Pilih kriteria.',
            'state.bobot.required' => 'Tidak boleh kosong.',
        ]);

        $penilaianService = new PenilaianService();
        
        $penilaian = new Penilaian();
        $penilaian->fill($this->state);
        $penilaianService->add($penilaian);

        $this->emit('penilaian.saved');

        $this->state = [
            'id_alternatif' => '',
            'id_kriteria' => '',
            'bobot' => '',
        ];

        $this->dataPenilaian = Penilaian::all();
    }

    public function detail($id)
    {
        $this->resetErrorBag();
        $penilaianService = new PenilaianService();
        $this->detailPenilaian = $penilaianService->getById($id)->withoutRelations()->toArray(); 
    }

    public function update()
    {
        $this->resetErrorBag();
        $this->validate([
            'detailPenilaian.id_alternatif' => 'required',
            'detailPenilaian.id_kriteria' => 'required',
            'detailPenilaian.bobot' => 'required',
        ],[
            'detailPenilaian.id_alternatif.required' => 'Pilih jenis alternatif.',
            'detailPenilaian.id_kriteria.required' => 'Pilih kriteria.',
            'detailPenilaian.bobot.required' => 'Tidak boleh kosong.',
        ]);
            
        $penilaianService = new PenilaianService();
        $penilaian = $penilaianService->getById($this->detailPenilaian['id_penilaian']);
        
        $penilaian->fill($this->detailPenilaian);
        $penilaian->save();

        $this->emit('penilaian.updated');
        $this->dataPenilaian = Penilaian::all();
    }

    public function delete()
    {
        $this->resetErrorBag();
        $penilaianService = new PenilaianService();
        $penilaian = $penilaianService->getById($this->detailPenilaian['id_penilaian']);
        $penilaian->delete();
        $this->emit('penilaian.deleted');
        $this->dataPenilaian = Penilaian::all();   
    }

}
