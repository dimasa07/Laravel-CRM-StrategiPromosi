<?php

namespace App\Services;

use App\Models\Alternatif;

class AlternatifService
{

 public function getAll()
  {
      return Alternatif::all();
  }

  public function add(Alternatif $alternatif)
  {
      return $alternatif->save();
  }

  public function getById($id)
  {
      return Alternatif::where('id_alternatif', '=', $id)->first();
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