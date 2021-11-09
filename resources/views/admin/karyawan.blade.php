@extends('layout.main')

@section('karyawan', 'nav-item active')

@section('judul', 'Daftar Karyawan')

@section('content')

    <style>
        div.dataTables_wrapper {
            width: 910px;
            margin: 0 auto;
        }

    </style>
    <div class="row">
        <div class="col-md">
            <a href="{{ url('tbh_karyawan') }}"><button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal">
                    <i class="menu-icon fa fa-edit"></i> Tambah Karyawan
                </button>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg">
            @if (session('sukses_kar'))
                <div class="alert alert-success">
                    {{ session('sukses_kar') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            @if (session('update_kar'))
                <div class="alert alert-success">
                    {{ session('update_kar') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Daftar Karyawan</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-karyawan" class="table table-hover display nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Nama Kelompok</th>
                                    <th scope="col">No Handphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawan as $kar)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $kar->nama_karyawan }}</td>
                                        <td>{{ $kar->nama_kelompok }}</td>
                                        <td>{{ $kar->no_hp }}</td>
                                        <td>{{ $kar->email }}</td>
                                        <td>
                                            <a href="/karyawan/edit/{{ $kar->id }}" class="btn btn-success">
                                                <i class="menu-icon fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger delKar"
                                                nama_karyawan="{{ $kar->nama_karyawan }}" id_kar="{{ $kar->id }}">
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
        $('.delKar').click(function() {
            var nama_karyawan = $(this).attr('nama_karyawan');
            var id = $(this).attr('id_kar')
            swal({
                    title: "Anda Yakin?",
                    text: "Menghapus karyawan dengan nama " + nama_karyawan + "!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Sukses! Karyawan Berhasil Di Hapus!", {
                            icon: "success",
                        });
                        window.location = "/delete_kar/" + id + "";
                    } else {
                        swal("Karyawan Batal Di Hapus!");
                    }
                });
        });

    </script>
@endsection

@section('table')
    <script type="text/javascript">
        $('#table-karyawan').DataTable({
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
