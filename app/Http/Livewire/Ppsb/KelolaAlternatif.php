<?php

namespace App\Http\Livewire\Ppsb;

use Livewire\Component;

use App\Models\Alternatif;

use App\Services\AlternatifService;

class KelolaAlternatif extends Component
{

    public $dataAlternatif;
    public $state = [];
    public $detailAltenatif;

    public function render()
    {
        return view('livewire.ppsb.kelola-alternatif');
    }

    public function mount(){
        $this->dataAlternatif = Alternatif::all();
        $this->state = [
            'kode_alternatif' => '',
            'bauran_promosi' => '',
            'jenis' => '',
            'waktu_promosi' => '',
            'skala_promosi' => '',
        ];
    }

    public function tambah()
    {
        $this->resetErrorBag();

        $this->validate([
            'state.kode_alternatif' => 'required|max:5',
            'state.bauran_promosi' => 'required',
            'state.jenis' => 'required',
            'state.waktu_promosi' => 'required',
            'state.skala_promosi' => 'required',
        ],[
            'state.kode_alternatif.required' => 'Tidak boleh kosong.',
            'state.kode_alternatif.max' => 'Kode maksimal 5 karakter.',
            'state.bauran_promosi.required' => 'Tidak boleh kosong.',
            'state.jenis.required' => 'Tidak boleh kosong.',
            'state.waktu_promosi.required' => 'Tidak boleh kosong.',
            'state.skala_promosi.required' => 'Tidak boleh kosong.',
        ]);

        $alternatifService = new AlternatifService();
        $checkKode = $alternatifService->getByKode($this->state['kode_alternatif'] );
        if(!is_null($checkKode)){
            $this->addError('state.kode_alternatif', 'Kode telah digunakan alternatif lain.');
        }else {
            $alternatif = new Alternatif();
            $alternatif->fill($this->state);
            $alternatifService->add($alternatif);

            $this->emit('alternatif.saved');

            $this->state = [
                'kode_alternatif' => '',
                'bauran_promosi' => '',
                'jenis' => '',
                'waktu_promosi' => '',
                'skala_promosi' => '',
            ];

            $this->dataAlternatif = Alternatif::all();
        }  
    }

    public function detail($id)
    {
        $this->resetErrorBag();
        $alternatifService = new AlternatifService();
        $this->detailAltenatif = $alternatifService->getById($id)->withoutRelations()->toArray(); 
    }

    public function update()
    {
        $this->resetErrorBag();
        $this->validate([
            'detailAltenatif.kode_alternatif' => 'required',
            'detailAltenatif.bauran_promosi' => 'required',
            'detailAltenatif.jenis' => 'required',
            'detailAltenatif.waktu_promosi' => 'required',
            'detailAltenatif.skala_promosi' => 'required',
        ],[
            'detailAltenatif.kode_alternatif.required' => 'Tidak boleh kosong.',
            'detailAltenatif.bauran_promosi.required' => 'Tidak boleh kosong.',
            'detailAltenatif.jenis.required' => 'Tidak boleh kosong.',
            'detailAltenatif.waktu_promosi.required' => 'Tidak boleh kosong.',
            'detailAltenatif.skala_promosi.required' => 'Tidak boleh kosong.',
        ]);
            
        $alternatifService = new AlternatifService();
        $alternatif = $alternatifService->getById($this->detailAltenatif['id_alternatif']);
        $checkKode = $alternatifService->getByKode($this->detailAltenatif['kode_alternatif'] );
        if(!is_null($checkKode) && $alternatif->kode_alternatif != $checkKode->kode_alternatif){
            $this->addError('detailAltenatif.kode_alternatif', 'Kode telah digunakan alternatif lain.');
        }else {
            $alternatif->fill($this->detailAltenatif);
            $alternatif->save();

            $this->emit('alternatif.updated');
            $this->dataAlternatif = Alternatif::all();
        }

    }

    public function delete()
    {
        $this->resetErrorBag();
        $alternatifService = new AlternatifService();
        $alternatif = $alternatifService->getById($this->detailAltenatif['id_alternatif']);
        $alternatif->delete();
        $this->emit('alternatif.deleted');
        $this->dataAlternatif = Alternatif::all();
        
    }
}
