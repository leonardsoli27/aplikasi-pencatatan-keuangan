@extends('layout.main')

@section('karyawan', 'nav-item active')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <strong class="card-title">Daftar Pegawai</strong>
                        <p class="card-category"><i>Masukkan Data Dengan Benar</i></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('postKaryawan') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nama Pegawai</label>
                                        <input type="text" name="nama_karyawan"
                                            class="form-control @error('nama_karyawan') is-invalid @enderror"
                                            value="{{ old('nama_karyawan') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Nama Karyawan Min 3 Karakter
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">No Handphone</label>
                                        <input type="text" name="no_hp"
                                            class="form-control @error('no_hp') is-invalid @enderror"
                                            value="{{ old('no_hp') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi No Hp Min 11 Karakter
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}">
                                        <div class="invalid-feedback">
                                            Harap Mengisi Email
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nama Kelompok</label>
                                        <select id="nama_kelompok" name="nama_kelompok"
                                            class="form-control @error('nama_kelompok') is-invalid @enderror">
                                            <option value="" selected>--Pilih Kelompok--</option>
                                            @foreach ($kelompok as $K)
                                                <option value="{{ $K->nama_kelompok }}">{{ $K->nama_kelompok }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap Memilik 1 Kelompok
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right">Tambah</button>
                                <a href="{{ url('karyawan') }}" class="btn btn-danger pull-right">Kembali</a>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
