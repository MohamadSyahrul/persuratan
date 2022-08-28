<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagename = "Disposisi";
        $disposisi = Disposisi::with(['namapenerima', 'surat'])->where('id_user', Auth::user()->id)->get();
        return view('pages.disposisi', compact('disposisi', 'pagename'));
    }
    public function indexAll()
    {
        $pagename = "Disposisi";
        $disposisi = Disposisi::with(['namapenerima', 'surat'])->get();
        return view('pages.disposisiall', compact('disposisi', 'pagename'));
    }

    public function disposisisurat(Request $request){
        $dispo = $request->all();
        $dispo['kode_disposisi'] = KodeDispo($request->batas_waktu, $request->sifat, $request->status_disposisi);
        $dispo['status_disposisi'] = 'proses';
        SuratKeluar::where('id', $request->id_surat)->update(['status_dispo' => 'sudah']);
        Disposisi::create($dispo);
        return redirect()->route('suratMasukPimpinan')->with('success', 'Surat berhasil di disposisikan !');
    }

    public function disposisiadmin(){
        $pagename = "Disposisi";
        $disposisi = Disposisi::with(['namapenerima', 'surat'])->get();
        return view('pages.admin.disposisiadmin', compact('disposisi', 'pagename'));
    }

    public function ubahStatusSelesai($id)
    {
        Disposisi::where("id", $id)->update(['status_disposisi' => 'selesai']);
        return back();
    }
    public function ubahStatusProses($id)
    {
        Disposisi::where("id", $id)->update(['status_disposisi' => 'proses']);
        return back();
    }

}
