<?php

namespace App\Services;

use App\Models\Gambar;

class GambarService
{

  public function getAll()
  {
      $dataGambar = Gambar::all();
      return $dataGambar;
  }

  public function add(Gambar $gambar)
  {
      return $gambar->save();
  }

  public function getById($id)
  {
      $gambar = Gambar::where('id_gambar', '=', $id)->first();
      return $gambar;
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