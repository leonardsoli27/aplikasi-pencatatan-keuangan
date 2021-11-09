@extends('layout.main')

@section('laporan_m', 'nav-item active')

@section('judul', 'Laporan Keuangan')

@section('content')

    <style>
        div.dataTables_wrapper {
            width: 910px;
            margin: 0 auto;
        }

    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <a href="{{ url('tbh_pendapatan') }}"><button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">
                        <i class="menu-icon fa fa-edit"></i> Tambah Penjualan
                    </button>
                </a>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <strong class="card-title">Laporan Pendapatan</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/pendapatan/cetak') }}" method="GET">
                            @csrf
                            <input type="hidden" name="kode_kelompok" value="{{ auth()->user()->kode_kelompok }}">
                            <div class="form-group">
                                <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                <select class="form-control @error('jenis_pembayaran') is-invalid @enderror"
                                    id="jenis_pembayaran" name="jenis_pembayaran">
                                    <option value="">Pilih Pembayaran</option>
                                    <option value="Semua">Semua Transaksi</option>
                                    <option value="Transfer">Transfer Bank</option>
                                    <option value="COD">COD</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harap Mamilih Satu Jenis Pembayaran
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_awal">Dari Tanggal</label>
                                        <input type="date" class="form-control @error('tgl_awal') is-invalid @enderror"
                                            id="tgl_awal" name="tgl_awal">
                                        <div class="invalid-feedback">
                                            Harap Mamilih Tanggal Awal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_akhir">Sampai Tanggal</label>
                                        <input type="date" class="form-control @error('tgl_akhir') is-invalid @enderror"
                                            id="tgl_akhir" name="tgl_akhir">
                                        <div class="invalid-feedback">
                                            Harap Mamilih Tanggal Akhir
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info"><i class="menu-icon fa fa-filter"></i>
                                Filter</button>
                            {{-- <a href="{{ url('/pendapatan/eksport') }}" class="btn btn-success">
                                <i class="menu-icon fa fa-copy"></i> Cetak Laporan
                            </a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Table Filter Pemasukkan</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-dapat" class="table table-striped table-bordered display nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tanggal Pemasukkan</th>
                                        <th>Nama Supplier</th>
                                        <th>Nama Pembeli</th>
                                        <th>Nama Produk</th>
                                        <th>Jumah Produk</th>
                                        <th>Kas Masuk</th>
                                        <th>Kas Keluar</th>
                                        <th>Total</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Status</th>
                                        <th>No Resi</th>
                                        <th>No Pesanan</th>
                                        <th>Akun Shopee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periode as $masuk)
                                        <tr>
                                            <td>{{ date('d F Y', strtotime($masuk->tgl_masuk)) }}</td>
                                            <td>{{ $masuk->suplier }}</td>
                                            <td>{{ $masuk->nama_pembeli }}</td>
                                            <td>{{ $masuk->nama_produk }}</td>
                                            <td>{{ number_format($masuk->jml_produk) }}</td>
                                            <td>{{ number_format($masuk->kas_masuk) }}</td>
                                            <td>{{ number_format($masuk->kas_keluar) }}</td>
                                            <td>{{ number_format($masuk->total) }}</td>
                                            <td>{{ $masuk->jenis_pembayaran }}</td>
                                            <td>{{ $masuk->status }}</td>
                                            <td>{{ $masuk->no_resi }}</td>
                                            <td>{{ $masuk->no_pesanan }}</td>
                                            <td>{{ $masuk->akun_shopee }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th>{{ number_format($kas_masuk) }}</th>
                                    <th>{{ number_format($kas_keluar) }}</th>
                                    <th>{{ number_format($total) }}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('table')
    <script type="text/javascript">
        $('#table-dapat').DataTable({
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            scrollY: true,
            scrollX: true,
            responsive: true
        });

    </script>
@endsection
