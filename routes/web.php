<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\ManagemenanggotaController;
use App\Http\Controllers\SuratController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth'])->name('dashboard');

Route::get('/create-surat', function(){
    return view('pages.surat.suratbaru.createsurat');
})->middleware(['auth']);

Route::resource('/managemen-anggota', ManagemenanggotaController::class)->middleware(['auth']);
Route::resource('/klasifikasi', KlasifikasiController::class)->middleware(['auth']);

Route::get('/surat-baru', [SuratController::class, 'index'])->middleware(['auth']);
Route::post('/surat-baru', [SuratController::class, 'index'])->middleware(['auth']);
Route::get('/surat-baru/create', [SuratController::class, 'suratBaru'])->name('suratbaru');
Route::post('/surat-baru/create', [SuratController::class, 'createSurat'])->middleware(['auth']);

require __DIR__.'/auth.php';
