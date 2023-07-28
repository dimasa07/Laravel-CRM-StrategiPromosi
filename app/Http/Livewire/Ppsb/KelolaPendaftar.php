<?php

namespace App\Http\Livewire\Ppsb;

use Livewire\Component;

use App\Models\Pendaftar;

use App\Services\PendaftarService;

class KelolaPendaftar extends Component
{
    public $dataPendaftar;
    public $state = [];
    public $detailPendaftar;

    public function render()
    {
        return view('livewire.ppsb.kelola-pendaftar');
    }

    public function mount(){
        $this->dataPendaftar = Pendaftar::all();
        $this->state = [
            'nama_siswa' => '',
            'asal_sekolah' => '',
            'tahun_ajaran' => '',
            'nama_ortu' => '',
            'kontak' => '',
        ];
    }

    public function tambah()
    {
        $this->resetErrorBag();

        $this->validate([
            'state.nama_siswa' => 'required',
            'state.asal_sekolah' => 'required',
            'state.tahun_ajaran' => 'required',
            'state.nama_ortu' => 'required',
            'state.kontak' => 'required',
        ],[
            'state.nama_siswa.required' => 'Tidak boleh kosong.',
            'state.asal_sekolah.required' => 'Tidak boleh kosong.',
            'state.tahun_ajaran.required' => 'Tidak boleh kosong.',
            'state.nama_ortu.required' => 'Tidak boleh kosong.',
            'state.kontak.required' => 'Tidak boleh kosong. Isi no telepon/email/dll.',
        ]);

        $pendaftarService = new PendaftarService();
        
        $pendaftar = new Pendaftar();
        $pendaftar->fill($this->state);
        $pendaftarService->add($pendaftar);

        $this->emit('pendaftar.saved');

        $this->state = [
            'nama_siswa' => '',
            'asal_sekolah' => '',
            'tahun_ajaran' => '',
            'nama_ortu' => '',
            'kontak' => '',
        ];

        $this->dataPendaftar = Pendaftar::all();
    }

    public function detail($id)
    {
        $this->resetErrorBag();
        $pendaftarService = new PendaftarService();
        $this->detailPendaftar = $pendaftarService->getById($id)->withoutRelations()->toArray(); 
    }

    public function update()
    {
        $this->resetErrorBag();
        $this->validate([
            'detailPendaftar.nama_siswa' => 'required',
            'detailPendaftar.asal_sekolah' => 'required',
            'detailPendaftar.tahun_ajaran' => 'required',
            'detailPendaftar.nama_ortu' => 'required',
            'detailPendaftar.kontak' => 'required',
        ],[
            'detailPendaftar.nama_siswa.required' => 'Tidak boleh kosong.',
            'detailPendaftar.asal_sekolah.required' => 'Tidak boleh kosong.',
            'detailPendaftar.tahun_ajaran.required' => 'Tidak boleh kosong.',
            'detailPendaftar.nama_ortu.required' => 'Tidak boleh kosong.',
            'detailPendaftar.kontak.required' => 'Tidak boleh kosong. Isi no telepon/email/dll.',
        ]);
            
        $pendaftarService = new PendaftarService();
        $pendaftar = $pendaftarService->getById($this->detailPendaftar['id_pendaftar']);
        
        $pendaftar->fill($this->detailPendaftar);
        $pendaftar->save();

        $this->emit('pendaftar.updated');
        $this->dataPendaftar = Pendaftar::all();
    }

    public function delete()
    {
        $this->resetErrorBag();
        $pendaftarService = new PendaftarService();
        $pendaftar = $pendaftarService->getById($this->detailPendaftar['id_pendaftar']);
        $pendaftar->delete();
        $this->emit('pendaftar.deleted');
        $this->dataPendaftar = Pendaftar::all();
        
    }

}
