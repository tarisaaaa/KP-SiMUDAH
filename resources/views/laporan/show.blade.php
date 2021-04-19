<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico' )}}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absensi</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <style>
        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <center><img src="{{ asset('assets/img/logolaporan.png')}}" alt="laporan" width="270px"></center>
        <h2 class="mt-3"><center>Laporan Kehadiran Pelatih</center></h2>
        <center><h5>Bulan {{ $bulan }} Tahun {{ $tahun }}</h5></center>
        <hr width="95%">
        <table class="table border ml-5" style="width: 93%">  
            <thead>
                <th>UKM</th>
                <th>Nama Pelatih</th>
                <th>Jumlah Kehadiran</th>
                <th>Total Latihan</th>
            </thead>
            <tbody>
                @foreach ($results as $laporan)
                <tr>
                    <td>{{ $laporan['nama_ukm'] }}</td>
                    <td>{{ $laporan['nama'] }}</td>
                    <td>{{ $laporan['jumlah_absensi'] }}</td>
                    <td>{{ $laporan['jumlah_latihan'] }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align: right; margin-right: 4%">
            Palembang, {{ date('d-m-Y') }}
            <br> Wakil Ketua II
            <br><br><br><br>
            <p>Kathryn Sugara, S.E., M.Si, CFP®</p>
        </div>

    </div>

        <a href="" id="printPageButton" class="btn btn-sm btn-outline-secondary ml-5" onclick="window.print();">
            <i class="nav-icon fas fa-print mr-2"></i>Cetak Laporan
        </a>

</body>
<footer>
    <p class="ml-5 mt-2"><i>Laporan ini dicetak pada {{ date('d-m-Y') }}</i></p>
</footer>
</html>