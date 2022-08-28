<?php

use App\Http\Controllers\ArsipController;
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
        $total = SuratKeluar::count();
        $pending = SuratKeluar::where('status_surat', 'pending')->count();

        return view('index', [
            'setuju' => $setuju,
            'tolak' => $tolak,
            'total' => $total,
            'pending' => $pending
        ]);
    })->name('dashboard');

    // Route::middleware('admin', 'pimpinan')->group(function() {
    //     Route::get('/surat-masuk-pimpinan', [SuratController::class, 'suratMasukPimpinan'])->name('suratMasukPimpinan');
    // });

    // hak akses untuk admin
    Route::middleware('admin')->group(function() {
        Route::get('/surat-masuk-admin', [SuratController::class, 'suratMasuk'])->name('suratMasukAdmin');
        
        Route::get('/input-surat', [SuratController::class, 'index'])->name('inputsurat');
        Route::resource('/managemen-anggota', ManagemenanggotaController::class);

        Route::get('/admin/surat-keluar', [SuratController::class, 'suratKeluarAdmin'])->name('suratKeluarAdmin');

        Route::get('/admin/download-dokumen/{dokumen}', [SuratController::class, 'downloadDokumen'])->name('downloadadmin');

        Route::get('admin/arsip-surat', [ArsipController::class, 'arsip'])->name('arsipAdmin');

        Route::get('laporan-surat-masuk', [LaporanController::class, 'laporansm'])->name('laporansuratmasuk');

        Route::get('admin/disposisi', [DisposisiController::class, 'disposisiadmin'])->name('disposisiadmin');

    });
    
    Route::get('/disposisi', [DisposisiController::class, 'index'])->name('disposisi');
    // hak akses untuk pimpinan
    Route::middleware('pimpinan')->group(function() {
        Route::get('/surat-masuk-pimpinan', [SuratController::class, 'suratMasukPimpinan'])->name('suratMasukPimpinan');
        // Route::get('/surat-keluar-pimpinan', [SuratController::class, 'suratKeluarPimpinan']);
        Route::post('/disposisi-surat', [DisposisiController::class, 'disposisisurat'])->name('dispo');
        
        Route::get('/pimpinan/download-dokumen/{dokumen}', [SuratController::class, 'downloadDokumen'])->name('downloadpimpinan');
        
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::post('filter-laporan', [LaporanController::class, 'filter'])->name('filterlaporan');


        Route::get('pimpinan/arsip-surat', [ArsipController::class, 'arsip'])->name('arsipPimpinan');

    });
    
    Route::resource('/klasifikasi', KlasifikasiController::class);
    Route::post('/create-surat', [SuratController::class, 'createBaru'])->name('createBaru');
    Route::Post('/surat-keluar', [SuratController::class, 'createPimpinan'])->name('createPimpinan');

    Route::get('ubahstatus-selesai/{id}', [DisposisiController::class, 'ubahStatusSelesai']);
    Route::get('ubahstatus-proses/{id}', [DisposisiController::class, 'ubahStatusProses']);

    // hak akses untuk tu
    Route::middleware('tu')->group(function() {
        Route::get('/surat-baru', [SuratController::class, 'index']);
        Route::get('/edit-surat/{id}', [SuratController::class, 'editSurat'])->name('editSurat');
        Route::put('/update-surat/{id}', [SuratController::class, 'updateSurat'])->name('updateSurat');
        Route::delete('/delete-surat/{id}', [SuratController::class, 'deleteSurat'])->name('deleteSurat');
        Route::get('/detail-surat/{id}', [SuratController::class, 'detailSurat'])->name('detailSurat');
        Route::get('/download-dokumen/{dokumen}', [SuratController::class, 'downloadDokumen'])->name('downloadDokumen');

        Route::get('/tu/surat-keluar', [SuratController::class, 'suratKeluar'])->name('suratKeluarTU');

        Route::get('/surat-baru/create', [SuratController::class, 'suratBaru'])->name('suratbaru');
        Route::post('/surat-baru/create', [SuratController::class, 'createSurat']);

        
    });

    // hak akses untuk kepala biro
    Route::middleware('kepalabiro')->group(function() {
        Route::get('/surat',[MenyetujuisuratController::class, 'index'])->name('menyetujuiSurat');
        
        Route::get('/disetujui/{id}', [MenyetujuisuratController::class, 'setujui']);
        Route::get('/ditolak/{id}', [MenyetujuisuratController::class, 'tolak']);
        Route::get('/ditunda/{id}', [MenyetujuisuratController::class, 'tunda']);
        // Route::get('/direvisi/{id}', [MenyetujuisuratController::class, 'revisi']);

        Route::get('/surat-keluar',[MenyetujuisuratController::class, 'suratkeluar'])->name('menyetujuiSuratKeluar');
        Route::get('/setujui/{id}', [MenyetujuisuratController::class, 'setujuikel']);
        Route::get('/arsipkan/{id}', [MenyetujuisuratController::class, 'arsipkan']);
        Route::get('/proses/{id}', [MenyetujuisuratController::class, 'proses']);

        Route::get('/laporan-kepalabiro', [LaporanController::class, 'index'])->name('laporankepalabiro');

        Route::get('/kepalabiro/download-dokumen/{dokumen}', [SuratController::class, 'downloadDokumen'])->name('downloadkepalabiro');

    });


});


require __DIR__.'/auth.php';
