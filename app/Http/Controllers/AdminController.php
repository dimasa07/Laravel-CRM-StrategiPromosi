<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{User, Alternatif, Hasil, Kriteria, Pendaftar, Penilaian, RincianBiaya};

use App\Services\{UserService, AlternatifService, HasilService, KriteriaService,
PendaftarService, PenilaianService, RincianBiayaService};

class AdminController extends Controller
{

    public function __construct(
        public UserService $userService,
        public AlternatifService $alternatifService,
        public HasilService $hasilService,
        public KriteriaService $kriteriaService,
        public PendaftarService $pendaftarService,
        public PenilaianService $penilaianService,
        public RincianBiayaService $rincianBiayaService,
    ){}

    public function index(Request $request){
        return view('dashboard');
    }

    /***
     * KELOLA USER
    ***/
    public function dataUser(Request $request){
        $dataUser = $this->userService->getAll();

        return response()->json($hasilQuery);
    }

    public function getUserById(Request $request, string $id){
        $hasilQuery = $this->userService->getById($id);

        return response()->json($hasilQuery);
    }

    public function getUserByUsername(Request $request, string $username){
        $hasilQuery = $this->userService->getByUsername($username);

        return response()->json($hasilQuery);
    }

    public function tambahUser(Request $request){
        $user = new User();
        $user->fill($request->input());
        $hasilQuery = $this->userService->add($user);

        return response()->json($hasilQuery);
    }

    public function ubahUser(Request $request){
        $hasilQuery = $this->userService->update($request->id_user, $request->input());

        return response()->json($hasilQuery);
    }

    public function hapusUser(Request $request, string $id){
        $hasilQuery = $this->userService->delete($id);

        return response()->json($hasilQuery);
    }

    /***
     * KELOLA ALTERNATIF
    ***/
    public function dataAlternatif(Request $request){
        $hasilQuery = $this->alternatifService->getAll();

        return response()->json($hasilQuery);
    }

    public function getAlternatifById(Request $request, string $id){
        $hasilQuery = $this->alternatifService->getById($id);

        return response()->json($hasilQuery);
    }

    public function tambahAlternatif(Request $request){
        $alternatif = new Alternatif();
        $alternatif->fill($request->input());
        $hasilQuery = $this->alternatifService->add($alternatif);

        return response()->json($hasilQuery);
    }

    public function ubahAlternatif(Request $request){
        $hasilQuery = $this->alternatifService->update($request->id_alternatif, $request->input());

        return response()->json($hasilQuery);
    }

    public function hapusAlternatif(Request $request, string $id){
        $hasilQuery = $this->alternatifService->delete($id);

        return response()->json($hasilQuery);
    }

    /***
     * KELOLA HASIL
    ***/
    public function dataHasil(Request $request){
        $hasilQuery = $this->hasilService->getAll();

        return response()->json($hasilQuery);
    }

    public function getHasilById(Request $request, string $id){
        $hasilQuery = $this->hasilService->getById($id);

        return response()->json($hasilQuery);
    }

    public function tambahHasil(Request $request){
        $hasil = new Hasil();
        $hasil->fill($request->input());
        $hasilQuery = $this->hasilService->add($hasil);

        return response()->json($hasilQuery);
    }

    public function ubahHasil(Request $request){
        $hasilQuery = $this->hasilService->update($request->id_hasil, $request->input());

        return response()->json($hasilQuery);
    }

    public function hapusHasil(Request $request, string $id){
        $hasilQuery = $this->hasilService->delete($id);

        return response()->json($hasilQuery);
    }

    /***
     * KELOLA KRITERIA
    ***/
    public function dataKriteria(Request $request){
        $hasilQuery = $this->kriteriaService->getAll();

        return response()->json($hasilQuery);
    }

    public function getKriteriaById(Request $request, string $id){
        $hasilQuery = $this->kriteriaService->getById($id);

        return response()->json($hasilQuery);
    }

    public function tambahKriteria(Request $request){
        $kriteria = new Kriteria();
        $kriteria->fill($request->input());
        $hasilQuery = $this->kriteriaService->add($kriteria);

        return response()->json($hasilQuery);
    }

    public function ubahKriteria(Request $request){
        $hasilQuery = $this->kriteriaService->update($request->id_kriteria, $request->input());

        return response()->json($hasilQuery);
    }

    public function hapusKriteria(Request $request, string $id){
        $hasilQuery = $this->kriteriaService->delete($id);

        return response()->json($hasilQuery);
    }

    /***
     * KELOLA PENDAFTAR
    ***/
    public function dataPendaftar(Request $request){
        $hasilQuery = $this->pendaftarService->getAll();

        return response()->json($hasilQuery);
    }

    public function getPendaftarById(Request $request, string $id){
        $hasilQuery = $this->pendaftarService->getById($id);

        return response()->json($hasilQuery);
    }

    public function tambahPendaftar(Request $request){
        $pendaftar = new Pendaftar();
        $pendaftar->fill($request->input());
        $hasilQuery = $this->pendaftarService->add($pendaftar);

        return response()->json($hasilQuery);
    }

    public function ubahPendaftar(Request $request){
        $hasilQuery = $this->pendaftarService->update($request->id_pendaftar, $request->input());

        return response()->json($hasilQuery);
    }

    public function hapusPendaftar(Request $request, string $id){
        $hasilQuery = $this->pendaftarService->delete($id);

        return response()->json($hasilQuery);
    }

    /***
     * KELOLA PENILAIAN
    ***/
    public function dataPenilaian(Request $request){
        $hasilQuery = $this->penilaianService->getAll();

        return response()->json($hasilQuery);
    }

    public function getPenilaianById(Request $request, string $id){
        $hasilQuery = $this->penilaianService->getById($id);

        return response()->json($hasilQuery);
    }

    public function tambahPenilaian(Request $request){
        $penilaian = new Penilaian();
        $penilaian->fill($request->input());
        $hasilQuery = $this->penilaianService->add($penilaian);

        return response()->json($hasilQuery);
    }

    public function ubahPenilaian(Request $request){
        $hasilQuery = $this->penilaianService->update($request->id_penilaian, $request->input());

        return response()->json($hasilQuery);
    }

    public function hapusPenilaian(Request $request, string $id){
        $hasilQuery = $this->penilaianService->delete($id);

        return response()->json($hasilQuery);
    }

    /***
     * KELOLA RINCIAN BIAYA
    ***/
    public function dataRincianBiaya(Request $request){
        $hasilQuery = $this->rincianBiayaService->getAll();

        return response()->json($hasilQuery);
    }

    public function getRincianBiayaById(Request $request, string $id){
        $hasilQuery = $this->rincianBiayaService->getById($id);

        return response()->json($hasilQuery);
    }

    public function tambahRincianBiaya(Request $request){
        $rincianBiaya = new RincianBiaya();
        $rincianBiaya->fill($request->input());
        $hasilQuery = $this->rincianBiayaService->add($rincianBiaya);

        return response()->json($hasilQuery);
    }

    public function ubahRincianBiaya(Request $request){
        $hasilQuery = $this->rincianBiayaService->update($request->id_rincian_biaya, $request->input());

        return response()->json($hasilQuery);
    }

    public function hapusRincianBiaya(Request $request, string $id){
        $hasilQuery = $this->rincianBiayaService->delete($id);

        return response()->json($hasilQuery);
    }

}
