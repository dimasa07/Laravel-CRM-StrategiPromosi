<?php

namespace App\Http\Livewire\Ppsb;

use Livewire\Component;

use App\Models\Alternatif;
use App\Models\RincianBiaya;

use App\Services\AlternatifService;
use App\Services\RincianBiayaService;

class KelolaRincianBiaya extends Component
{
    public $dataAlternatif;
    public $dataRincian;
    public $detailAltenatif;
    public $detailrRincian;
    public $state = [];
    public $index;

    public function render()
    {
        return view('livewire.ppsb.kelola-rincian-biaya');
    }

    public function mount(){
        $this->dataAlternatif = Alternatif::all();
        $this->index = -1;
        $this->state = [
            'nama_rincian' => '',
            'harga' => '',
            'jumlah' => '',
        ];
    }

    public function dataRincian($index, $id){
        $this->index = $index;
        $rincianBiayaService = new RincianBiayaService();
        $this->dataRincian = $rincianBiayaService->getByIdAlternatif($id);
    }

    public function tambah()
    {
        $this->resetErrorBag();

        $this->validate([
            'state.nama_rincian' => 'required',
            'state.harga' => 'required',
            'state.jumlah' => 'required',
        ],[
            'state.nama_rincian.required' => 'Tidak boleh kosong.',
            'state.harga.required' => 'Tidak boleh kosong.',
            'state.jumlah.required' => 'Tidak boleh kosong.',
        ]);

        $rincianBiayaService = new RincianBiayaService();
        
        $rincianBiaya = new RincianBiaya();
        $rincianBiaya->fill($this->state);
        $rincianBiaya->id_alternatif = $this->dataAlternatif[$this->index]->id_alternatif;
        $rincianBiaya->total = $this->state['harga'] * $this->state['jumlah'];
        $rincianBiayaService->add($rincianBiaya);

        $this->emit('rincian.saved');

        $this->state = [
            'nama_rincian' => '',
            'harga' => '',
            'jumlah' => '',
        ];

        $this->dataRincian = RincianBiaya::all(); 
    }

    public function detail($id)
    {
        $this->resetErrorBag();
        $rincianBiayaService = new RincianBiayaService();
        $this->detailRincian = $rincianBiayaService->getById($id)->withoutRelations()->toArray(); 
    }

    public function update()
    {
        $this->resetErrorBag();
        $this->validate([
            'detailRincian.nama_rincian' => 'required',
            'detailRincian.harga' => 'required',
            'detailRincian.jumlah' => 'required',
        ],[
            'detailRincian.nama_rincian.required' => 'Tidak boleh kosong.',
            'detailRincian.harga.required' => 'Tidak boleh kosong.',
            'detailRincian.jumlah.required' => 'Tidak boleh kosong.',
        ]);
            
        $rincianBiayaService = new RincianBiayaService();
        $rincianBiaya = $rincianBiayaService->getById($this->detailRincian['id_rincian_biaya']);
        $rincianBiaya->fill($this->detailRincian);
        $rincianBiaya->total = $this->detailRincian['harga'] * $this->detailRincian['jumlah'];
        $rincianBiaya->save();
        $this->detailRincian = $rincianBiaya->withoutRelations()->toArray();

        $this->emit('rincian.updated');
        $this->dataRincian = RincianBiaya::all();
    }

    public function delete()
    {
        $this->resetErrorBag();
        $rincianBiayaService = new RincianBiayaService();
        $rincianBiaya = $rincianBiayaService->getById($this->detailRincian['id_rincian_biaya']);
        $rincianBiaya->delete();
        $this->emit('rincian.deleted');
        $this->dataRincian = RincianBiaya::all();
        
    }

}
