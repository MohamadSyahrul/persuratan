<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
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
        $klasifikasi = Klasifikasi::all();
        // $user = User::where(function($query) {
        //                 return $query->where('level','pimpinan')
        //                 ->orWhere('level','admin');
        //             })
        //             ->get();
                    // dd($user);
        return view('pages.surat.suratbaru.createsurat', compact( 'klasifikasi'));
    }

    public function createBaru(Request $request)
    {
            $surat = $request->all();
            $surat['id_pembuat'] = Auth::user()->id;
            $surat['surat'] = 'masuk';
            
            if ($request->hasFile('dokumen')) {
                $nama = $request->dokumen;
                $namaFile = time() . rand(100, 999) . "." . $nama->getClientOriginalExtension();
                $surat['dokumen'] = $namaFile;
                $nama->move(public_path() . '/dokumen', $namaFile);
            }else{
                $surat['dokumen'] = 'default.pdf';
            }
            
            SuratKeluar::create($surat);

            if (Auth::user()->level == 'admin') {
                return redirect()->route('suratKeluarAdmin')->with('success', 'Surat berhasil dibuat !');
            }
            if (Auth::user()->level == 'tu') {
                return redirect()->route('suratKeluarTU')->with('success', 'Surat berhasil dibuat !');
            }
            return back();
    }

    public function suratKeluar()
    {
            $pagename = "Surat Keluar";
            $SuratKeluar = SuratKeluar::where('surat', 'masuk')->get();
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
        $detail = SuratKeluar::where('id', $id)->get();
        
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
            $SuratKeluar = SuratKeluar::where('status_surat', 'disetujui')
                                        // ->where('status_dispo', 'belum')
                                        // ->where('id_penerima', Auth::user()->id)
                                        ->get();
            return view('pages.surat.suratKeluar', compact('SuratKeluar', 'pagename', 'user'));
    }

    public function suratMasukAdmin()
    {
            $pagename = "Surat Masuk";
            $user = User::all();
            $disposisi = Disposisi::with('surat','namapenerima')->get();
            $suratmasuk = SuratKeluar::where('status_surat', 'disetujui')
                                        ->where('status_dispo', 'belum')
                                        // ->where('id_penerima', Auth::user()->id)
                                        ->get();
            // dd($suratmasuk);
            return view('pages.admin.suratmasuk', compact('suratmasuk', 'pagename', 'user', 'disposisi'));
    }


    public function suratKeluarPimpinan(){
        $pagename = "Surat Keluar";
        $klasifikasi = Klasifikasi::all();
        $surat = SuratKeluar::with('pembuat')->get();
        // dd($surat);
        return view('pages.surat.surat', compact('surat','klasifikasi', 'pagename'));
    }
    public function createPimpinan(Request $request)
    {
            $surat = $request->all();
            $surat['id_pembuat'] = Auth::user()->id;
            $surat['surat'] = 'keluar';
            
            if ($request->hasFile('dokumen')) {
                $nama = $request->dokumen;
                $namaFile = time() . rand(100, 999) . "." . $nama->getClientOriginalExtension();
                $surat['dokumen'] = $namaFile;
                $nama->move(public_path() . '/dokumen', $namaFile);
            }else{
                $surat['dokumen'] = 'default.pdf';
            }
            
            SuratKeluar::create($surat);

            if (Auth::user()->level == 'admin') {
                return redirect()->route('suratKeluarAdmin')->with('success', 'Surat berhasil dibuat !');
            }
            if (Auth::user()->level == 'tu') {
                return redirect()->route('suratKeluarTU')->with('success', 'Surat berhasil dibuat !');
            }
            return back();
    }
}
