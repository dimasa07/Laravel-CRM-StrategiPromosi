<?php

namespace App\Services;

use App\Models\Kriteria;

class KriteriaService
{

  public function getAll()
  {
      return Kriteria::all();
  }

  public function add(Kriteria $kriteria)
  {
      return $kriteria->save();
  }

  public function getById($id)
  {
      return Kriteria::where('id_kriteria', '=', $id)->first();
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