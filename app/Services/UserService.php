<?php

namespace App\Services;

use App\Models\User;

class UserService
{

 public function getAll()
  {
      return User::all();
  }

  public function add(User $user)
  {
      return $user->save();
  }

  public function getById($id)
  {
      return User::where('id_user', '=', $id)->first();
  }

  public function getByUsername($username)
  {
      return User::where('username', '=', $username)->first();
  }

  public function getByPassword($password)
  {
      return User::where('password', '=', sha1($password))->first();
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