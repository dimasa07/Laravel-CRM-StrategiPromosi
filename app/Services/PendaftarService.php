<?php

namespace App\Services;

use App\Models\Pendaftar;

class PendaftarService
{

  public function getAll()
  {
      return Pendaftar::all();
  }

  public function add(Pendaftar $pendaftar)
  {
      return $pendaftar->save();
  }

  public function getById($id)
  {
      return Pendaftar::where('id_pendaftar', '=', $id)->first();
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