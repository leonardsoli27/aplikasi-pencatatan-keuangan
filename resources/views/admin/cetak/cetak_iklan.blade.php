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
    <h4 class="text-center">Oofy Corp Surabaya</h4>
    <p class="text-center">Rincian Laporan Pengeluaran Oofy Corp Surabaya</p>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr class="table-success">
                    <th>Tanggal Pengeluaran</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    <th>Biaya Iklan</th>
                    <th>Pajak Iklan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($iklan1 as $satu)
                    <tr>
                        <td>{{ date('d F Y', strtotime($satu->tgl_pengeluaran)) }}</td>
                        <td>{{ $satu->keterangan }}</td>
                        <td>{{ $satu->kategori }}</td>
                        <td>{{ number_format($satu->biaya_iklan) }}</td>
                        <td>{{ number_format($satu->pajak_iklan) }}</td>
                        <td>{{ number_format($satu->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <th></th>
                <th></th>
                <th>Total</th>
                <th>{{ number_format($iklan) }}</th>
                <th>{{ number_format($pajak) }}</th>
                <th>{{ number_format($total) }}</th>
            </tfoot>
        </table>
    </div>

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
