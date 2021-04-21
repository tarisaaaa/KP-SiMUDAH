<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico' )}}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SiMUDAH | Laporan Pelatih</title>

    <style>
        table, td, th {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: darkgrey;
        }
        
        table {
            margin: auto;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        p {
            margin-left: 4%;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        {{-- <center><img src="{{ asset('/assets/img/logolaporan.png')}}" alt="laporan" width="270px"></center> --}}
        <h2><center>
            LAPORAN KEHADIRAN PELATIH
            <br>
            Bulan {{ $bulan }} Tahun {{ $tahun }}
        </center></h2>
        
        <br>
        <table class="table">  
            <thead>
                <tr>
                    <th style="width: 30px">No</th>
                    <th>UKM</th>
                    <th>Nama Pelatih</th>
                    <th>Jumlah Kehadiran</th>
                    <th>Total Latihan</th>
                    <th>Persentase Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $laporan)
                <tr>
                    <td style="width: 30px; text-align: center">{{ $loop->iteration }}</td>
                    <td>{{ $laporan['nama_ukm'] }}</td>
                    <td>{{ $laporan['nama'] }}</td>
                    <td>{{ $laporan['jumlah_absensi'] }}</td>
                    <td>{{ $laporan['jumlah_latihan'] }}</td>
                    <td>
                    @php
                        $persen = ($laporan['jumlah_absensi'] / $laporan['jumlah_latihan']) * 100
                    @endphp
                    {{$persen}}%
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align: right;">
            Palembang, {{ date('d-m-Y') }}
            <br> Wakil Ketua II
            <br><br><br><br>
            <p>Kathryn Sugara, S.E., M.Si, CFP®</p>
        </div>
    </div>
</body>
</html>
