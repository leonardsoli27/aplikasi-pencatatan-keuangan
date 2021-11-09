@extends('layout.main')

@section('laporan_m', 'nav-item active')

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
                    <form method="POST" action="{{ route('upload_pendapatan') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="kode_kelompok" value="{{ auth()->user()->kode_kelompok }}">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nama Supplier</label>
                                        <input type="text" class="form-control @error('suplier') is-invalid @enderror"
                                            name="suplier" value="{{ old('suplier') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Nama Supplier Min 3 Karakter
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nama Pembeli</label>
                                        <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"
                                            name="nama_pembeli" value="{{ old('nama_pembeli') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Nama Min 3 Karakter
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <a href="#" class="tambah btn btn-success my-1 mb-2 ">
                                            <i class="menu-icon fa fa-plus"></i> Tambah Produk
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="baris">
                                <div class="form-row align-items-center">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="sr-only">Nama Produk</label>
                                            <input type="text"
                                                class="form-control @error('nama_produk') is-invalid @enderror"
                                                name="nama_produk[]" value="{{ old('nama_produk') }}"
                                                placeholder="Nama Produk">
                                            <div class="invalid-feedback">
                                                Harap Mengisi Nama Barang Min 3 Karakter
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="sr-only">Jumlah Produk</label>
                                            <input type="text"
                                                class="form-control @error('jml_produk') is-invalid @enderror"
                                                name="jml_produk[]" value="{{ old('jml_produk') }}"
                                                placeholder="Jumlah Produk">
                                            <div class="invalid-feedback">
                                                Harap Mengisi Jumlah Barang
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <a href="#" class="hapus btn btn-danger my-1 mb-2 ">
                                                <i class="menu-icon fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row align-items-center">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="sr-only">Uang Masuk</label>
                                            <input type="text" class="form-control @error('kas_masuk') is-invalid @enderror"
                                                id="kas_masuk" name="kas_masuk[]" value="{{ old('kas_masuk') }}"
                                                placeholder="Uang Masuk">
                                            <div class="invalid-feedback">
                                                Harap Mengisi Uang Masuk
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="sr-only">Uang Keluar</label>
                                            <input type="text"
                                                class="form-control @error('kas_keluar') is-invalid @enderror"
                                                id="kas_keluar" name="kas_keluar[]" placeholder="Uang Keluar"
                                                value="{{ old('kas_keluar') }}">
                                            <div class="invalid-feedback">
                                                Harap Mengisi Uang Keluar
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label class="sr-only">Laba</label>
                                            <input type="text" class="form-control" name="total[]" id="total" readonly
                                                placeholder="Laba">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tambah-barang"></div>

                            <hr>

                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                        <select class="form-control @error('jenis_pembayaran') is-invalid @enderror"
                                            id="jenis_pembayaran" name="jenis_pembayaran">
                                            <option value="">Pilih Pembayaran</option>
                                            <option value="Transfer">Transfer Bank</option>
                                            <option value="COD">COD</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap Mamilih Satu Jenis Pembayaran
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Akun Shopee</label>
                                        <input type="text" class="form-control @error('akun_shopee') is-invalid @enderror"
                                            name="akun_shopee" value="{{ old('akun_shopee') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Akun Shopee
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">No Pesanan</label>
                                        <input type="text" class="form-control @error('no_pesanan') is-invalid @enderror"
                                            name="no_pesanan" value="{{ old('no_pesanan') }}">
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
                                        <input type="text" class="form-control @error('no_resi') is-invalid @enderror"
                                            name="no_resi" value="{{ old('no_resi') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi No Resi Pengiriman
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Tanggal Masuk</label>
                                        <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"
                                            name="tgl_masuk" value="{{ old('tgl_masuk') }}">
                                        <div class="invalid-feedback">
                                            Harap Memilih Tanggal Masuk
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right tambah">Tambah</button>
                                <a href="{{ url('laporan_m') }}" class="btn btn-danger pull-right">Kembali</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('table')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

    <script type="text/javascript">
        $('.card-body').delegate('#kas_masuk, #kas_keluar', 'keyup', function() {
            var baris = $(this).parent().parent().parent().parent();
            var kas_masuk = baris.find('#kas_masuk').val();
            var kas_keluar = baris.find('#kas_keluar').val();
            var total = (kas_masuk - kas_keluar);
            baris.find('#total').val(total);
        });

        $('.tambah').on('click', function() {
            tambah();
        });

        function tambah() {
            var barang = '<div class="baris">' + '<hr>' +
                '<div class="form-row align-items-center">' +
                '<div class="col-md">' +
                '<div class="form-group">' +
                '<label class="sr-only">Nama Produk</label>' +
                '<input type="text" class="form-control @error('
            nama_produk ') is-invalid @enderror"' +
                'name="nama_produk[]" value="{{ old('nama_produk') }}" placeholder="Nama Produk">' +
                '<div class="invalid-feedback">' +
                'Harap Mengisi Nama Barang Min 3 Karakter' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md">' +
                '<div class="form-group">' +
                '<label class="sr-only">Jumlah Produk</label>' +
                '<input type="text" class="form-control @error('
            jml_produk ') is-invalid @enderror"' +
                'name="jml_produk[]" value="{{ old('jml_produk') }}" placeholder="Jumlah Produk">' +
                '<div class="invalid-feedback">' +
                'Harap Mengisi Jumlah Barang' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-auto">' +
                '<div class="form-group">' +
                '<a href="#" class="hapus btn btn-danger my-1 mb-2 ">' +
                '<i class="menu-icon fa fa-times"></i>' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>' +

                '<div class="form-row align-items-center">' +
                '<div class="col-md">' +
                '<div class="form-group">' +
                '<label class="sr-only">Uang Masuk</label>' +
                '<input type="text" class="form-control @error('
            kas_masuk ') is-invalid @enderror"' +
                'id="kas_masuk" name="kas_masuk[]" value="{{ old('kas_masuk') }}"' +
                'placeholder="Uang Masuk">' +
                '<div class="invalid-feedback">' +
                'Harap Mengisi Uang Masuk' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md">' +
                '<div class="form-group">' +
                '<label class="sr-only">Uang Keluar</label>' +
                '<input type="text" class="form-control @error('
            kas_keluar ') is-invalid @enderror"' +
                'id="kas_keluar" name="kas_keluar[]" placeholder="Uang Keluar"' +
                'value="{{ old('kas_keluar') }}">' +
                '<div class="invalid-feedback">' +
                ' Harap Mengisi Uang Keluar' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md">' +
                '<div class="form-group">' +
                '<label class="sr-only">Laba</label>' +
                '<input type="text" class="form-control" name="total[]" id="total" readonly placeholder="Laba">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
            $('.tambah-barang').append(barang);

        };

        $('.hapus').live('click', function() {

            // $(this).parent().parent().parent().parent().remove();
            var last = $('.baris').length;
            if (last == 1) {
                alert("Tidak Dapat Menghapus Kolom Terakhir")
            } else {
                $(this).parent().parent().parent().parent().remove();
            }

        });

    </script>
@endsection
