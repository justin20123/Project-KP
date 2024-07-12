<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\JadwalKelasController;
use App\Http\Controllers\JadwalpelatihanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\PeriodeController;
use App\Http\Middleware\Authenticate;
use App\Models\JadwalKelas;
use App\Models\Users;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;
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

Route::post('/pelatihan/create', [PelatihanController::class,'create'])->name('pelatihan.upload.csv');
Route::post('/pelatihan/uploadcsv', [PelatihanController::class,'uploadcsv'])->name('pelatihan.uploadcsv');
Route::resource('pelatihan', PelatihanController::class);

Route::resource('periode', PeriodeController::class);
Route::resource('jadwalkelas', JadwalKelasController::class);
Route::get('/laporan/{id}', [LaporanController::class, 'daftarpeserta'])->name('laporan.daftarpeserta');
Route::get('/laporan/{idperiode}/{idpeserta}', [LaporanController::class, 'isievaluasi'])->name('laporan.isievaluasi');
Route::put('/updateevaluasi', [LaporanController::class, 'updateevaluasi'])->name('laporan.updateevaluasi');
Route::resource('laporan', LaporanController::class);
//absensi
Route::get('/lihat_absensi/{id}', [AbsensiController::class, 'lihat_absensi'])->name('absensi.lihat_absensi');
Route::get('/edit_absensi/{id}', [AbsensiController::class, 'edit_absensi'])->name('absensi.edit_absensi');
Route::post('/hadirsemua', [AbsensiController::class, 'hadirsemua'])->name('absensi.hadirsemua');
Route::post('/alfasemua', [AbsensiController::class, 'alfasemua'])->name('absensi.alfasemua');
Route::post('/updatestatuskehadiran', [AbsensiController::class, 'updatestatuskehadiran'])->name('absensi.updatestatuskehadiran');
Route::resource('absensi', AbsensiController::class);

//peserta
Route::post('/peserta/create', [PesertaController::class,'create'])->name('peserta.upload.csv');
Route::post('/peserta/uploadcsv', [PesertaController::class,'uploadcsv'])->name('peserta.uploadcsv');
Route::resource('peserta', PesertaController::class);

//orang tua

Route::post('/orangtua/create', [OrangtuaController::class,'create'])->name('orangtua.upload.csv');
Route::post('/orangtua/uploadcsv', [OrangtuaController::class,'uploadcsv'])->name('orangtua.uploadcsv');
Route::resource('orangtua', OrangtuaController::class);

//pengajar
Route::post('/pengajar/create', [PengajarController::class,'create'])->name('pengajar.upload.csv');
Route::post('/pengajar/uploadcsv', [PengajarController::class,'uploadcsv'])->name('pengajar.uploadcsv');
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

});

Route::group(['middleware' => ['auth', 'role:peserta']], function () {
    Route::resource('/dashboard', PelatihanController::class)->names('pelatihan.dashboard')->only(['index']);
    
});

Route::get('/', function () {
    $user = Auth::user();
    if ($user && $user->hasRole('admin')) {
        return redirect()->view('/admin');
    } 
    else if (($user && $user->hasRole('orang_tua')) || ($user && $user->hasRole('pengajar'))) {
        return redirect()->route('periode.index');
    } 
    else {
        return redirect()->route('login');
    }
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pelatihan', [PelatihanController::class, 'index'])->name('pelatihan.index');

