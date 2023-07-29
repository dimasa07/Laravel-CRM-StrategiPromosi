<?php

namespace App\Services;

use App\Models\Penilaian;

class PenilaianService
{

  public function getAll()
  {
      return Penilaian::all();
  }

  public function add(Penilaian $penilaian)
  {
      return $penilaian->save();
  }

  public function getById($id)
  {
      return Penilaian::where('id_penilaian', '=', $id)->first();
  }

  public function getByIdAlternatifAndIdKriteria($idAlternatif, $idKriteria)
  {
        $penilaian = Penilaian::where([
            ['id_alternatif', '=', $idAlternatif],
            ['id_kriteria', '=', $idKriteria]
        ])->first();

        return $penilaian;
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