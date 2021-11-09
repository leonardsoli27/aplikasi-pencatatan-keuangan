@extends('layout.main')

@section('content')
    <div class="container-fluid">
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
                                        <th scope="col">No Handphone</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan as $kar)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $kar->nama_karyawan }}</td>
                                            <td>{{ $kar->no_hp }}</td>
                                            <td>{{ $kar->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                @if (session('update_pas'))
                    <div class="alert alert-success">
                        {{ session('update_pas') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                @if (session('gagal'))
                    <div class="alert alert-danger">
                        {{ session('gagal') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Ganti Password</h4>
                        <p class="card-category">Masukkan Data Dengan Benar</p>
                    </div>
                    <div class="card-body">
                        @foreach ($kode_kelompok as $K)
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nama Kelompok</label>
                                        <input type="text" class="form-control" name="nama_kelompok" readonly
                                            value="{{ $K->nama_kelompok }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <form action="{{ route('ganti.pass') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md">
                                    <label class="bmd-label-floating">Password Lama</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="mybutton" onclick="change()">
                                                <i class="menu-icon fa fa-eye-slash"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="old_password" id="old_password"
                                            class="form-control @error('old_password') is-invalid @enderror">
                                        <div class="invalid-feedback">
                                            Password Tidak Sesuai
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label class="bmd-label-floating">Password Baru</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="mybutton2" onclick="change2()">
                                                <i class="menu-icon fa fa-eye-slash"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        <div class="invalid-feedback">
                                            Password Min 5 Karakter
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label class="bmd-label-floating">Konfirmasi Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="mybutton4" onclick="change4()">
                                                <i class="menu-icon fa fa-eye-slash"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror">
                                        <div class="invalid-feedback">
                                            Password Konfirmasi Tidak Sesuai
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success pull-right">Edit</button>
                                <a href="@if (auth()->user()->kode_kelompok == 'admin') /kelompok
                                @else /dashboard @endif" class="btn btn-danger">Kembali</a>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


