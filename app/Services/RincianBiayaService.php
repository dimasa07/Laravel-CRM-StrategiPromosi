<?php

namespace App\Services;

use App\Models\RincianBiaya;

class RincianBiayaService
{

  public function getAll()
  {
      return RincianBiaya::all();
  }

  public function add(RincianBiaya $rincianBiaya)
  {
      return $rincianBiaya->save();
  }

  public function getById($id)
  {
      return RincianBiaya::where('id_rincian_biaya', '=', $id)->first();
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