@extends('layout.main')

@section('cod_gagal', 'nav-item active')

@section('judul', 'Daftar Pendapatan COD')

@section('content')

    <style>
        div.dataTables_wrapper {
            width: 910px;
            margin: 0 auto;
        }

    </style>

    <div class="row">
        <div class="col-lg">
            @if (session('sukses_m'))
                <div class="alert alert-success">
                    {{ session('sukses_m') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            @if (session('update_m'))
                <div class="alert alert-success">
                    {{ session('update_m') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Daftar COD Gagal</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>Tanggal Masuk</th>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cod as $cod)
                                    <tr>
                                        <td>{{ date('d F Y', strtotime($cod->tgl_masuk)) }}</td>
                                        <td>{{ $cod->suplier }}</td>
                                        <td>{{ $cod->nama_pembeli }}</td>
                                        <td>{{ $cod->nama_produk }}</td>
                                        <td>{{ number_format($cod->jml_produk) }}</td>
                                        <td>{{ number_format($cod->kas_masuk) }}</td>
                                        <td>{{ number_format($cod->kas_keluar) }}</td>
                                        <td>{{ number_format($cod->total) }}</td>
                                        <td>{{ $cod->jenis_pembayaran }}</td>
                                        <td>{{ $cod->status }}</td>
                                        <td>{{ $cod->no_resi }}</td>
                                        <td>{{ $cod->no_pesanan }}</td>
                                        <td>{{ $cod->akun_shopee }}</td>
                                        <td><a href="/pendapatan/edit/{{ $cod->id }}" class="btn btn-success editK"
                                                kode_kelompok="{{ $cod->kode_kelompok }}">
                                                <i class="menu-icon fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger del_m" id_m="{{ $cod->id }}">
                                                <i class="menu-icon fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sweetalert')
    <script type="text/javascript">
        $('.del_m').click(function() {
            var id = $(this).attr('id_m')
            swal({
                    title: "Anda Yakin?",
                    text: "Menghapus Data Pemasukkan Ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Sukses! Data Berhasil Di Hapus!", {
                            icon: "success",
                        });
                        window.location = "/pendapatan/delete/" + id + "";
                    } else {
                        swal("Data Batal Di Hapus!");
                    }
                });
        });

    </script>
@endsection

@section('table')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table').DataTable({
                lengthMenu: [
                    [10, 20, 50, -1],
                    [10, 20, 50, "All"]
                ],
                scrollY: true,
                scrollX: true,
                responsive: true
            });
        });

    </script>
@endsection
