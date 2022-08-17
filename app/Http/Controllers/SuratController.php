<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Klasifikasi;
use App\Models\SuratKeluar;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index(){
        $user = User::all();
        return view('pages.surat.suratbaru.createsurat', compact('user'));
    }

    public function createBaru(Request $request)
    {
            $surat = $request->all();
            $surat['no_surat'] = GenerateNomorSurat($request->tgl_surat, $request->sifat, $request->perihal);
            $surat['id_pembuat'] = Auth::user()->id;
            if ($request->hasFile('dokumen')) {
                $nama = $request->dokumen;
                $namaFile = time() . rand(100, 999) . "." . $nama->getClientOriginalExtension();
                $surat['dokumen'] = $namaFile;
                $nama->move(public_path() . '/dokumen', $namaFile);
            }else{
                $surat['dokumen'] = 'default.pdf';
            }
            
            SuratKeluar::create($surat);
            return redirect()->route('suratKeluar')->with('success', 'Surat berhasil dibuat !');
    }

    public function suratKeluar()
    {
            $pagename = "Surat Keluar";
            $SuratKeluar = SuratKeluar::with('user')->get();
            return view('pages.surat.suratKeluar', compact('SuratKeluar', 'pagename'));
    }

    public function editSurat($id){
        $row = SuratKeluar::findorfail($id);
        $user = User::all();
        
        return view('pages.surat.suratbaru.editsurat',[
            'row'=> $row,
            'user'=>$user
        ]);
    }

    public function updateSurat(Request $request, $id){
        $surat = SuratKeluar::findOrFail($id);
        $row = $request->all();
        $row['no_surat'] = GenerateNomorSurat($request->tgl_surat, $request->sifat, $request->perihal);
        $row['id_pembuat'] = Auth::user()->id;
            if ($request->hasFile('dokumen')) {
                $nm = $request->dokumen;
                $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
                $request->dokumen = $namaFile;
                $nm->move(public_path() . '/dokumen', $namaFile);
            }else{
                $request->dokumen = 'default.pdf';
            }

        $surat->update($row);
        return redirect()->route('suratKeluar')->with('success', 'Surat berhasil diubah !');
    }
    public function deleteSurat($id){
        $delete = SuratKeluar::findOrFail($id);

        $file = public_path('/dokumen/').$delete->gambar;
            //cek jika ada gambar
        if (file_exists($file)){
            //maka delete file diforder public/img
            @unlink($file);
        }
        //delete data didatabase
        $delete->delete();
        return back();
    }

    public function detailSurat($id){
        $pagename = "Detail Surat";
        $detail = SuratKeluar::with('user')->where('id', $id)->get();
        
        return view('pages.surat.suratbaru.detailsurat',[
            'pagename'=> $pagename,
            'detail'=> $detail
        ]);
    }

    public function downloadDokumen($dokumen){
        // $namaFile = SuratKeluar::where('dokumen', $dokumen)->pluck('dokumen')->first();
        $name = $dokumen;
        $file = public_path("dokumen/". $dokumen);
        // dd($file);

        $headers = ['Content-Type: application/pdf'];
    
        if (file_exists($file)) {
            return \Response::download($file, $name, $headers);
        } else {
            return redirect()->route('suratKeluar')->with('success', 'Dokumen Tidak Ada !');
        }
    }

    // surat untuk pimpinan
    public function suratMasukPimpinan()
    {
            $pagename = "Surat Masuk";
            $user = User::all();
            // dd($user);
            $SuratKeluar = SuratKeluar::where('id_penerima', Auth::user()->id)->get();
            return view('pages.surat.suratKeluar', compact('SuratKeluar', 'pagename', 'user'));
    }
    // public function suratKeluarPimpinan()
    // {
    //         $pagename = "Surat Keluar";
    //         $user = User::all();
    //         // dd($user);
    //         $SuratKeluar = SuratKeluar::where('id_penerima', Auth::user()->id)->get();
    //         return view('pages.surat.suratKeluar', compact('SuratKeluar', 'pagename', 'user'));
    // }
}
