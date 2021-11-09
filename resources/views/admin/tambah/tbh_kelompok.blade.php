@extends('layout.main')

@section('kelompok', 'nav-item active')

@section('kelompok', 'Tambah Laporan')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">
                @if (session('sukses_kel'))
                    <div class="alert alert-success">
                        {{ session('sukses_kel') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <strong class="card-title">Buat Kelompok</strong>
                        <p class="card-category"><i>Masukkan Data Dengan Benar</i></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('regist') }}">
                            @csrf
                            <div class=" row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nama Kelompok</label>
                                        <input type="text" name="nama_kelompok"
                                            class="form-control @error('nama_kelompok') is-invalid @enderror"
                                            value="{{ old('nama_kelompok') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Nama Kelompok Min 3 Karakter
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Kode Akses</label>
                                        <input type="text" name="kode_kelompok"
                                            class="form-control @error('kode_kelompok') is-invalid @enderror"
                                            value="{{ old('kode_kelompok') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Kode Kelompok Min 4 Karakter
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Password Kelompok</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="mybutton" onclick="change()">
                                                    <i class="menu-icon fa fa-eye-slash"></i>
                                                </span>
                                            </div>
                                            <input type="password" name="password" id="pass"
                                                class="form-control @error('password') is-invalid @enderror"
                                                value="{{ old('password') }}">
                                            <div class="invalid-feedback">
                                                Harap Mengisi Password Kelompok Min 4 Karakter
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right tbhK">Tambah</button>
                                <a href="{{ url('kelompok') }}" class="btn btn-danger pull-right">Kembali</a>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('password')
    <script type="text/javascript">
        function change() {
            var x = document.getElementById('pass').type;

            if (x == 'password') {
                document.getElementById('pass').type = 'text';
                document.getElementById('mybutton').innerHTML = '<i class="menu-icon fa fa-eye"></i>';
            } else {
                document.getElementById('pass').type = 'password';
                document.getElementById('mybutton').innerHTML = '<i class="menu-icon fa fa-eye-slash"></i>';
            }
        }

    </script>
@endsection
