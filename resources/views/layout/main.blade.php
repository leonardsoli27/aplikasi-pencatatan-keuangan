<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Oofy Corp Surabaya</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('images/logo_icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo_icon.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">

    {{-- css toastr --}}
    <link href=".https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="@yield('dashboard')">
                        <a href="{{ url('/dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    @if (auth()->user()->kode_kelompok == 'admin')
                    <li class="menu-title">Pegawai</li><!-- /.menu-title -->
                    <li class="@yield('karyawan')">
                        <a href="{{ url('karyawan') }}"> <i class="menu-icon fa fa-user"></i>Daftar Pegawai </a>
                    </li>
                    <li class="@yield('kelompok')">
                        <a href="{{ url('kelompok') }}"> <i class="menu-icon fa fa-users"></i>Daftar Kelompok </a>
                    </li>
                    @endif

                    <li class="menu-title">Kas Masuk</li><!-- /.menu-title -->
                    <li class="@yield('laporan_m')">
                        <a href="{{ url('laporan_m') }}"> <i class="menu-icon fa fa-file-text-o"></i>Laporan
                            Pendapatan</a>
                    </li>
                    <li class="menu-item-has-children dropdown @yield('cod') @yield('cod_gagal') @yield('cod_sampai')">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="menu-icon fa fa-handshake-o"></i>Daftar COD</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-clock-o"></i>
                                <a href="{{ url('cod') }}"> COD Belum</a>
                            </li>
                            <li><i class="menu-icon fa fa-check"></i>
                                <a href="{{ url('/cod/cod_sampai') }}"> COD
                                    Sampai</a>
                            </li>
                            <li><i class="menu-icon fa fa-times"></i>
                                <a href="{{ url('/cod/cod_gagal') }}"> COD Gagal</a>
                            </li>
                        </ul>
                        {{--  --}}
                    </li>
                    <li class="@yield('pendapatan')">
                        <a href="{{ url('pendapatan') }}"> <i class="menu-icon fa fa-credit-card"></i>Daftar
                            Pendapatan</a>
                    </li>

                    <li class="menu-title">Kas Keluar</li><!-- /.menu-title -->
                    <li class="@yield('laporan_k')">
                        <a href="{{ url('laporan_k') }}"> <i class="menu-icon fa fa-print"></i>Laporan
                            Pengeluaran</a>
                    </li>
                    <li class="@yield('pengeluaran')">
                        <a href="{{ url('pengeluaran') }}"> <i class="menu-icon  fa fa-money"></i>
                            Biaya Iklan</a>
                    </li>
                    @if (auth()->user()->kode_kelompok == 'admin')
                    <li class="@yield('operasional')">
                        <a href="{{ url('operasional') }}"> <i class="menu-icon  fa fa-cog"></i>
                            Biaya Operasional</a>
                    </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo_icon.png') }}"
                            alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-users"></i>
                        </a>

                        <div class="user-menu dropdown-menu">
                            @if (auth()->user()->kode_kelompok != 'admin')
                            <a class="nav-link" href="/edit/{{ auth()->user()->kode_kelompok }}">
                                <i class="fa fa-user"></i>My Profile</a>
                            @endif
                            <a class="nav-link logout" href="#"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <div class="animated fadeIn">
                @yield('content')
            </div>
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear())

                        </script>, Oofy Corp Surabaya
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://www.instagram.com/leonard_soli/">BlackScreen</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="{{ asset('assets/js/init/weather-init.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/init/datatables-init.js') }}"></script>
    <script src="{{ asset('assets/js/init/chartjs-init.js') }}"></script>

    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!--Local Stuff-->

    <script type="text/javascript">
        $('.logout').click(function () {
            var id = $(this).attr('id_k')
            swal({
                    title: "Anda Yakin?",
                    text: "Ingin Keluar Dari Halaman Website!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/logout";
                    } else {
                        swal("Batal Logout :)");
                    }
                });
        });

    </script>

    @yield('sweetalert')
    @yield('password')
    @yield('chart')
    @yield('table')
    @yield('hitung')

</body>

</html>
