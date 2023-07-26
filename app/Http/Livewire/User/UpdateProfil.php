<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Services\UserService;

use Hash;

class UpdateProfil extends Component
{

    public $state = [];
    public $passwords = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];
    public $verificationLinkSent = false;

   
    public function render()
    {
        return view('livewire.user.update-profil');
    }

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    
    public function updateProfil()
    {
        $this->resetErrorBag();

        $this->validate([
            'state.nama_pengguna' => 'required',
            // 'state.email' => 'email',
            'state.username' => 'required|min:4',
        ],[
            'state.nama_pengguna.required' => 'Tidak boleh kosong.',
            // 'state.email.email' => 'Harap masukan email dengan benar.',
            'state.username.required' => 'Tidak boleh kosong.',
            'state.username.min' => 'Username minimal 4 karakter.',
        ]);

        $user = Auth::user();
        $userService = new UserService();
        $checkUsername = $userService->getByUsername($this->state['username'] );

        if(!is_null($checkUsername) && $this->state['username'] != $user->username){
            $this->addError('state.username', 'Username telah digunakan orang lain.');
        }else{
            $user->fill($this->state);
            $user->save();

            $this->emit('profil.saved');
            $this->emit('refresh-nav-menu');
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'passwords.current_password' => 'required|min:8',
            'passwords.password' => 'required|min:8',
            'passwords.password_confirmation' => 'required|min:8',
        ],[
            'passwords.current_password.required' => 'Tidak boleh kosong.',
            'passwords.current_password.min' => 'Current password minimal 8 karakter.',
            'passwords.password.required' => 'Tidak boleh kosong.',
            'passwords.password.min' => 'Password minimal 8 karakter.',
            'passwords.password_confirmation.required' => 'Tidak boleh kosong.',
            'passwords.password_confirmation.min' => 'Confirm password minimal 8 karakter.',
        ]);

        $user = Auth::user();

        if(Hash::check($this->passwords['current_password'], $user->password)){
            if($this->passwords['password'] != $this->passwords['password_confirmation']){
                $this->addError('passwords.password_confirmation', 'Confirm password tidak cocok.');
            }else{

                $user->password = Hash::make($this->passwords['password']);
                $user->save();

                $this->emit('password.saved');

                $this->passwords = [
                    'current_password' => '',
                    'password' => '',
                    'password_confirmation' => '',
                ];
            }
        }else{
            $this->addError('passwords.current_password', 'Current password tidak cocok.');
        }
    }

    public function sendEmailVerification()
    {
        Auth::user()->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;
    }

    public function getUserProperty()
    {
        return Auth::user();
    }
}
