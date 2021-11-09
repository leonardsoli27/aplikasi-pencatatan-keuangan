<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class ControllerCetak extends Controller
{
    public function dokumen(Request $request)
    {
        $request->validate([
            'kode_kelompok' => 'required',
            'jenis_dokumen' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required'
        ]);

        $kode_kelompok = $request->kode_kelompok;
        $jenis_dokumen = $request->jenis_dokumen;
        $dari = $request->tgl_awal;
        $sampai = $request->tgl_akhir;

        if ($kode_kelompok == 'admin') {
            if ($jenis_dokumen == 'penjualan') {
                $penjualan = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)->sum('total');
            } else if ($jenis_dokumen == 'lunas') {
                $lunas = Pendapatan::where('status', 'Lunas')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Lunas')->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Lunas')->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Lunas')->sum('total');
            } else if ($jenis_dokumen == 'belum') {
                $belum = Pendapatan::where('status', 'Belum Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Belum Sampai')->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Belum Sampai')->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Belum Sampai')->sum('total');
            } else if ($jenis_dokumen == 'sampai') {
                $sampai1 = Pendapatan::where('status', 'Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('status', 'Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('status', 'Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->sum('kas_keluar');
                $total = Pendapatan::where('status', 'Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->sum('total');
            } else if ($jenis_dokumen == 'gagal') {
                $gagal = Pendapatan::where('status', 'Gagal')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Gagal')->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Gagal')->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Gagal')->sum('total');
            } else if ($jenis_dokumen == 'operasional') {
                $operasional = Pengeluaran::where('kategori', 'Operasional')
                    ->where('tgl_pengeluaran', '>=', $dari)
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->orderBy('tgl_pengeluaran', 'desc')->get();

                $iklan = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Operasional')
                    ->where('tgl_pengeluaran', '<=', $sampai)->sum('biaya_iklan');
                $pajak = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Operasional')
                    ->where('tgl_pengeluaran', '<=', $sampai)->sum('pajak_iklan');
                $total = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Operasional')
                    ->where('tgl_pengeluaran', '<=', $sampai)->sum('total');
            } else if ($jenis_dokumen == 'iklan') {
                $iklan1 = Pengeluaran::where('kategori', 'Iklan')
                    ->where('tgl_pengeluaran', '>=', $dari)
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->orderBy('tgl_pengeluaran', 'desc')->get();

                $iklan = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Iklan')
                    ->where('tgl_pengeluaran', '<=', $sampai)->sum('biaya_iklan');
                $pajak = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Iklan')
                    ->where('tgl_pengeluaran', '<=', $sampai)->sum('pajak_iklan');
                $total = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Iklan')
                    ->where('tgl_pengeluaran', '<=', $sampai)->sum('total');
            }
        } else {
            if ($jenis_dokumen == 'penjualan') {
                $penjualan = Pendapatan::where('tgl_masuk', '>=', $dari)
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
            } else if ($jenis_dokumen == 'lunas') {
                $lunas = Pendapatan::where('status', 'Lunas')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Lunas')
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Lunas')
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Lunas')
                    ->where('kode_kelompok', $kode_kelompok)->sum('total');
            } else if ($jenis_dokumen == 'belum') {
                $belum = Pendapatan::where('status', 'Belum Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Belum Sampai')
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Belum Sampai')
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Belum Sampai')
                    ->where('kode_kelompok', $kode_kelompok)->sum('total');
            } else if ($jenis_dokumen == 'sampai') {
                $sampai1 = Pendapatan::where('status', 'Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)->where('kode_kelompok', $kode_kelompok)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('status', 'Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('status', 'Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_keluar');
                $total = Pendapatan::where('status', 'Sampai')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('total');
            } else if ($jenis_dokumen == 'gagal') {
                $gagal = Pendapatan::where('status', 'Gagal')
                    ->where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)
                    ->orderBy('tgl_masuk', 'desc')->get();

                $kas_masuk = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Gagal')
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_masuk');
                $kas_keluar = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Gagal')
                    ->where('kode_kelompok', $kode_kelompok)->sum('kas_keluar');
                $total = Pendapatan::where('tgl_masuk', '>=', $dari)
                    ->where('tgl_masuk', '<=', $sampai)
                    ->where('status', 'Gagal')
                    ->where('kode_kelompok', $kode_kelompok)->sum('total');
            } else if ($jenis_dokumen == 'operasional') {
                $operasional = Pengeluaran::where('kategori', 'Operasional')
                    ->where('tgl_pengeluaran', '>=', $dari)
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)
                    ->orderBy('tgl_pengeluaran', 'desc')->get();

                $iklan = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Operasional')
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('biaya_iklan');
                $pajak = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Operasional')
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('pajak_iklan');
                $total = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Operasional')
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('total');
            } else if ($jenis_dokumen == 'iklan') {
                $iklan1 = Pengeluaran::where('kategori', 'Iklan')
                    ->where('tgl_pengeluaran', '>=', $dari)
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)
                    ->orderBy('tgl_pengeluaran', 'desc')->get();

                $iklan = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Iklan')
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('biaya_iklan');
                $pajak = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Iklan')
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('pajak_iklan');
                $total = Pengeluaran::where('tgl_pengeluaran', '>=', $dari)
                    ->where('kategori', 'Iklan')
                    ->where('tgl_pengeluaran', '<=', $sampai)
                    ->where('kode_kelompok', $kode_kelompok)->sum('total');
            }
        }

        if ($jenis_dokumen == 'penjualan') {
            return view('admin.cetak.cetak_penjualan', compact('penjualan', 'kas_masuk', 'kas_keluar', 'total'));
        } else if ($jenis_dokumen == 'lunas') {
            return view('admin.cetak.cetak_lunas', compact('lunas', 'kas_masuk', 'kas_keluar', 'total'));
        } else if ($jenis_dokumen == 'belum') {
            return view('admin.cetak.cetak_belum', compact('belum', 'kas_masuk', 'kas_keluar', 'total'));
        } else if ($jenis_dokumen == 'sampai') {
            return view('admin.cetak.cetak_sampai', compact('sampai1', 'kas_masuk', 'kas_keluar', 'total'));
        } else if ($jenis_dokumen == 'gagal') {
            return view('admin.cetak.cetak_gagal', compact('gagal', 'kas_masuk', 'kas_keluar', 'total'));
        } else if ($jenis_dokumen == 'pengeluaran') {
            return view('admin.cetak.cetak_pengeluaran', compact('pengeluaran', 'iklan', 'pajak', 'total'));
        } else if ($jenis_dokumen == 'operasional') {
            return view('admin.cetak.cetak_operasional', compact('operasional', 'iklan', 'pajak', 'total'));
        } else if ($jenis_dokumen == 'iklan') {
            return view('admin.cetak.cetak_iklan', compact('iklan1', 'iklan', 'pajak', 'total'));
        }
    }
}
