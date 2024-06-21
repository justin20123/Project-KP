<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PengajarController;
use App\Models\Admin;
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

//admin
Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'owner'], function () {
    Route::resource('/dashboard', AdminController::class)->names('owner.dashboard')->only(['index']);

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

Route::get('/', function () {
    // return view('welcome');
    $user = Auth::user();
    if ($user && $user->hasRole('admin')) {
        return redirect()->route('admin.dashboard.index');
    } 
    else if ($user && $user->hasRole('pengajar')) {
        return redirect()->route('pengajar.dashboard.index');
    } 
    else if ($user && $user->hasRole('peserta')) {
        return redirect()->route('peserta.dashboard.index');
    } 
    else {
        return redirect()->route('login');
    }
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
