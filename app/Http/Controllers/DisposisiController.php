<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

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
        $disposisi = Disposisi::with(['namapenerima', 'surat'])->get();
        return view('pages.disposisi', compact('disposisi', 'pagename'));
    }

    public function disposisisurat(Request $request){
        $dispo = $request->all();
        $dispo['kode_disposisi'] = KodeDispo($request->batas_waktu, $request->sifat, $request->status_disposisi);
        Disposisi::create($dispo);
        return redirect()->route('suratMasukPimpinan')->with('success', 'Surat berhasil di disposisikan !');
    }
}
