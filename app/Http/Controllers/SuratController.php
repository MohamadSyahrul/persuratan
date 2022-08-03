<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Klasifikasi;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function index(Request $request){
        if($request->isMethod('get')) {
            $klasifikasi = Klasifikasi::orderBy('nama_klasifikasi', 'asc')->get();
            $user = User::select('id', 'nama', 'ttd')->where('level', 'user')->get();
            return view('pages.surat.suratbaru.generatenomor', compact(['klasifikasi', 'user']));
        } else {    
            $klasifikasi = Klasifikasi::find($request->id_klasifikasi);

            $param = [
                'kode' => $klasifikasi->kode,
                'tgl_surat_fisik' => $request->tgl_surat_fisik,
            ];

            $nomor = GenerateNomorSurat($param);
            $validator = User::select('nama')->find($request->id_validator);
            // $ttd = User::select('nama')->find($request->id_ttd);

            $pengajuan = [
                'nomor_surat' => $nomor['nomor_surat'],
                'tgl_surat_fisik' => $request->tgl_surat_fisik,
                'kode_klasifikasi' => $klasifikasi->kode,
                'nama_klasifikasi' => $klasifikasi->nama,
                'id_pembuat' => Auth::user()->id,
                'id_validator' => $request->id_validator,
                'nama_validator' => $validator->nama,
            ];

            return redirect()->route('suratbaru', ['pengajuan' => $pengajuan]);
        }
    }

    public function suratBaru(Request $request)
    {
            $pengajuan = $request->pengajuan;
            return view('pages.surat.suratbaru.createsurat', compact('pengajuan'));
    }
    public function buatSurat(Request $request)
    {
            $req = $request->except(['pengajuan']);

            $param = [
                'kode' => $request->kode_klasifikasi,
                'tgl_surat_fisik' => $request->tgl_surat_fisik,
            ];
                
            $nomor = GenerateNomorSurat($param);
            $req['nomor_surat'] = $nomor['nomor_surat'];
            $req['urutan'] = $nomor['urutan'];

            $param['perihal'] = $request->perihal;
            $param['tujuan'] = $request->tujuan_surat;
            $param['email_tujuan'] = $request->email_tujuan;
            $param['ukuran_ttd'] = $request->ukuran_ttd;
            $param['nomor_surat'] = $nomor['nomor_surat'];
            $param['konten'] = $request->layout_konten;

            $req['layout_konten_draft'] = $request->layout_konten;
            $req['layout_konten'] = variabelReplace($param);

            SuratKeluar::create($req);

            return redirect('/surat-keluar')->with('status', 'Surat berhasil dibuat!');
    }
}
