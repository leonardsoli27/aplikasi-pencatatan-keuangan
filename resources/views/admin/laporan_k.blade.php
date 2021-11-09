@extends('layout.main')

@section('laporan_k', 'nav-item active')

@section('judul', 'Laporan Pengeluaran')

@section('content')

    <style>
        div.dataTables_wrapper {
            width: 910px;
            margin: 0 auto;
        }

    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <strong class="card-title">Laporan Pengeluaran</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/pengeluaran/cetak') }}" method="GET">
                            @csrf
                            <input type="hidden" name="kode_kelompok" value="{{ auth()->user()->kode_kelompok }}">
                            <div class="form-group">
                                <label for="jenis_pembayaran">Kategori Pengeluaran</label>
                                <select class="form-control @error('kategori') is-invalid @enderror" id="kategori"
                                    name="kategori">
                                    <option value="">Pilih Kategori</option>
                                    @if (auth()->user()->kode_kelompok == 'admin')
                                        <option value="Operasional">Operasional</option>
                                    @endif
                                    <option value="Iklan">Biaya Iklan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harap Mamilih Satu Kategori
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label>Dari Tanggal</label>
                                        <input type="date" class="form-control @error('tgl_awal') is-invalid @enderror"
                                            id="tgl_awal" name="tgl_awal">
                                        <div class="invalid-feedback">
                                            Harap Mamilih Tanggal Awal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label>Sampai Tanggal</label>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Table Filter Pengeluaran</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-keluar" class="table table-striped table-bordered display nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tanggal Pengeluaran</th>
                                        <th>Keterangan</th>
                                        <th>Kategori</th>
                                        <th>Biaya Iklan</th>
                                        <th>Pajak Iklan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periode_keluar as $periode_keluar)
                                        <tr>
                                            <td>{{ date('d F Y', strtotime($periode_keluar->tgl_pengeluaran)) }}</td>
                                            <td>{{ $periode_keluar->keterangan }}</td>
                                            <td>{{ $periode_keluar->kategori }}</td>
                                            <td>{{ number_format($periode_keluar->biaya_iklan) }}</td>
                                            <td>{{ number_format($periode_keluar->pajak_iklan) }}</td>
                                            <td>{{ number_format($periode_keluar->total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th>{{ number_format($iklan) }}</th>
                                    <th>{{ number_format($pajak) }}</th>
                                    <th>{{ number_format($total) }}</th>
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
        $('#table-keluar').DataTable({
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
