@extends('layout.main')

@section('operasional', 'nav-item active')

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
                        <form method="POST" action="{{ route('postOperasional') }}">
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
                                        <input type="text" class="form-control" name="kategori" value="Operasional"
                                            placeholder="Biaya Operasional" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Total</label>
                                        <input type="text" name="total"
                                            class="form-control @error('total') is-invalid @enderror" name="total"
                                            id="total" value="{{ old('total') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Total Pengeluaran
                                        </div>
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
                                <a href="{{ url('operasional') }}" class="btn btn-danger pull-right">Kembali</a>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
