<?php

namespace App\Http\Controllers;

use File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagemenanggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usr = User::all();
        return view('pages.admin.managemenanggota', compact('usr'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $input = [
                'nama' => $request->nama,
                'nik' => $request->nik,
                'email' => $request->email,
                'password' => Hash::make($request->nik),
                'level' => 'user',
            ];
            
            if ($request->hasFile('ttd')) {
                $ttd = $request->file('ttd');
                $tmpatfilettd = 'img/ttd/';
                $namaFile = date('YmdHis').".".$ttd->getClientOriginalExtension();
                $ttd->move($tmpatfilettd, $namaFile);
                $input['ttd'] = "$namaFile";
            }
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $tmpatfile = 'img/profil/';
                $namaFile = date('YmdHis').".".$foto->getClientOriginalExtension();
                $foto->move($tmpatfile, $namaFile);
                $input['foto'] = "$namaFile";
            }

            User::create($input);

            return redirect()->route('managemen-anggota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $update = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $tempatfile = "img/profil/";
            $namaFile = date('YmdHis').".".$foto->getClientOriginalExtension();
            $foto->move($tempatfile, $namaFile);
            $update['foto'] = "$namaFile";
            if (File::exists(public_path($tempatfile . $user->foto))) {
                File::delete(public_path($tempatfile . $user->foto));
            }
        }

        if ($request->hasFile('ttd')) {
            $ttd = $request->file('ttd');
            $tempatfilettd = "img/ttd/";
            $namaFile = date('YmdHis').".".$ttd->getClientOriginalExtension();
            $ttd->move($tempatfilettd, $namaFile);
            $update['ttd'] = "$namaFile";
            if (File::exists(public_path($tempatfilettd . $user->ttd))) {
                File::delete(public_path($tempatfilettd . $user->ttd));
            }
        }

        $user->update($update);

        return redirect()->route('managemen-anggota.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::FindOrFail($id);
        if (File::exists(public_path("img/profil/" . $user->foto))) {
            File::delete(public_path("img/profil/" . $user->foto));
        }
        if (File::exists(public_path("img/ttd/" . $user->ttd))) {
            File::delete(public_path("img/ttd/" . $user->ttd));
        }
        $user->destroy($id);

        return back();
    }
}
