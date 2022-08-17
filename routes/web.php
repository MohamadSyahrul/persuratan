<?php

use App\Http\Controllers\DisposisiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ManagemenanggotaController;
use App\Http\Controllers\MenyetujuisuratController;
use App\Http\Controllers\SuratController;
use App\Models\SuratKeluar;

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
        $setuju = SuratKeluar::where('status_surat', 'disetujui')->count();
        $tolak = SuratKeluar::where('status_surat', 'ditolak')->count();
        $revisi = SuratKeluar::where('status_surat', 'revisi')->count();
        $pending = SuratKeluar::where('status_surat', 'pending')->count();

        return view('index', [
            'setuju' => $setuju,
            'tolak' => $tolak,
            'revisi' => $revisi,
            'pending' => $pending
        ]);
    })->name('dashboard');

    // Route::middleware('admin', 'pimpinan')->group(function() {
    //     Route::get('/surat-masuk-pimpinan', [SuratController::class, 'suratMasukPimpinan'])->name('suratMasukPimpinan');
    // });

    // hak akses untuk admin
    Route::middleware('admin')->group(function() {
        Route::get('/surat-masuk-admin', [SuratController::class, 'suratMasukPimpinan'])->name('suratMasukAdmin');

        Route::resource('/managemen-anggota', ManagemenanggotaController::class);
    });
    
    // hak akses untuk pimpinan
    Route::middleware('pimpinan')->group(function() {
        Route::get('/surat-masuk-pimpinan', [SuratController::class, 'suratMasukPimpinan'])->name('suratMasukPimpinan');
        // Route::get('/surat-keluar-pimpinan', [SuratController::class, 'suratKeluarPimpinan'])->name('suratKeluarPimpinan');
        Route::get('/disposisi', [DisposisiController::class, 'index'])->name('disposisi');
        Route::post('/disposisi-surat', [DisposisiController::class, 'disposisisurat'])->name('dispo');

        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
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
        Route::get('/surat',[MenyetujuisuratController::class, 'index'])->name('menyetujuiSurat');
        Route::get('/disetujui/{id}', [MenyetujuisuratController::class, 'setujui']);
        Route::get('/ditolak/{id}', [MenyetujuisuratController::class, 'tolak']);
        Route::get('/ditunda/{id}', [MenyetujuisuratController::class, 'tunda']);
        Route::get('/direvisi/{id}', [MenyetujuisuratController::class, 'revisi']);

    });


});


require __DIR__.'/auth.php';
