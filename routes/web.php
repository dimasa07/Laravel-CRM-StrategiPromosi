<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{AdminController, PPSBController, AuthController, UserController};

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'), 
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::user()->hak_akses == 'Admin'){
            return redirect()->route('admin.index');
        }else if(Auth::user()->hak_akses == 'PPSB'){
            return redirect()->route('ppsb.index');
        }
    })->name('dashboard');
});

//AUTH
Route::prefix('/auth')
    ->controller(AuthController::class)
    ->group(function(){
        Route::get('/login', 'formLogin')->name('auth.form.login');
        Route::post('/login', 'login')->name('auth.login');
        Route::get('/register', 'formRegister')->name('auth.form.register');
        Route::post('/register', 'register')->name('auth.register');
    });

//USER
Route::prefix('/user')
    ->controller(UserController::class)
    ->group(function(){
        Route::get('/profil', 'profil')->name('user.profil');
    });

// ADMIN
Route::prefix('/admin')
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/', 'index')->name('admin.index');
        Route::prefix('/kelola-user')->group(function(){
            Route::get('/', function(){
                return view('admin.kelola-user');
            })->name('admin.kelola-user');
            Route::get('/data', 'dataUser')->name('admin.kelola-user.data');
            Route::get('/data/id/{id}', 'getUserById')->name('admin.kelola-user.data.id');
            Route::get('/data/username/{username}', 'getUserByUsername')->name('admin.kelola-user.data.username');
            Route::post('/tambah', 'tambahUser')->name('admin.kelola-user.tambah');
            Route::post('/ubah', 'ubahUser')->name('admin.kelola-user.ubah');
            Route::get('/hapus/{id}', 'hapusUser')->name('admin.kelola-user.hapus');
        });
        Route::prefix('/kelola-alternatif')->group(function(){
            Route::get('/data', 'dataAlternatif')->name('admin.kelola-alternatif.data');
            Route::get('/data/id/{id}', 'getAlternatifById')->name('admin.kelola-alternatif.data.id');
            Route::post('/tambah', 'tambahAlternatif')->name('admin.kelola-alternatif.tambah');
            Route::post('/ubah', 'ubahAlternatif')->name('admin.kelola-alternatif.ubah');
            Route::get('/hapus/{id}', 'hapusAlternatif')->name('admin.kelola-alternatif.hapus');
        });
        Route::prefix('/kelola-hasil')->group(function(){
            Route::get('/data', 'dataHasil')->name('admin.kelola-hasil.data');
            Route::get('/data/id/{id}', 'getHasilById')->name('admin.kelola-hasil.data.id');
            Route::post('/tambah', 'tambahHasil')->name('admin.kelola-hasil.tambah');
            Route::post('/ubah', 'ubahHasil')->name('admin.kelola-hasil.ubah');
            Route::get('/hapus/{id}', 'hapusHasil')->name('admin.kelola-hasil.hapus');
        });
        Route::prefix('/kelola-kriteria')->group(function(){
            Route::get('/data', 'dataKriteria')->name('admin.kelola-kriteria.data');
            Route::get('/data/id/{id}', 'getKriteriaById')->name('admin.kelola-kriteria.data.id');
            Route::post('/tambah', 'tambahKriteria')->name('admin.kelola-kriteria.tambah');
            Route::post('/ubah', 'ubahKriteria')->name('admin.kelola-kriteria.ubah');
            Route::get('/hapus/{id}', 'hapusKriteria')->name('admin.kelola-kriteria.hapus');
        });
        Route::prefix('/kelola-pendaftar')->group(function(){
            Route::get('/data', 'dataPendaftar')->name('admin.kelola-pendaftar.data');
            Route::get('/data/id/{id}', 'getPendaftarById')->name('admin.kelola-pendaftar.data.id');
            Route::post('/tambah', 'tambahPendaftar')->name('admin.kelola-pendaftar.tambah');
            Route::post('/ubah', 'ubahPendaftar')->name('admin.kelola-pendaftar.ubah');
            Route::get('/hapus/{id}', 'hapusPendaftar')->name('admin.kelola-pendaftar.hapus');
        });
        Route::prefix('/kelola-penilaian')->group(function(){
            Route::get('/data', 'dataPenilaian')->name('admin.kelola-penilaian.data');
            Route::get('/data/id/{id}', 'getPenilaianById')->name('admin.kelola-penilaian.data.id');
            Route::post('/tambah', 'tambahPenilaian')->name('admin.kelola-penilaian.tambah');
            Route::post('/ubah', 'ubahPenilaian')->name('admin.kelola-penilaian.ubah');
            Route::get('/hapus/{id}', 'hapusPenilaian')->name('admin.kelola-penilaian.hapus');
        });
        Route::prefix('/kelola-rincian_biaya')->group(function(){
            Route::get('/data', 'dataRincianBiaya')->name('admin.kelola-rincian_biaya.data');
            Route::get('/data/id/{id}', 'getRincianBiayaById')->name('admin.kelola-rincian_biaya.data.id');
            Route::post('/tambah', 'tambahRincianBiaya')->name('admin.kelola-rincian_biaya.tambah');
            Route::post('/ubah', 'ubahRincianBiaya')->name('admin.kelola-rincian_biaya.ubah');
            Route::get('/hapus/{id}', 'hapusRincianBiaya')->name('admin.kelola-rincian_biaya.hapus');
        });
    });

//USER
Route::prefix('/ppsb')
    ->controller(PPSBController::class)
    ->group(function(){
        Route::get('/', 'index')->name('ppsb.index');
        Route::prefix('/kelola-alternatif')->group(function(){
            Route::get('/', function(){
                return view('ppsb.kelola-alternatif');
            })->name('ppsb.kelola-alternatif');
        });
        Route::prefix('/kelola-kriteria')->group(function(){
            Route::get('/', function(){
                return view('ppsb.kelola-kriteria');
            })->name('ppsb.kelola-kriteria');
        });
    });