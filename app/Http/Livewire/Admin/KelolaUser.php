<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\User;

use App\Services\UserService;

use Hash;

class KelolaUser extends Component
{
    public $dataUser;
    public $state = [];

    public function render()
    {
        return view('livewire.admin.kelola-user');
    }

    public function mount(){
        $this->dataUser = User::all();
        $this->state = [
            'nama_pengguna' => '',
            'hak_akses' => 'Admin',
            'username' => '',
            'password' => '',
            'password_confirmation' => '',
        ];
    }

    public function tambahUser()
    {
        $this->resetErrorBag();

        $this->validate([
            'state.nama_pengguna' => 'required',
            'state.hak_akses' => 'required',
            'state.username' => 'required|min:4',
            'state.password' => 'required|min:8',
            'state.password_confirmation' => 'required|min:8',
        ],[
            'state.nama_pengguna.required' => 'Tidak boleh kosong.',
            'state.hak_akses.required' => 'Pilih jabatan.',
            'state.username.required' => 'Tidak boleh kosong.',
            'state.username.min' => 'Username minimal 4 karakter.',
            'state.password.required' => 'Tidak boleh kosong.',
            'state.password.min' => 'Password minimal 8 karakter.',
            'state.password_confirmation.required' => 'Tidak boleh kosong.',
            'state.password_confirmation.min' => 'Confirm password minimal 8 karakter.',
        ]);

        $userService = new UserService();
        $checkUsername = $userService->getByUsername($this->state['username'] );
        if($this->state['password'] != $this->state['password_confirmation']){
            $this->addError('state.password_confirmation', 'Confirm password tidak cocok.');
        }else if(!is_null($checkUsername)){
            $this->addError('state.username', 'Username telah digunakan orang lain.');
        }else {
            $user = new User();
            $user->fill($this->state);
            $user->password = Hash::make($this->state['password']);
            $userService->add($user);

            $this->emit('user.saved');
            $this->emitTo('data-user', 'refresh-data-user');

            $this->state = [
                'nama_pengguna' => '',
                'username' => '',
                'password' => '',
                'password_confirmation' => '',
            ];

            $this->dataUser = User::all();
        }
        
    }
}
