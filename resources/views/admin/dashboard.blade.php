@extends('layout.main')

@section('dashboard', 'nav-item active')

@section('judul', 'Dashboard')

@section('content')

    <!-- Widgets  -->
    <div class="row">
        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-1">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
                        <h4 class="mb-0 fw-r"><b>
                                <span class=" float-left mr-1">Rp</span>
                                {{ number_format($kas_masuk, 0) }}</b>
                            <br>
                        </h4>
                        <p class="text-light mt-1 m-0">Uang Masuk</p>
                    </div><!-- /.card-left -->

                    <div class="card-right float-right text-right">
                        <i class="icon fade-5 icon-lg fa fa-dollar"></i>
                    </div><!-- /.card-right -->

                </div>

            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
                        <h4 class="mb-0 fw-r"><b>
                                <span class=" float-left mr-1">Rp</span>
                                {{ number_format($kas_keluar, 0) }}</b>
                            <br>
                        </h4>
                        <p class="text-light mt-1 m-0">Uang Keluar</p>
                    </div><!-- /.card-left -->

                    <div class="card-right float-right text-right">
                        <i class="icon fade-5 icon-lg fa fa-shopping-cart"></i>
                    </div><!-- /.card-right -->

                </div>

            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-3">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
                        <h4 class="mb-0 fw-r">
                            <b>
                                <span class="currency float-left mr-1">Rp</span>
                                {{ number_format($total, 0) }}
                            </b>
                        </h4>
                        <p class="text-light mt-1 m-0">Pendapatan</p>
                    </div><!-- /.card-left -->

                    <div class="card-right float-right text-right">
                        <i class="icon fade-5 icon-lg fa fa-money"></i>
                    </div><!-- /.card-right -->

                </div>

            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
                        <h4 class="mb-0 fw-r">
                            <b>
                                <span class="currency float-left mr-1">Rp</span>
                                {{ number_format($belum, 0) }}
                            </b>
                        </h4>
                        <p class="text-light mt-1 m-0">COD Belum</p>
                    </div><!-- /.card-left -->

                    <div class="card-right float-right text-right">
                        <i class="icon fade-5 icon-lg fa fa-truck"></i>
                    </div><!-- /.card-right -->

                </div>

            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
                        <h4 class="mb-0 fw-r">
                            <b>
                                <span class="currency float-left mr-1">Rp</span>
                                {{ number_format($sampai, 0) }}
                            </b>
                        </h4>
                        <p class="text-light mt-1 m-0">COD Sampai</p>
                    </div><!-- /.card-left -->

                    <div class="card-right float-right text-right">
                        <i class="icon fade-5 icon-lg fa fa-handshake-o"></i>
                    </div><!-- /.card-right -->

                </div>

            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-6">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
                        <h4 class="mb-0 fw-r">
                            <b>
                                <span class="currency float-left mr-1">Rp</span>
                                {{ number_format($gagal, 0) }}
                            </b>
                        </h4>
                        <p class="text-light mt-1 m-0">COD Gagal</p>
                    </div><!-- /.card-left -->

                    <div class="card-right float-right text-right">
                        <i class="icon fade-5 icon-lg fa fa-times"></i>
                    </div><!-- /.card-right -->

                </div>

            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
                        <h4 class="mb-0 fw-r">
                            <b>
                                <span class="currency float-left mr-1">Rp</span>
                                {{ number_format($pengeluaran, 0) }}
                            </b>
                        </h4>
                        <p class="text-light mt-1 m-0">Biaya Iklan</p>
                    </div><!-- /.card-left -->

                    <div class="card-right float-right text-right">
                        <i class="icon fade-5 icon-lg fa fa-sign-out"></i>
                    </div><!-- /.card-right -->

                </div>

            </div>
        </div>

        @if (auth()->user()->kode_kelompok == 'admin')
            <div class="col-sm-6 col-lg-4">
                <div class="card text-white" style="background-color: #e67e22">
                    <div class="card-body">
                        <div class="card-left pt-1 float-left">
                            <h4 class="mb-0 fw-r">
                                <b>
                                    <span class="currency float-left mr-1">Rp</span>
                                    {{ number_format($operasional, 0) }}
                                </b>
                            </h4>
                            <p class="text-light mt-1 m-0">Biaya Operasional</p>
                        </div><!-- /.card-left -->

                        <div class="card-right float-right text-right">
                            <i class="icon fade-5 icon-lg fa fa-cog"></i>
                        </div><!-- /.card-right -->
                    </div>

                </div>
            </div>
        @endif


    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10">
                            <h4 class="mb-3">Grafik Keuangan Per Tahun <i>(Rp)</i></h4>
                        </div>
                        <div class="col-lg-2">
                            <button href="#" class="btn btn-sm btn-outline-success" data-toggle="modal"
                                data-target="#cetakPDF"><i class="fa fa-file-pdf-o"></i> Cetak
                                PDF</button>
                        </div>
                    </div>
                    <canvas id="team-chart"></canvas>
                </div>
            </div>
        </div><!-- /# column -->

    </div>

    <div class="clearfix"></div>

    <!-- Modal -->
    <div class="modal fade" id="cetakPDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan PDF</h5>
                </div>
                <form action="{{ url('/dashboard/cetak') }}" method="GET">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="kode_kelompok" value="{{ auth()->user()->kode_kelompok }}">
                        <div class="row">
                            <div class="form-group col-lg">
                                <label for="jenis_dokumen">Pilih Dokumen</label>
                                <select id="jenis_dokumen" name="jenis_dokumen" class="form-control">
                                    <option selected>-- Pilih --</option>
                                    <option value="penjualan">Semua Dokumen Penjualan</option>
                                    <option value="lunas">Dokumen Pendapatan</option>
                                    <option value="belum">Dokumen COD Belum</option>
                                    <option value="sampai">Dokumen COD Sampai</option>
                                    <option value="gagal">Dokumen COD Gagal</option>
                                    @if (auth()->user()->kode_kelompok == 'admin')
                                        <option value="operasional">Dokumen Biaya Operasional</option>
                                    @endif
                                    <option value="iklan">Dokumen Biaya Iklan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <label for="tgl_awal">Dari</label>
                                <input type="date" class="form-control" name="tgl_awal" id="tgl_awal">
                            </div>
                            <div class="col-lg">
                                <label for="tgl_akhir">Sampai</label>
                                <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-target="_blank">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('chart')
    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/init/chartjs-init.js"></script>
    <!--Flot Chart-->
    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>
@endsection
