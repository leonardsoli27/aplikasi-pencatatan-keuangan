@extends('layout.main')

@section('pendapatan', 'nav-item active')

@section('judul', 'Daftar Pendapatan')

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
                    <strong class="card-title">Daftar Pemasukkan</strong>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendapatan as $dapat)
                                    <tr>
                                        <td>{{ date('d F Y', strtotime($dapat->tgl_masuk)) }}</td>
                                        <td>{{ $dapat->suplier }}</td>
                                        <td>{{ $dapat->nama_pembeli }}</td>
                                        <td>{{ $dapat->nama_produk }}</td>
                                        <td>{{ number_format($dapat->jml_produk) }}</td>
                                        <td>{{ number_format($dapat->kas_masuk) }}</td>
                                        <td>{{ number_format($dapat->kas_keluar) }}</td>
                                        <td>{{ number_format($dapat->total) }}</td>
                                        <td>{{ $dapat->jenis_pembayaran }}</td>
                                        <td>{{ $dapat->status }}</td>
                                        <td>{{ $dapat->no_resi }}</td>
                                        <td>{{ $dapat->no_pesanan }}</td>
                                        <td>{{ $dapat->akun_shopee }}</td>
                                        <td><a href="/pendapatan/edit/{{ $dapat->id }}" class="btn btn-success editK"
                                                kode_kelompok="{{ $dapat->kode_kelompok }}">
                                                <i class="menu-icon fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger del_m" id_m="{{ $dapat->id }}">
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
