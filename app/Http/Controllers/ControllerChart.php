<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class ControllerChart extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chart()
    {
        $kelompok = auth()->user()->kode_kelompok;
        if ($kelompok == 'admin') {
            $bulan_array = array();
            $pendapatan = Pendapatan::orderBy('tgl_masuk', 'ASC')->pluck('tgl_masuk');
            $pendapatan = json_decode($pendapatan);

            if (!empty($pendapatan)) {
                foreach ($pendapatan as $format_bln) {
                    $date = new DateTime($format_bln);
                    $bulan_no = $date->format('m');
                    // $tahun = $date->format('Y');
                    $bulan_nama = $date->format('M');
                    $bulan_array[$bulan_no] = $bulan_nama;
                    // $thn_bln[] = $bulan_nama;
                }
            }
        } else {
            $bulan_array = array();
            $pendapatan = Pendapatan::orderBy('tgl_masuk', 'ASC')->where('kode_kelompok', $kelompok)->pluck('tgl_masuk');
            $pendapatan = json_decode($pendapatan);

            if (!empty($pendapatan)) {
                foreach ($pendapatan as $format_bln) {
                    $date = new DateTime($format_bln);
                    $bulan_no = $date->format('m');
                    $bulan_nama = $date->format('M');
                    $bulan_array[$bulan_no] = $bulan_nama;
                }
            }
        }

        // dd($thn_bln);
        return $bulan_array;
    }

    public function pendapatanBulanan($bulan)
    {
        $now = Carbon::now()->format('Y');
        $kelompok = auth()->user()->kode_kelompok;
        if ($kelompok == 'admin') {
            $jml_pendapatan = Pendapatan::whereMonth('tgl_masuk', $bulan)->whereYear('tgl_masuk', $now)->where('status', 'Lunas')->get()->sum('total');
            $jml_cod = Pendapatan::whereMonth('tgl_masuk', $bulan)->where('jenis_pembayaran', 'COD')->where('status', '!=', 'Lunas')->where('status', '!=', 'Gagal')->get()->sum('total');
        } else {
            $jml_pendapatan = Pendapatan::whereMonth('tgl_masuk', $bulan)->whereYear('tgl_masuk', $now)->where('status', 'Lunas')->where('kode_kelompok', $kelompok)->get()->sum('total');
            $jml_cod = Pendapatan::whereMonth('tgl_masuk', $bulan)->where('jenis_pembayaran', 'COD')->where('status', '!=', 'Lunas')->where('kode_kelompok', $kelompok)->get()->sum('total');
        }

        return ([$jml_pendapatan, $jml_cod]);
    }

    public function totalPendapatan()
    {
        $sum_pendapatan_array = array();
        $bulan_array = $this->chart();
        $bulan_nama = array();
        if (!empty($bulan_array)) {
            foreach ($bulan_array as $bulan_no => $bulan_nama) {
                $sum_pendapatan = $this->pendapatanBulanan($bulan_no);
                array_push($sum_pendapatan_array, $sum_pendapatan);
                array_push([$bulan_array, $bulan_nama]);
            }
        }
        $bulan_array = $this->chart();
        $sum_pendapatan_array = array(
            'bulan' => $bulan_array,
            'jumlah' => $sum_pendapatan_array
        );

        return $sum_pendapatan_array;
    }

    public function chartPengeluaran()
    {
        $kelompok = auth()->user()->kode_kelompok;
        if ($kelompok == 'admin') {
            $bulan_keluar_array = array();
            $pengeluaran = Pengeluaran::orderBy('tgl_pengeluaran', 'ASC')->pluck('tgl_pengeluaran');
            $pengeluaran = json_decode($pengeluaran);

            if (!empty($pengeluaran)) {
                foreach ($pengeluaran as $format_bln) {
                    $date = new DateTime($format_bln);
                    $bulan_no = $date->format('m');
                    $bulan_nama = $date->format('M');
                    $bulan_keluar_array[$bulan_no] = $bulan_nama;
                }
            }
        } else {
            $bulan_keluar_array = array();
            $pengeluaran = Pengeluaran::orderBy('tgl_pengeluaran', 'ASC')->where('kode_kelompok', $kelompok)->pluck('tgl_pengeluaran');
            $pengeluaran = json_decode($pengeluaran);

            if (!empty($pengeluaran)) {
                foreach ($pengeluaran as $format_bln) {
                    $date = new DateTime($format_bln);
                    $bulan_no = $date->format('m');
                    $bulan_nama = $date->format('M');
                    $bulan_keluar_array[$bulan_no] = $bulan_nama;
                }
            }
        }

        return $bulan_keluar_array;
    }

    public function pengeluaranBulanan($bulan)
    {
        $now = Carbon::now()->format('Y');
        $kelompok = auth()->user()->kode_kelompok;
        if ($kelompok == 'admin') {
            $jml_pengeluaran = Pengeluaran::whereMonth('tgl_pengeluaran', $bulan)->whereYear('tgl_pengeluaran', $now)->get()->sum('total');
            return $jml_pengeluaran;
        } else {
            $jml_pengeluaran = Pengeluaran::whereMonth('tgl_pengeluaran', $bulan)->where('kode_kelompok', $kelompok)->whereYear('tgl_pengeluaran', $now)->get()->sum('total');
            return $jml_pengeluaran;
        }
    }

    public function totalPengeluaran()
    {
        $sum_pengeluaran_array = array();
        $bulan_keluar_array = $this->chartPengeluaran();
        $bulan_nama = array();
        if (!empty($bulan_keluar_array)) {
            foreach ($bulan_keluar_array as $bulan_no => $bulan_nama) {
                $sum_pengeluaran = $this->pengeluaranBulanan($bulan_no);
                array_push($sum_pengeluaran_array, $sum_pengeluaran);
                array_push($bulan_keluar_array, $bulan_nama);
            }
        }
        $bulan_keluar_array = $this->chartPengeluaran();
        $sum_pengeluaran_array = array(
            'bulan' => $bulan_keluar_array,
            'jumlah' => $sum_pengeluaran_array
        );

        return $sum_pengeluaran_array;
    }

    public function chartFull()
    {
        $pendapatan = $this->totalPendapatan();
        $pengeluaran = $this->totalPengeluaran();

        $hasil = array(
            'pemasukkan' => $pendapatan,
            'pengeluaran' => $pengeluaran
        );

        return response()->json($hasil);
    }
}
