<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request){
        // $pagename = "Laporan Surat";
        // // $laporan = SuratKeluar::all();
        // // return view('pages.laporan', compact('pagename', 'laporan'));
        // if(request()->ajax())
        // {
        //  if(!empty($request->from_date))
        //  {
          $data = DB::table('surat_keluars')
            ->whereBetween('created_at', array($request->from_date, $request->to_date))
            ->get();
            return response()->json($data, 200);
        //  }
        //  else
        //  {
        //   $data = DB::table('surat_keluars')
        //     ->get();
        //  }
        //  return datatables()->of($data)->make(true);
        // }
        // return view('pages.laporan', compact('pagename'));
    }

    public function laporansm(){
        $pagename = "Laporan Surat Masuk";
        $laporan = SuratKeluar::where('surat', 'masuk')->get();
        return view('pages.admin.laporansuratmasuk', compact('pagename', 'laporan'));
    }
}
