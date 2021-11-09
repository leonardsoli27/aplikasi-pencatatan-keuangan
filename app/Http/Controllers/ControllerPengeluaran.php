<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class ControllerPengeluaran extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelompok = auth()->user()->kode_kelompok;

        if ($kelompok == 'admin') {
            $pengeluaran = Pengeluaran::where('kategori', 'Iklan')->get();
        } else {
            $pengeluaran = Pengeluaran::where('kode_kelompok', $kelompok)->where('kategori', 'Iklan')->get();
        }

        return view('admin.pengeluaran', compact('pengeluaran'));
    }

    public function operasional()
    {
        $kelompok = auth()->user()->kode_kelompok;

        if ($kelompok == 'admin') {
            $operasional = Pengeluaran::where('kategori', 'Operasional')->get();
        }

        return view('admin.operasional', compact('operasional'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah.tbh_pengeluaran');
    }

    public function periode_keluar(Request $request)
    {

        $request->validate([
            'kode_kelompok' => 'required',
            'kategori' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
        ]);


        $kode_kelompok = $request->kode_kelompok;
        $kategori = $request->kategori;
        $dari = $request->tgl_awal;
        $sampai = $request->tgl_akhir;


        if ($kode_kelompok == 'admin') {
            $periode_keluar = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                ->where('tgl_pengeluaran', '<=', $sampai)
                ->where('kategori', $kategori)
                ->orderBy('tgl_pengeluaran', 'desc')->get();

            $iklan = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                ->where('kategori', $kategori)
                ->where('tgl_pengeluaran', '<=', $sampai)->sum('biaya_iklan');
            $pajak = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                ->where('kategori', $kategori)
                ->where('tgl_pengeluaran', '<=', $sampai)->sum('pajak_iklan');
            $total = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                ->where('kategori', $kategori)
                ->where('tgl_pengeluaran', '<=', $sampai)->sum('total');
        } else {
            $periode_keluar = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                ->where('tgl_pengeluaran', '<=', $sampai)
                ->where('kode_kelompok', $kode_kelompok)
                ->where('kategori', $kategori)
                ->orderBy('tgl_pengeluaran', 'desc')->get();

            $iklan = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                ->where('tgl_pengeluaran', '<=', $sampai)
                ->where('kategori', $kategori)
                ->where('kode_kelompok', $kode_kelompok)->sum('biaya_iklan');
            $pajak = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                ->where('tgl_pengeluaran', '<=', $sampai)
                ->where('kategori', $kategori)
                ->where('kode_kelompok', $kode_kelompok)->sum('pajak_iklan');
            $total = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                ->where('tgl_pengeluaran', '<=', $sampai)
                ->where('kategori', $kategori)
                ->where('kode_kelompok', $kode_kelompok)->sum('total');
        }

        return view('admin.laporan_k', compact('periode_keluar', 'iklan', 'pajak', 'total'));
    }

    public function laporan_k()
    {
        $periode_keluar = [];
        $iklan = 0;
        $pajak = 0;
        $total = 0;
        return view('admin.laporan_k', compact('periode_keluar', 'iklan', 'pajak', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kode_kelompok' => 'required',
            'keterangan' => 'required',
            'kategori' => 'required',
            'biaya_iklan' => 'required',
            'pajak_iklan' => 'required',
            'total' => 'required',
            'tgl_pengeluaran' => 'required'
        ]);

        $pengeluaran = new Pengeluaran;
        $pengeluaran->kode_kelompok = $request->kode_kelompok;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->kategori = $request->kategori;
        $pengeluaran->biaya_iklan = $request->biaya_iklan;
        $pengeluaran->pajak_iklan = $request->pajak_iklan;
        $pengeluaran->total = $request->total;
        $pengeluaran->tgl_pengeluaran = $request->tgl_pengeluaran;

        $pengeluaran->save();

        return redirect('/pengeluaran')->with('sukses_k', 'Pengeluaran Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tbh_operasional()
    {
        return view('admin.tambah.tbh_operasional');
    }


    public function postOperasional(Request $request)
    {
        $request->validate([
            'kode_kelompok' => 'required',
            'keterangan' => 'required',
            'kategori' => 'required',
            'total' => 'required',
            'tgl_pengeluaran' => 'required'
        ]);

        $operasional = new Pengeluaran;
        $operasional->kode_kelompok = $request->kode_kelompok;
        $operasional->keterangan = $request->keterangan;
        $operasional->kategori = $request->kategori;
        $operasional->total = $request->total;
        $operasional->tgl_pengeluaran = $request->tgl_pengeluaran;

        $operasional->save();

        return redirect('/operasional')->with('sukses_k', 'Pengeluaran Berhasil Di Tambahkan');
    }

    public function editOperasional($id)
    {
        $id_pengeluaran = Pengeluaran::find($id);

        return view('admin.edit.edit_operasional', compact('id_pengeluaran'));
    }

    public function upgradeOperasional(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'total' => 'required',
            'tgl_pengeluaran' => 'required'
        ]);

        $pengeluaran = Pengeluaran::find($request->id);
        $pengeluaran->id = $request->id;
        $pengeluaran->kode_kelompok = $request->kode_kelompok;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->total = $request->total;
        $pengeluaran->tgl_pengeluaran = $request->tgl_pengeluaran;

        // dd($pengeluaran);
        $pengeluaran->save();

        return redirect('/operasional')->with('update_k', 'Pengeluaran Berhasil Di Edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_pengeluaran = Pengeluaran::find($id);

        return view('admin.edit.edit_pengeluaran', compact('id_pengeluaran'));
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
        // dd($request->all());
        $request->validate([
            'keterangan' => 'required',
            'biaya_iklan' => 'required',
            'pajak_iklan' => 'required',
            'total' => 'required',
            'tgl_pengeluaran' => 'required'
        ]);

        $pengeluaran = Pengeluaran::find($request->id);
        $pengeluaran->id = $request->id;
        $pengeluaran->kode_kelompok = $request->kode_kelompok;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->biaya_iklan = $request->biaya_iklan;
        $pengeluaran->pajak_iklan = $request->pajak_iklan;
        $pengeluaran->total = $request->total;
        $pengeluaran->tgl_pengeluaran = $request->tgl_pengeluaran;

        // dd($pengeluaran);
        $pengeluaran->save();

        return redirect('/pengeluaran')->with('update_k', 'Pengeluaran Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Pengeluaran::where('id', $id)->delete();

        return back();
    }
}
