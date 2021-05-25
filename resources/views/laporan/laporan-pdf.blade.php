<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico' )}}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SiMUDAH | Laporan Pelatih</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body onload="window.print();">
    <div class="container-fluid">
        <center><img src="{{ asset('/assets/img/logolaporan.png')}}" alt="laporan" width="370px"></center>
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
                @foreach ($query as $laporan)
                <tr>
                    <td style="width: 30px; text-align: center">{{ $loop->iteration }}</td>
                    <td>{{ $laporan->nama_ukm }}</td>
                    <td>{{ $laporan->nama }}</td>
                    <td>{{ $laporan->jumlah_absensi }}</td>
                    <td>
                        @php
                            $latihan = App\Absensi::where('ukm_id', $laporan->ukm_id)->count();
                        @endphp
                        {{ $latihan }}
                    </td>
                    <td>
                    @php
                        $persen = ($laporan->jumlah_absensi / $latihan) * 100
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
            <br> Wakil Rektor II
=======
            <br> Wakil Ketua II
>>>>>>> leonica
            <br><br><br><br>
            <p>Kathryn Sugara, S.E., M.Si, CFP®</p>
        </div>
    </div>
</body>
</html>
