<?php

namespace App\Services;

use App\Models\Alternatif;

class AlternatifService
{

 public function getAll()
  {
      $dataAlternatif = Alternatif::all();
      foreach($dataAlternatif as $alternatif){
        $alternatif->hasil;
        $alternatif->kriteria;
        $alternatif->penilaian;
        $alternatif->rincian_biaya;
      }

      return $dataAlternatif;
  }

  public function add(Alternatif $alternatif)
  {
      return $alternatif->save();
  }

  public function getById($id)
  {
      $alternatif = Alternatif::where('id_alternatif', '=', $id)->first();
      if(!is_null($alternatif)){
        $alternatif->hasil;
        $alternatif->kriteria;
        $alternatif->penilaian;
        $alternatif->rincian_biaya;
      }

      return $alternatif;
  }

  public function getByKode($kode)
  {
      $alternatif = Alternatif::where('kode_alternatif', '=', $kode)->first();
      if(!is_null($alternatif)){
        $alternatif->hasil;
        $alternatif->kriteria;
        $alternatif->penilaian;
        $alternatif->rincian_biaya;
      }

      return $alternatif;
  }

  public function update($id, $attributes = [])
  {
      return $this->getById($id)->update($attributes);
  }

  public function delete($id)
  {
      return $this->getById($id)->delete();
  }

}