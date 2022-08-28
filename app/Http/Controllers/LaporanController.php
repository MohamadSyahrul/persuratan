<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request){
        $pagename = "Laporan Surat";

        if($request->isMethod('get')) {
            $laporan = SuratKeluar::all();
            return view('pages.laporan', compact('pagename', 'laporan'));
        }else{
            $dari = $request->dari;
            $sampai = $request->sampai;
            $status = $request->status;
            $bersalin = SuratKeluar::where('surat', $status)->whereDate('tgl_surat','>=', $dari)->whereDate('tgl_surat','<=', $sampai)->get();
            return view('pages.laporan', compact('pagename', 'laporan'));
        }
    }

    public function laporansm(){
        $pagename = "Laporan Surat Masuk";
        $laporan = SuratKeluar::where('surat', 'masuk')->get();
        return view('pages.admin.laporansuratmasuk', compact('pagename', 'laporan'));
    }

    public function filter(Request $request){
        $pagename = "Laporan Surat";
       
        $dari = $request->dari;
        $sampai = $request->sampai;
        $status = $request->status;

        $bersalin = SuratKeluar::where('surat', $status)->whereDate('tgl_surat','>=', $dari)->whereDate('tgl_surat','<=', $sampai)->get();
        return view('pages.laporan',  compact('pagename', 'laporan'));

    }
}
