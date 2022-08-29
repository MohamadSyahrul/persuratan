<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(){
        $pagename = "Laporan Surat";

        // if($request->isMethod('get')) {
        //     $laporan = SuratKeluar::all();
        //     return view('pages.laporan', compact('pagename', 'laporan'));
        // }else{
        //     $dari = $request->dari;
        //     $sampai = $request->sampai;
        //     $status = $request->status;
        //     $bersalin = SuratKeluar::where('surat', $status)->whereDate('tgl_surat','>=', $dari)->whereDate('tgl_surat','<=', $sampai)->get();
        //     return view('pages.laporan', compact('pagename', 'laporan'));
        // }
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $data = SuratKeluar::whereBetween('tgl_surat',[$start_date,$end_date])->get();
        } else {
            $data = SuratKeluar::latest()->get();
        }
        
        return view('pages.laporan', compact('data', 'pagename'));
    }

    public function laporansm(){
        $pagename = "Laporan Surat Masuk";
        // $laporan = SuratKeluar::where('surat', 'masuk')->get();
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $laporan = SuratKeluar::whereBetween('tgl_surat',[$start_date,$end_date])->where('surat', 'masuk')->get();
        } else {
            $laporan = SuratKeluar::latest()->get();
        }
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
