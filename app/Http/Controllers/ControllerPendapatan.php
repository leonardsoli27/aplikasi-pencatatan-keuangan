<?php

namespace App\Http\Controllers;

use App\Exports\PendapatanExport;
use Illuminate\Http\Request;
use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ControllerPendapatan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->format('Y');
        $kelompok = auth()->user()->kode_kelompok;

        if ($kelompok == 'admin') {
            // pendapatan
            $kas_masuk = Pendapatan::where('status', 'Lunas')->whereYear('tgl_masuk', $now)->sum('kas_masuk');
            $kas_keluar = Pendapatan::where('status', 'Lunas')->whereYear('tgl_masuk', $now)->sum('kas_keluar');
            $total = $kas_masuk - $kas_keluar;
            // cod
            $sampai = Pendapatan::where('jenis_pembayaran', 'COD')->where('status', 'Sampai')->whereYear('tgl_masuk', $now)->sum('total');
            $belum = Pendapatan::where('jenis_pembayaran', 'COD')->where('status', 'Belum Sampai')->whereYear('tgl_masuk', $now)->sum('total');
            $gagal = Pendapatan::where('jenis_pembayaran', 'COD')->where('status', 'Gagal')->whereYear('tgl_masuk', $now)->sum('total');
            // pengeluaran
            $pengeluaran = Pengeluaran::where('kategori', 'Iklan')->whereYear('tgl_pengeluaran', $now)->sum('total');
            $operasional = Pengeluaran::where('kategori', 'Operasional')->whereYear('tgl_pengeluaran', $now)->sum('total');
        } else {
            // pendapatan
            $kas_masuk = Pendapatan::where('kode_kelompok', $kelompok)->where('status', 'Lunas')->whereYear('tgl_masuk', $now)->sum('kas_masuk');
            $kas_keluar = Pendapatan::where('kode_kelompok', $kelompok)->where('status', 'Lunas')->whereYear('tgl_masuk', $now)->sum('kas_keluar');
            $total = $kas_masuk - $kas_keluar;
            // cod
            $sampai = Pendapatan::where('kode_kelompok', $kelompok)->where('jenis_pembayaran', 'COD')->where('status', 'Sampai')->whereYear('tgl_masuk', $now)->sum('total');
            $belum = Pendapatan::where('kode_kelompok', $kelompok)->where('jenis_pembayaran', 'COD')->where('status', 'Belum Sampai')->whereYear('tgl_masuk', $now)->sum('total');
            $gagal = Pendapatan::where('kode_kelompok', $kelompok)->where('jenis_pembayaran', 'COD')->where('status', 'Gagal')->whereYear('tgl_masuk', $now)->sum('total');
            // pengeluaran
            $pengeluaran = Pengeluaran::where('kode_kelompok', $kelompok)->where('kategori', 'Iklan')->whereYear('tgl_pengeluaran', $now)->sum('total');
            $operasional = 0;
        }
        // dd($pendapatan);

        return view('admin.dashboard', compact('total', 'kas_masuk', 'kas_keluar', 'sampai', 'belum', 'gagal', 'pengeluaran', 'operasional'));
    }

    public function cod()
    {
        $kelompok = auth()->user()->kode_kelompok;
        // cod belum sampai
        if ($kelompok == 'admin') {
            $cod = DB::table('pendapatan')
                ->where('jenis_pembayaran', 'COD')
                ->where('status', 'belum sampai')->get();
        } else {
            $cod = DB::table('pendapatan')
                ->where('kode_kelompok', $kelompok)
                ->where('jenis_pembayaran', 'COD')
                ->where('status', 'belum sampai')
                ->get();
        }

        return view('admin.cod.cod', compact('cod'));
    }

    public function cod_sampai()
    {
        $kelompok = auth()->user()->kode_kelompok;
        // yang mau di tagih
        if ($kelompok == 'admin') {
            $cod = DB::table('pendapatan')
                ->where('jenis_pembayaran', 'COD')
                ->where('status', 'sampai')->get();
        } else {
            $cod = DB::table('pendapatan')
                ->where('kode_kelompok', $kelompok)
                ->where('jenis_pembayaran', 'COD')
                ->where('status', 'sampai')->get();
        }

        return view('admin.cod.cod_sampai', compact('cod'));
    }

    public function cod_gagal()
    {
        //cod gagal
        $kelompok = auth()->user()->kode_kelompok;

        if ($kelompok == 'admin') {
            $cod = DB::table('pendapatan')
                ->where('jenis_pembayaran', 'COD')
                ->where('status', 'Gagal')->get();
        } else {
            $cod = DB::table('pendapatan')
                ->where('kode_kelompok', $kelompok)
                ->where('jenis_pembayaran', 'COD')
                ->where('status', 'Gagal')->get();
        }

        return view('admin.cod.cod_gagal', compact('cod'));
    }

    public function tbl_Pendapatan()
    {
        // cod sudah ditagih dan transfer langsung
        $kelompok = auth()->user()->kode_kelompok;

        if ($kelompok == 'admin') {
            $pendapatan = DB::table('pendapatan')
                ->where('status', 'Lunas')->get();
        } else {
            $pendapatan = DB::table('pendapatan')
                ->where('kode_kelompok', $kelompok)
                ->where('status', 'Lunas')->get();
        }

        // dd($pendapatan);

        return view('admin.pendapatan', compact('pendapatan'));
    }

    public function periode(Request $request)
    {
        $request->validate([
            'kode_kelompok' => 'required',
            'jenis_pembayaran' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required'
        ]);

        $kode_kelompok = $request->kode_kelompok;
        $jenis_pembayaran = $request->jenis_pembayaran;
        $dari = $request->tgl_awal;
        $sampai = $request->tgl_akhir;

        if ($kode_kelompok == 'admin') {
            if ($jenis_pembayaran == 'Semua') {
                $periode = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)->sum('total');
            } else {
                $periode = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('jenis_pembayaran', $jenis_pembayaran)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('jenis_pembayaran', $jenis_pembayaran)->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('jenis_pembayaran', $jenis_pembayaran)->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('jenis_pembayaran', $jenis_pembayaran)->sum('total');
            }
        } else {
            if ($jenis_pembayaran == 'Semua') {

                $periode = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('total');
            } else {
                $periode = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)
                    ->where('jenis_pembayaran', $jenis_pembayaran)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)
                    ->where('jenis_pembayaran', $jenis_pembayaran)->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)
                    ->where('jenis_pembayaran', $jenis_pembayaran)->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('total');
            }
        }

        // dd($request->all());

        return view('admin.laporan_m', compact('periode', 'kas_masuk', 'kas_keluar', 'total'))->with('masuk');
    }

    public function laporan_m()
    {
        $periode = [];
        $kas_masuk = 0;
        $kas_keluar = 0;
        $total = 0;
        return view('admin.laporan_m', compact('periode', 'kas_masuk', 'kas_keluar', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah.tbh_pendapatan');
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
            'kode_kelompok' => 'required',
            'nama_pembeli' => 'required',
            'nama_produk' => 'required',
            'jml_produk' => 'required',
            'kas_masuk' => 'required',
            'kas_keluar' => 'required',
            'total' => 'required',
            'jenis_pembayaran' => 'required',
            'tgl_masuk' => 'required'
        ]);

        if ($request->jenis_pembayaran == 'COD') {
            $status = 'Belum Sampai';
        } else {
            $status = 'Lunas';
        }

        $jml_transaksi = count($request->nama_produk) - 1;
        $transaksi = $request->nama_produk;



        if ($jml_transaksi > 0) {
            foreach (array_filter($transaksi, 'strlen') as $item => $value) {
                $pendapatan = array(
                    'kode_kelompok' => $request->kode_kelompok,
                    'suplier' => $request->suplier,
                    'nama_pembeli' => $request->nama_pembeli,
                    'nama_produk' => $request->nama_produk[$item],
                    'jml_produk' => $request->jml_produk[$item],
                    'kas_masuk' => $request->kas_masuk[$item],
                    'kas_keluar' => $request->kas_keluar[$item],
                    'total' => $request->total[$item],
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'status' => $status,
                    'no_resi' => $request->no_resi,
                    'no_pesanan' => $request->no_pesanan,
                    'akun_shopee' => $request->akun_shopee,
                    'tgl_masuk' => $request->tgl_masuk,
                );

                Pendapatan::insert($pendapatan);
            }
        }

        if ($request->jenis_pembayaran == 'Transfer') {
            return redirect('/pendapatan')->with('update_m', 'Pendapatan Berhasil Di Tambahkan');
        } else {
            return redirect('/cod')->with('update_m', 'Pendapatan Berhasil Di Tambahkan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_pendapatan = Pendapatan::where('id', $id)->get();

        return view('admin.edit.edit_pemasukkan', ['id' => $id_pendapatan]);
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
            'kode_kelompok' => 'required',
            'nama_produk' => 'required',
            'jml_produk' => 'required',
            'kas_masuk' => 'required',
            'kas_keluar' => 'required',
            'total' => 'required',
            'jenis_pembayaran' => 'required',
            'tgl_masuk' => 'required'
        ]);

        if ($request->jenis_pembayaran == 'Transfer') {
            $status = 'Lunas';
        } else {
            $status = $request->status;
        }


        $pendapatan = Pendapatan::find($request->id);
        $pendapatan->id = $request->id;
        $pendapatan->kode_kelompok = $request->kode_kelompok;
        $pendapatan->suplier = $request->suplier;
        $pendapatan->nama_pembeli = $request->nama_pembeli;
        $pendapatan->nama_produk = $request->nama_produk;
        $pendapatan->jml_produk = $request->jml_produk;
        $pendapatan->kas_masuk = $request->kas_masuk;
        $pendapatan->kas_keluar = $request->kas_keluar;
        $pendapatan->total = $request->total;
        $pendapatan->jenis_pembayaran = $request->jenis_pembayaran;
        $pendapatan->status = $status;
        $pendapatan->no_resi = $request->no_resi;
        $pendapatan->no_pesanan = $request->no_pesanan;
        $pendapatan->akun_shopee = $request->akun_shopee;
        $pendapatan->tgl_masuk = $request->tgl_masuk;

        $pendapatan->save();

        if ($request->jenis_pembayaran == 'COD') {
            if ($request->status == 'Lunas') {
                return redirect('/pendapatan')->with('update_m', 'Pendapatan Berhasil Di Edit');
            }
            if ($request->status == 'Sampai') {
                return redirect('/cod/cod_sampai')->with('update_m', 'Pendapatan Berhasil Di Edit');
            }
            if ($request->status == 'Belum Sampai') {
                return redirect('/cod')->with('update_m', 'Pendapatan Berhasil Di Edit');
            }
            if ($request->status == 'Gagal') {

                return redirect('/cod/cod_gagal')->with('update_m', 'Pendapatan Berhasil Di Edit');
            }
        }
        if ($request->jenis_pembayaran == 'Transfer') {
            return redirect('/pendapatan')->with('update_m', 'Pendapatan Berhasil Di Edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Pendapatan::where('id', $id)->delete();

        return back();
    }

    public function export()
    {
        return Excel::download(new PendapatanExport, 'pendapatan.xlsx');
    }
}
