<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CekKelompok;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;

class ControllerKaryawan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('admin.karyawan', compact('karyawan'));
    }

    public function index_K()
    {
        $kelompok = User::all();
        // dd($kelompok);
        return view('admin.kelompok', compact('kelompok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelompok = User::all();
        return view('admin.tambah.tbh_karyawan', compact('kelompok'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'no_hp' => 'required|min:11',
            'email' => 'required',
            'nama_kelompok' => 'required'
        ]);

        $karyawan = new Karyawan;
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->email = $request->email;
        $karyawan->nama_kelompok = $request->nama_kelompok;

        $karyawan->save();
        return redirect('/karyawan')->with('sukses_kar', 'Karyawan Baru Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = DB::table('karyawan')->where('id', $id)->get();

        $kode_kelompok = DB::table('users')->get();

        return view('admin.edit.edit_karyawan', ['id' => $id, 'kode_kelompok' => $kode_kelompok]);
    }

    public function upgradeKaryawan(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|min:3',
            'email' => 'required',
            'no_hp' => 'required',
            'nama_kelompok' => 'required',
        ]);

        $karyawan = Karyawan::find($request->id);
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->email = $request->email;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->nama_kelompok = $request->nama_kelompok;

        $karyawan->save();

        return redirect('karyawan')->with('update_kar', 'Data Karyawan Berhasil Di Edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_kelompok)
    {
        $kode_kelompok = DB::table('users')->where('kode_kelompok', $kode_kelompok)->get();
        $nama_kelompok = $kode_kelompok[0]->nama_kelompok;
        $karyawan = DB::table('karyawan')->where('nama_kelompok', $nama_kelompok)->get();

        return view('admin.edit.edit_kelompok', ['kode_kelompok' => $kode_kelompok, 'karyawan' => $karyawan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'nama_kelompok' => 'required|min:3',
            // 'password2' => 'required|min:11',
        ]);

        $kelompok = User::find($request->kode_kelompok);
        $kelompok->nama_kelompok = $request->nama_kelompok;
        $kelompok->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_K($kode_kelompok)
    {
        DB::table('users')->where('kode_kelompok', $kode_kelompok)->delete();
        return redirect('kelompok');
    }

    public function delete_kar($id)
    {
        DB::table('karyawan')->where('id', $id)->delete();
        return redirect('karyawan');
    }
}
