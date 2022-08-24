<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(){
        $pagename = "Laporan Surat";
        $laporan = SuratKeluar::all();
        return view('pages.laporan', compact('pagename', 'laporan'));
    }

    public function laporansm(){
        $pagename = "Laporan Surat Masuk";
        $laporan = SuratKeluar::where('surat', 'masuk')->get();
        return view('pages.admin.laporansuratmasuk', compact('pagename', 'laporan'));
    }
}
