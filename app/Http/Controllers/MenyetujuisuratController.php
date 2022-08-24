<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenyetujuisuratController extends Controller
{
    // surat masuk
    public function index(){
        $pagename = "Surat Masuk";
        $surat = SuratKeluar::where('surat', 'masuk')->get();
        // dd($surat);
        return view('pages.menyetujui.surat', compact('surat', 'pagename'));
    }
    public function setujui($id){
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "disetujui"]);
        return redirect()->route('menyetujuiSurat');
    }
    public function tolak($id){ // arsipkan surat masuk
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "ditolak"]);
        return redirect()->route('menyetujuiSurat');
    }
    public function tunda($id){ // proses surat masuk
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "pending"]);
        return redirect()->route('menyetujuiSurat');
    }

    // surat keluar
    public function suratkeluar(){
        $pagename = "Surat Keluar";
        $surat = SuratKeluar::where('surat', 'keluar')->get();
        return view('pages.menyetujui.suratkel', compact('surat', 'pagename'));
    }
    public function setujuikel($id){
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "disetujui"]);
        return redirect()->route('menyetujuiSuratKeluar');
    }
    public function arsipkan($id){ // arsipkan surat keluar
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "ditolak"]);
        return redirect()->route('menyetujuiSuratKeluar');
    }
    public function proses($id){ // proses surat keluar
        $item = SuratKeluar::where("id", $id)->update(['status_surat' => "pending"]);
        return redirect()->route('menyetujuiSuratKeluar');
    }
}
