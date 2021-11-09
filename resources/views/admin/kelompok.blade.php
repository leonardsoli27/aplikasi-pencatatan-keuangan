@extends('layout.main')

@section('kelompok', 'nav-item active')

@section('judul', 'Daftar Karyawan')

@section('content')

    <div class="row">
        <div class="col-md">
            <a href="{{ url('tbh_kelompok') }}"><button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal">
                    <i class="menu-icon fa fa-edit"></i> Tambah Kelompok
                </button>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Daftar Kelompok</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-kelompok" class="table table-hover display nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kelompok</th>
                                    <th scope="col">Kode Akses</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelompok as $K)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $K->nama_kelompok }}</td>
                                        <td>{{ $K->kode_kelompok }}</td>
                                        <td>
                                            @if ($K->kode_kelompok != 'admin')
                                                <a href="/edit/{{ $K->kode_kelompok }}" class="btn btn-success editK"
                                                    kode_kelompok="{{ $K->kode_kelompok }}">
                                                    <i class="menu-icon fa fa-pencil"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger delK"
                                                    kode_kelompok="{{ $K->kode_kelompok }}">
                                                    <i class="menu-icon fa fa-trash"></i>
                                                </a>
                                            @endif
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
        $('.delK').click(function() {
            var kode_kelompok = $(this).attr('kode_kelompok');
            swal({
                    title: "Anda Yakin?",
                    text: "Menghapus kelompok dengan nama " + kode_kelompok + "!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/delete_Kl/" + kode_kelompok + "";
                        swal("Sukses! Kelompok Berhasil Di Hapus!", {
                            icon: "success",
                        });
                    } else {
                        swal("Kelompok Batal Di Hapus!");
                    }
                });
        });

    </script>
@endsection

@section('table')
    <script type="text/javascript">
        $('#table-kelompok').DataTable({
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
