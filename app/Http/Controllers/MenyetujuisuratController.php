<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenyetujuisuratController extends Controller
{
    public function index(){
        $pagename = "Surat Masuk";
        $surat = SuratKeluar::all();
        return view('pages.menyetujui.surat', compact('surat', 'pagename'));
    }
}
