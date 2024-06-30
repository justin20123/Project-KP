<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PengajarController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();



Route::resource('pelatihan', PelatihanController::class);
//absensi
Route::post('/doAbsensi', [AbsensiController::class, 'doAbsensi'])->name('absensi.doAbsensi');
Route::resource('absensi', AbsensiController::class);

//admin
Route::resource('admin', AdminController::class);
Route::post('admin/aktifkan', [AdminController::class, 'aktifkan'])->name('admin.aktifkan');
Route::post('admin/nonaktifkan', [AdminController::class, 'nonaktifkan'])->name('admin.nonaktifkan');

//peserta

Route::resource('peserta', PesertaController::class);

//orang tua
Route::resource('orangtua', OrangtuaController::class);

//pengajar
Route::resource('pengajar', PengajarController::class);

//admin
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('peserta', PesertaController::class);

    //register admin
    Route::get('/register', [AdminController::class, 'formRegister'])->name('admin.admin.register');
    Route::post('/registeraccount', [AdminController::class, 'register'])->name('admin.admin.registeraccount');
    //register pengajar
    Route::get('/register', [PengajarController::class, 'formRegister'])->name('admin.peserta.register');
    Route::post('/registeraccount', [PengajarController::class, 'register'])->name('admin.peserta.registeraccount');
    //register peserta
    Route::get('/register', [PesertaController::class, 'formRegister'])->name('pengajar.pengajar.register');
    Route::post('/registeraccount', [PesertaController::class, 'register'])->name('pengajar.pengajar.registeraccount');
});

Route::group(['middleware' => ['auth', 'role:peserta']], function () {
    Route::resource('/dashboard', PelatihanController::class)->names('pelatihan.dashboard')->only(['index']);
    
});

Route::get('/', function () {
    $user = Auth::user();
    if ($user && $user->hasRole('admin')) {
        return redirect()->view('/admin');
    } 
    else if (($user && $user->hasRole('peserta')) || ($user && $user->hasRole('pengajar'))) {
        return redirect()->route('pelatihan.index');
    } 
    else {
        return redirect()->route('login');
    }
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pelatihan', [PelatihanController::class, 'index'])->name('pelatihan.index');

