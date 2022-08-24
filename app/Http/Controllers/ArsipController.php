<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function arsip(){
        $arsip = SuratKeluar::where('status_surat', 'ditolak')->get();
        return view('pages.arsip', compact('arsip'));
    }
}
