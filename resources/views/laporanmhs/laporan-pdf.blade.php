<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SiMUDAH | Laporan Mahasiswa</title>

<<<<<<< HEAD
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body onload="window.print();">
    <div class="container-fluid">

        <center><img src="{{ asset('/assets/img/logolaporan.png')}}" alt="laporan" width="370px"></center>
        <h2 class=""><center>
            LAPORAN KEHADIRAN MAHASISWA
            <br>
            {{ $query2->nama_ukm }}
            <br>
            Bulan {{ $bulan }} Tahun {{ $tahun }}
        </center></h2>
        
        <p>
        Total Latihan : {{ $query2->jumlah_latihan }} kali
        </p>
        
        <table class="table">  
            <thead>
                <tr>
                    <th style="width: 30px">No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jumlah Kehadiran</th>
                    <th>Persentase Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($query as $laporan)
                <tr>
                    <td style="width: 30px; text-align: center">{{ $loop->iteration }}</td>
                    <td>{{ $laporan->nama_anggota }}</td>
                    <td>{{ $laporan->jumlah_absensi }}</td>
                    <td>
                    @php
                        $persen = ($laporan->jumlah_absensi / $query2->jumlah_latihan) * 100
                    @endphp
                    {{$persen}}%
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
        <div style="text-align: right;">
            Palembang, {{ date('d-m-Y') }}
<<<<<<< HEAD
            <br> Wakil Rektor III
=======
            <br> Wakil Ketua III
>>>>>>> leonica
            <br><br><br><br>
            <p>Dedy Hermanto, S.Kom, M.T.I</p>
        </div>
    
    </div>
</body>
</html>