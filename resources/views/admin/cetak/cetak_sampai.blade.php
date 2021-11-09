<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Cetak Dokumen</title>
    <style>
        h4 {
            margin-top: 30px;
        }

        a {
            margin-left: 10px;
        }

    </style>
</head>


<body>
    <a href="{{ url('/dashboard') }}">Back</a>
    <h4 class="text-center">Dokumen Oofy Corp Surabaya</h4>
    <p class="text-center">Rincian Laporan Pendapatan dan COD Oofy Corp Surabaya</p>

    <table class="table table-bordered">
        <thead>
            <tr class="table-success">
                <td>Tanggal Pemasukkan</td>
                <td>Nama Supplier</td>
                <td>Nama Pembeli</td>
                <td>Nama Produk</td>
                <td>Jumah Produk</td>
                <td>Kas Masuk</td>
                <td>Kas Keluar</td>
                <td>Total</td>
                <td>Jenis Pembayaran</td>
                <td>Status</td>
                <td>No Resi</td>
                <td>No Pesanan</td>
                <td>Akun Shopee</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($sampai1 as $satu)
                <tr>
                    <td>{{ date('d F Y', strtotime($satu->tgl_masuk)) }}</td>
                    <td>{{ $satu->suplier }}</td>
                    <td>{{ $satu->nama_pembeli }}</td>
                    <td>{{ $satu->nama_produk }}</td>
                    <td>{{ number_format($satu->jml_produk) }}</td>
                    <td>{{ number_format($satu->kas_masuk) }}</td>
                    <td>{{ number_format($satu->kas_keluar) }}</td>
                    <td>{{ number_format($satu->total) }}</td>
                    <td>{{ $satu->jenis_pembayaran }}</td>
                    <td>{{ $satu->status }}</td>
                    <td>{{ $satu->no_resi }}</td>
                    <td>{{ $satu->no_pesanan }}</td>
                    <td>{{ $satu->akun_shopee }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <th colspan="5">Total</th>
            <th>{{ number_format($kas_masuk) }}</th>
            <th>{{ number_format($kas_keluar) }}</th>
            <th>{{ number_format($total) }}</th>
            <th colspan="5"></th>
        </tfoot>
    </table>


    <script type="text/javascript">
        window.print();

    </script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
</body>

</html>
