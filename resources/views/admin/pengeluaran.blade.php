@extends('layout.main')

@section('pengeluaran', 'nav-item active')

@section('judul', 'Daftar Pendapatan')

@section('content')

    <div class="row">
        <div class="col-md">
            <a href="{{ url('tbh_pengeluaran') }}"><button type="button" class="btn btn-primary">
                    <i class="menu-icon fa fa-edit"></i> Tambah Biaya Iklan
                </button>
            </a>

        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg">
            @if (session('sukses_k'))
                <div class="alert alert-success">
                    {{ session('sukses_k') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            @if (session('update_k'))
                <div class="alert alert-success">
                    {{ session('update_k') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Daftar Pengeluaran Iklan</strong>
                </div>
                <div class="card-body">

                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tanggal Pengeluaran</th>
                                <th>Keterangan</th>
                                <th>Biaya Iklan</th>
                                <th>Pajak Iklan</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $keluar)
                                <tr>
                                    <td>{{ date('d F Y', strtotime($keluar->tgl_pengeluaran)) }}</td>
                                    <td>{{ $keluar->keterangan }}</td>
                                    <td>{{ number_format($keluar->biaya_iklan) }}</td>
                                    <td>{{ number_format($keluar->pajak_iklan) }}</td>
                                    <td>{{ number_format($keluar->total) }}</td>
                                    <td><a href="/pengeluaran/edit/{{ $keluar->id }}" class="btn btn-success editK">
                                            <i class="menu-icon fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger del_k" id_k="{{ $keluar->id }}">
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


@endsection

@section('sweetalert')
    <script type="text/javascript">
        $('.del_k').click(function() {
            var id = $(this).attr('id_k')
            swal({
                    title: "Anda Yakin?",
                    text: "Menghapus Data Pengeluaran Ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Sukses! Data Berhasil Di Hapus!", {
                            icon: "success",
                        });
                        window.location = "/pengeluaran/delete/" + id + "";
                    } else {
                        swal("Data Batal Di Hapus!");
                    }
                });
        });

    </script>
@endsection

@section('table')
    <script type="text/javascript">
        $('#table').DataTable({
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            scrollY: true,
            scrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    </script>

@endsection
