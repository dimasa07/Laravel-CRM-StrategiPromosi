<?php

namespace App\Services;

use App\Models\RincianBiaya;

class RincianBiayaService
{

  public function getAll()
  {
      $dataRincianBiaya = RincianBiaya::all();
      foreach ($dataRincianBiaya as $rincianBiaya) {
        $rincianBiaya->alternatif;
      }
      return $dataRincianBiaya;
  }

  public function add(RincianBiaya $rincianBiaya)
  {
      return $rincianBiaya->save();
  }

  public function getById($id)
  {
      $rincianBiaya = RincianBiaya::where('id_rincian_biaya', '=', $id)->first();
      if(!is_null($rincianBiaya)){
        $rincianBiaya->alternatif;
      }
      return $rincianBiaya;
  }

  public function getByIdAlternatif($id)
  {
      $dataRincianBiaya = RincianBiaya::where('id_alternatif', '=', $id)->get();
      foreach($dataRincianBiaya as $rincianBiaya){
        $rincianBiaya->alternatif;
      }
      return $dataRincianBiaya;
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