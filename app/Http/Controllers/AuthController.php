<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\{User, Alternatif, Hasil, Kriteria, Pendaftar, Penilaian, RincianBiaya};

use App\Services\{UserService, AlternatifService, HasilService, KriteriaService,
PendaftarService, PenilaianService, RincianBiayaService};

use Hash;

class AuthController extends Controller
{

    public function __construct(
        public UserService $userService
    ){}

    public function formLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            "username" => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password tidak sesuai'
        ])->onlyInput('username');
    }

    public function formRegister(){
        return view('auth.register');
    }

    public function register(Request $request){
        $user = new User();
        $user->fill($request->input());
        $user->password = Hash::make($request->password);

        $check = $this->userService->getByUsername($request->username);

        if(!$check){
            $this->userService->add($user);
        }

        return back();
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
        
        
    }


}
