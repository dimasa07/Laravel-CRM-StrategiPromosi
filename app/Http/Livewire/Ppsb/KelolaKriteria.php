<?php

namespace App\Http\Livewire\Ppsb;

use Livewire\Component;

use App\Models\Kriteria;

use App\Services\KriteriaService;

class KelolaKriteria extends Component
{
    public $dataKriteria;
    public $state = [];
    public $detailKriteria;

    public function render()
    {
        return view('livewire.ppsb.kelola-kriteria');
    }

    public function mount(){
        $this->dataKriteria = Kriteria::all();
        $this->state = [
            'kode_kriteria' => '',
            'nama_kriteria' => '',
            'keterangan' => '',
            'bobot' => '',
            'jenis' => 'Benefit',
        ];
    }

    public function tambah()
    {
        $this->resetErrorBag();

        $this->validate([
            'state.kode_kriteria' => 'required',
            'state.nama_kriteria' => 'required',
            'state.keterangan' => 'required',
            'state.bobot' => 'required',
        ],[
            'state.kode_kriteria.required' => 'Tidak boleh kosong.',
            'state.nama_kriteria.required' => 'Tidak boleh kosong.',
            'state.keterangan.required' => 'Tidak boleh kosong.',
            'state.bobot.required' => 'Tidak boleh kosong.',
        ]);

        $kriteriaService = new KriteriaService();
        $checkKode = $kriteriaService->getByKode($this->state['kode_kriteria'] );
        if(!is_null($checkKode)){
            $this->addError('state.kode_kriteria', 'Kode telah digunakan kriteria lain.');
        }else {
            $kriteria = new Kriteria();
            $kriteria->fill($this->state);
            $kriteriaService->add($kriteria);

            $this->emit('kriteria.saved');

            $this->state = [
                'kode_kriteria' => '',
                'nama_kriteria' => '',
                'keterangan' => '',
                'bobot' => '',
                'jenis' => 'Benefit',
            ];

            $this->dataKriteria = Kriteria::all();
        }  
    }

    public function detail($id)
    {
        $this->resetErrorBag();
        $kriteriaService = new KriteriaService();
        $this->detailKriteria = $kriteriaService->getById($id)->withoutRelations()->toArray(); 
    }

    public function update()
    {
        $this->resetErrorBag();
        $this->validate([
            'detailKriteria.kode_kriteria' => 'required',
            'detailKriteria.nama_kriteria' => 'required',
            'detailKriteria.keterangan' => 'required',
            'detailKriteria.bobot' => 'required',
        ],[
            'detailKriteria.kode_kriteria.required' => 'Tidak boleh kosong.',
            'detailKriteria.nama_kriteria.required' => 'Tidak boleh kosong.',
            'detailKriteria.keterangan.required' => 'Tidak boleh kosong.',
            'detailKriteria.bobot.required' => 'Tidak boleh kosong.',
        ]);
            
        $kriteriaService = new KriteriaService();
        $kriteria = $kriteriaService->getById($this->detailKriteria['id_kriteria']);
        $checkKode = $kriteriaService->getByKode($this->detailKriteria['kode_kriteria'] );
        if(!is_null($checkKode) && $kriteria->kode_kriteria != $checkKode->kode_kriteria){
            $this->addError('detailKriteria.kode_kriteria', 'Kode telah digunakan kriteria lain.');
        }else {
            $kriteria->fill($this->detailKriteria);
            $kriteria->save();

            $this->emit('kriteria.updated');
            $this->dataKriteria = Kriteria::all();
        }
    }

    public function delete()
    {
        $this->resetErrorBag();
        $kriteriaService = new KriteriaService();
        $kriteria = $kriteriaService->getById($this->detailKriteria['id_kriteria']);
        $kriteria->delete();
        $this->emit('kriteria.deleted');
        $this->dataKriteria = Kriteria::all();
        
    }

}
