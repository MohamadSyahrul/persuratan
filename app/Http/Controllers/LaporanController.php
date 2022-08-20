<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(){
        $pagename = "Laporan Surat";
        $pimpinan = SuratKeluar::with('user')->where('id_penerima', Auth::user()->id)->get();
        $laporan = SuratKeluar::with('user')->get();
        return view('pages.laporan', compact('pagename', 'laporan' , 'pimpinan'));
    }
}
