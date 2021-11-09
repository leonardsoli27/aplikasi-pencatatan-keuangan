@extends('layout.main')

@section('judul', 'Tambah Laporan')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Edit Laporan</h4>
                        <p class="card-category">Masukkan Data Dengan Benar</p>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('update_pengeluaran', ['id' => $id_pengeluaran->id]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $id_pengeluaran->id }}">
                                <input type="hidden" name="kode_kelompok" value="{{ auth()->user()->kode_kelompok }}">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan"
                                            value="{{ $id_pengeluaran->keterangan }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Biaya Iklan</label>
                                        <input type="text" class="form-control" name="biaya_iklan" id="biaya_iklan"
                                            onclick="pajak()" value="{{ $id_pengeluaran->biaya_iklan }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Pajak</label>
                                        <input type="text" class="form-control" name="pajak_iklan" id="pajak_iklan"
                                            onchange="total()" value="{{ $id_pengeluaran->pajak_iklan }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Total</label>
                                        <input type="text" class="form-control" name="total" id="total"
                                            value="{{ $id_pengeluaran->total }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Tanggal Keluar</label>
                                        <input type="date" class="form-control" name="tgl_pengeluaran"
                                            value="{{ $id_pengeluaran->tgl_pengeluaran }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success pull-right">Edit</button>
                                <a href="{{ url('pengeluaran') }}" class="btn btn-danger pull-right">Kembali</a>
                            </div>
                            <div class="clearfix"></div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('hitung')

    <script type="text/javascript">
        function pajak() {
            $("#biaya_iklan, #pajak_iklan").keyup(function() {
                var iklan = $("#biaya_iklan").val();
                var pajak = $("#pajak_iklan").val();

                var pajak = parseInt(iklan) * 0.1;
                $("#pajak_iklan").val(pajak);

                var total = parseInt(iklan) + parseInt(pajak);
                $("#total").val(total);
            });
        }

    </script>

@endsection
