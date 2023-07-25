<?php

namespace App\Services;

use App\Models\Hasil;

class HasilService
{

 public function getAll()
  {
      $dataHasil = Hasil::all();
      foreach($dataHasil as $hasil){
        $hasil->alternatif;
      }
      return $dataHasil;
  }

  public function add(Hasil $hasil)
  {
      return $hasil->save();
  }

  public function getById($id)
  {
      $hasil = Hasil::where('id_hasil', '=', $id)->first();
      if(!is_null($hasil))$hasil->alternatif;
      return $hasil;
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