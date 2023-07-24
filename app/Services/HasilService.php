<?php

namespace App\Services;

use App\Models\Hasil;

class HasilService
{

 public function getAll()
  {
      return Hasil::all();
  }

  public function add(Hasil $hasil)
  {
      return $hasil->save();
  }

  public function getById($id)
  {
      return Hasil::where('id_hasil', '=', $id)->first();
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