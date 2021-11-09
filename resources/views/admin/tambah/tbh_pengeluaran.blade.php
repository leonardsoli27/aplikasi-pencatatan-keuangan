@extends('layout.main')

@section('pengeluaran', 'nav-item active')

@section('judul', 'Tambah Laporan')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <strong class="card-title">Buat Laporan</strong>
                        <p class="card-category"><i>Masukkan Data Dengan Benar</i></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('upload_pengeluaran') }}">
                            @csrf
                            <input type="hidden" name="kode_kelompok" value="{{ auth()->user()->kode_kelompok }}">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Keterangan</label>
                                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                            value="{{ old('keterangan') }}" name="keterangan">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Keterangan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="kategori">Kategori Pengeluaran</label>
                                        <input type="text" class="form-control" name="kategori" value="Iklan"
                                            placeholder="Biaya Iklan" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Biaya Iklan</label>
                                        <input type="text" class="form-control @error('biaya_iklan') is-invalid @enderror"
                                            name="biaya_iklan" id="biaya_iklan" value="{{ old('biaya_iklan') }}"
                                            onclick="pajak()">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Biaya Iklan
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Pajak Iklan <i>(10%)</i></label>
                                        <input type="text" class="form-control" name="pajak_iklan" id="pajak_iklan"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Total</label>
                                        <input type="text" class="form-control" name="total" id="total" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Tanggal Pengeluaran</label>
                                        <input type="date"
                                            class="form-control @error('tgl_pengeluaran') is-invalid @enderror"
                                            name="tgl_pengeluaran" value="{{ old('tgl_pengeluaran') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Tanggal Pengeluaran
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right">Tambah</button>
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
