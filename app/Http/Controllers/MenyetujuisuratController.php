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
    public function setujui($id){
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "disetujui"]);
        return redirect()->route('menyetujuiSurat');
    }
    public function tolak($id){
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "ditolak"]);
        return redirect()->route('menyetujuiSurat');
    }
    public function tunda($id){
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "pending"]);
        return redirect()->route('menyetujuiSurat');
    }
    public function revisi($id){
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "revisi"]);
        return redirect()->route('menyetujuiSurat');
    }
}
