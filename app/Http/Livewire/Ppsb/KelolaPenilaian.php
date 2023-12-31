<?php

namespace App\Http\Livewire\Ppsb;

use Livewire\Component;

use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Hasil;

use App\Services\PenilaianService;
use App\Services\AlternatifService;
use App\Services\KriteriaService;
use App\Services\HasilService;

class KelolaPenilaian extends Component
{
    public $dataAlternatif;
    public $dataKriteria;
    public $dataPenilaian;
    public $dataHasil;
    public $detailPenilaian;
    public $state = [];

    public function render()
    {
        return view('livewire.ppsb.kelola-penilaian');
    }

    public function mount(){
        $this->state = [
            'id_alternatif' => '',
            'id_kriteria' => '',
            'bobot' => '',
        ];
        $this->hitungHasil();
        $this->refreshData();
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
        $checkPenilaian = $penilaianService->getByIdAlternatifAndIdKriteria($this->state['id_alternatif'], $this->state['id_kriteria']);
        if(!is_null($checkPenilaian)){
            $this->addError('state.id_alternatif', 'Penilaian untuk Alternatif dan Kriteria ini telah tersedia.');
            $this->addError('state.id_kriteria', 'Penilaian untuk Alternatif dan Kriteria ini telah tersedia.');
        }else{
            $penilaian = new Penilaian();
            $penilaian->fill($this->state);
            $penilaianService->add($penilaian);

            $this->emit('penilaian.saved');

            $this->state = [
                'id_alternatif' => '',
                'id_kriteria' => '',
                'bobot' => '',
            ];
            $this->hitungHasil();
            $this->refreshData();
        }
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
        $this->hitungHasil();
        $this->refreshData();
    }

    public function delete()
    {
        $this->resetErrorBag();
        $penilaianService = new PenilaianService();
        $penilaian = $penilaianService->getById($this->detailPenilaian['id_penilaian']);
        $penilaian->delete();
        $this->emit('penilaian.deleted');
        $this->hitungHasil();
        $this->refreshData();
    }

    public function hitungHasil()
    {
        $this->refreshData();
        $penilaianService = new PenilaianService();
        $hasilService = new HasilService();
        foreach ($this->dataAlternatif as $alternatif) {
            $nilai = 0;
            $x = 0;
            $y = 1;
            foreach($alternatif->kriteria as $kriteria){
                $bobotAlternatif = $penilaianService->getByIdAlternatifAndIdKriteria($alternatif->id_alternatif, $kriteria->id_kriteria)->bobot;
                $x += $bobotAlternatif;
                $y *= pow($bobotAlternatif / $kriteria->bobot, $kriteria->bobot);
            }
            $nilai = (0.5 * $x) + (0.5 * $y);
            $checkAlternatif = $hasilService->getByIdAlternatif($alternatif->id_alternatif);
            if(is_null($checkAlternatif)){
                $hasil = new Hasil();
                $hasil->id_alternatif = $alternatif->id_alternatif;
                $hasil->nilai = $nilai;
                $hasilService->add($hasil);
            }else{
                $hasilService->update($checkAlternatif->id_hasil, ['nilai' => $nilai]);
            }
        }
        $dataOrdered = Hasil::orderBy('nilai', 'DESC')->get();
        foreach($dataOrdered as $index => $hasil){
            $hasilService->update($hasil->id_hasil, ['urutan' => $index +1]);
        }
    }

    public function refreshData()
    {
        $this->dataAlternatif = Alternatif::all();
        $this->dataKriteria = Kriteria::all();
        $this->dataPenilaian = Penilaian::all();
        $this->dataHasil = Hasil::all();
    }

}
