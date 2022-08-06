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


Route::get('/create-surat', function(){
    return view('pages.surat.suratbaru.createsurat');
})->middleware(['auth']);


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');

    // hak akses untuk admin
    Route::middleware('admin')->group(function() {

        Route::resource('/managemen-anggota', ManagemenanggotaController::class);
    });
    
    // hak akses untuk pimpinan
    Route::middleware('pimpinan')->group(function() {
        Route::get('/surat-masuk-pimpinan', [SuratController::class, 'suratMasukPimpinan'])->name('suratMasukPimpinan');
    });

    // hak akses untuk tu
    Route::middleware('tu')->group(function() {
        Route::get('/surat-baru', [SuratController::class, 'index']);
        Route::post('/create-surat', [SuratController::class, 'createBaru'])->name('createBaru');
        Route::get('/surat-keluar', [SuratController::class, 'suratKeluar'])->name('suratKeluar');
        Route::get('/edit-surat/{id}', [SuratController::class, 'editSurat'])->name('editSurat');
        Route::put('/update-surat/{id}', [SuratController::class, 'updateSurat'])->name('updateSurat');
        Route::delete('/delete-surat/{id}', [SuratController::class, 'deleteSurat'])->name('deleteSurat');
        Route::get('/detail-surat/{id}', [SuratController::class, 'detailSurat'])->name('detailSurat');
        Route::get('/download-dokumen/{dokumen}', [SuratController::class, 'downloadDokumen'])->name('downloadDokumen');



        Route::get('/surat-baru/create', [SuratController::class, 'suratBaru'])->name('suratbaru');
        Route::post('/surat-baru/create', [SuratController::class, 'createSurat']);
        
        Route::resource('/klasifikasi', KlasifikasiController::class);
    });



    // hak akses untuk kepala biro
    Route::middleware('kepalabiro')->group(function() {

    });


});


require __DIR__.'/auth.php';
