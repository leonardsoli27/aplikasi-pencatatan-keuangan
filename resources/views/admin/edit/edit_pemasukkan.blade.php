@extends('layout.main')

@section('laporan_m', 'nav-item active')

@section('judul', 'Tambah Laporan')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Edit Pemasukan</h4>
                        <p class="card-category">Masukkan Data Dengan Benar</p>
                    </div>
                    <div class="card-body">
                        @foreach ($id as $id)
                            <form method="POST" action="{{ route('update_pendapatan', ['id' => $id->id]) }}">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $id->id }}">
                                    <input type="hidden" name="kode_kelompok" value="{{ auth()->user()->kode_kelompok }}">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nama Supplier</label>
                                            <input type="text" class="form-control" name="suplier"
                                                value="{{ $id->suplier }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nama Pembeli</label>
                                            <input type="text" class="form-control" name="nama_pembeli"
                                                value="{{ $id->nama_pembeli }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nama Produk</label>
                                            <input type="text" class="form-control" name="nama_produk"
                                                value="{{ $id->nama_produk }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Jumlah Produk</label>
                                            <input type="text" class="form-control" name="jml_produk"
                                                value="{{ $id->jml_produk }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Uang Masuk</label>
                                            <input type="text" class="form-control" name="kas_masuk" id="kas_masuk"
                                                value="{{ $id->kas_masuk }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Uang Keluar</label>
                                            <input type="text" class="form-control" name="kas_keluar" id="kas_keluar"
                                                value=" {{ $id->kas_keluar }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Total Bayar</label>
                                            <input type="text" class="form-control" name="total" value="{{ $id->total }}"
                                                id="total" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Jenis Pembayaran</label>
                                            <select class="form-control" id="exampleFormControlSelect1"
                                                name="jenis_pembayaran">
                                                <option value="{{ $id->jenis_pembayaran }}">
                                                    {{ $id->jenis_pembayaran }}
                                                </option>
                                                <option value="Transfer">Transfer Bank</option>
                                                <option value="COD">COD</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if ($id->jenis_pembayaran == 'COD')
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="status">Status COD</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="{{ $id->status }}">
                                                        {{ $id->status }}
                                                    </option>
                                                    <option value="Lunas">COD Lunas</option>
                                                    <option value="Sampai">Sudah Sampai</option>
                                                    <option value="Belum Sampai">Belum Sampai</option>
                                                    <option value="Gagal">COD Gagal</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Akun Shopee</label>
                                            <input type="text"
                                                class="form-control @error('akun_shopee') is-invalid @enderror"
                                                name="akun_shopee" value="{{ $id->akun_shopee }}">
                                            <div class="invalid-feedback">
                                                Harap Mengisi Akun Shopee
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">No Pesanan</label>
                                            <input type="text"
                                                class="form-control @error('no_pesanan') is-invalid @enderror"
                                                name="no_pesanan" value="{{ $id->no_pesanan }}">
                                            <div class="invalid-feedback">
                                                Harap Memilih Tanggal Masuk
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">No Resi Pengiriman</label>
                                            <input type="text" class="form-control" name="no_resi"
                                                value="{{ $id->no_resi }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Tanggal Masuk</label>
                                            <input type="date" class="form-control" name="tgl_masuk"
                                                value="{{ $id->tgl_masuk }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success pull-right">Edit</button>
                                    <a href="@if ($id->jenis_pembayaran == 'COD') /cod
                                    @else /pendapatan @endif" class="btn btn-danger
                                        pull-right">Kembali</a>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('hitung')

    <script type="text/javascript">
        $('.card-body').delegate('#kas_masuk, #kas_keluar', 'keyup', function() {
            var baris = $(this).parent().parent().parent().parent();
            var kas_masuk = baris.find('#kas_masuk').val();
            var kas_keluar = baris.find('#kas_keluar').val();
            var total = (kas_masuk - kas_keluar);
            baris.find('#total').val(total);
        });

    </script>

@endsection
