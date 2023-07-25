<?php

namespace App\Services;

use App\Models\Kriteria;

class KriteriaService
{

  public function getAll()
  {
      $dataKriteria = Kriteria::all();
      foreach ($dataKriteria as $kriteria) {
        $kriteria->alternatif;
        $kriteria->penilaian;
      }
      return $dataKriteria;
  }

  public function add(Kriteria $kriteria)
  {
      return $kriteria->save();
  }

  public function getById($id)
  {
      $kriteria = Kriteria::where('id_kriteria', '=', $id)->first();
      if(!is_null($kriteria)){
        $kriteria->alternatif;
        $kriteria->penilaian;
      }
      return $kriteria;
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