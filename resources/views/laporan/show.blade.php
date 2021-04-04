<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico' )}}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absensi {{ $data->nama_ukm }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <center><img src="{{ asset('assets/img/icn.png')}}" alt="" ></center>
        <h2 class="mt-3"><center>Laporan Pelatih UKM {{ $data->nama_ukm }}</center></h2>
        <hr width="95%">
        <table class="table border ml-5" style="width: 93%">  
            <thead>
                <th>UKM</th>
                <th>Nama Pelatih</th>
                <th>Bulan/Tahun</th>
                <th>Jumlah Latihan</th>
            </thead>
            <tbody>
                <td>{{ $data->nama_ukm }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ date('m/Y') }}</td>
                <td>{{ $data->jumlah_absensi }}</td>
            </tbody>
        </table>
        <a href="" class="btn btn-sm btn-secondary ml-5"><i class="nav-icon fas fa-print mr-2"></i>Cetak Laporan</a>
    </div>
</body>
<footer>
    <p class="ml-5"><i>Laporan ini dicetak pada {{ date('d-m-Y') }}</i></p>
</footer>
</html>