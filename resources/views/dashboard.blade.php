@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Selamat Datang')

@section('content')
    <div class="container">
        <h2>Selamat Datang, {{ session('user')->nama }}</h2>

        <div class="card m-5">
            <div class="row m-2">
                <div class="col-lg-6 m-2">
                    <h3><b>{{ session('user')->nama }}</b></h3>
                    <h6>
                        @if (session('user')->role == 'wk')
                            Wakil Rektor III
                        @elseif (session('user')->role == 'pelatih')
                            @if (!empty($namaukm))
                                Pelatih: 
                                {{ $namaukm->nama_ukm }}    
                            @else
                                Pelatih
                            @endif
                        @elseif (session('user')->role == 'pembina')
                            @if (!empty($namaukm))
                                Pembina: 
                                {{ $namaukm->nama_ukm }}      
                            @else
                                Pembina
                            @endif                        
                        @else
                            {{ session('user')->role }}     
                        @endif
                    </h6>
                    @if (!empty($profile->user_id))
                        {{-- <a href="{{ route('profile.edit',['profile' => $profile->id]) }}">Edit Profil</a> --}}
                        <a href="{{ route('profile.edit', session('user')->id) }}">Edit Profil</a>
                    @else
                        <a href="/profile/create">Edit Profil</a>
                        <br>
                        <small style="color: red">
                            Jika ingin mengubah username/password lengkapi data profil terlebih dahulu!
                        </small>
                    @endif
                    <hr>
                </div>

                <div class="col-lg-5 m-2">
                        <p><strong>Username :</strong> {{ session('user')->user_name }}</p>
                        <p><strong>Email :</strong> {{ session('user')->email }}</p>
                    @if (!empty($profile->user_id))
                        <p><strong>NIK/NPM :</strong> {{ $profile->niknpm }}</p>
                        <p><strong>Nomor HP :</strong> {{ $profile->nohp }}</p>
                        <p><strong>Alamat :</strong> {{ $profile->alamat }}</p>                  
                    @else
                        <p><strong>NIK/NPM :</strong> -</p>
                        <p><strong>Nomor HP :</strong> -</p>
                        <p><strong>Alamat :</strong> -</p>
                    @endif
                </div>
            </div>
        </div>

        @if (session('user')->role == 'pelatih')
            @if (!empty($jadwal->hari))
                <div class="card ml-5 mr-5">
                    <div class="row m-2">
                        <div class="col-lg-6 m-2" style="text-align: right">
                            <h5><strong>Jadwal</strong></h5>
                            <h6>{{ $namaukm->nama_ukm }}</h6>
                        </div>
                        <div class="col-lg-5 m-3">
                            <p>
                                <b>Hari:</b> {{ $jadwal->hari }}
                                <br>
                                <b>Jam:</b> {{ date('H.i', strtotime($jadwal->waktu_mulai)) }} - {{ date('H.i', strtotime($jadwal->waktu_selesai)) }} WIB
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            
        @endif

        @if (session('user')->role == 'wk' || session('user')->role == 'adminkeuangan' || session('user')->role == 'pembina' || session('user')->role == 'pelatih')

            <div>

                <div class="card ml-5 mr-5">
                    @if (session('user')->role == 'wk')
                        <div class="row">
                            <div class="col-lg-4 m-4">
                                <p>Lihat grafik per UKM/HMJ</p>
                                <div class="dropdown">
                                    <a class="btn btn-info dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pilih UKM/HMJ
                                    </a>
                                    
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @foreach ($graph as $ukm)
                                            <a class="dropdown-item" href="/grafik/{{ $ukm->ukm_id }}">{{ $ukm->nama_ukm }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card m-5">
                    <figure class="highcharts-figure">
                        <div id="grafik"></div>
                    </figure>
                </div>

            </div>
        
        @endif
        
    </div>
@endsection

@if (session('user')->role == 'wk' || session('user')->role == 'adminkeuangan' || session('user')->role == 'pembina' || session('user')->role == 'pelatih')
    
    @push('scripts')
    <script>
        var ukm = [];
        var jml = [];
        @foreach ($graph as $g)
            @if (session('user')->role == 'pelatih')
                ukm.push('Pertemuan ke-{{ $loop->iteration }}');
            @elseif (session('user')->role == 'adminkeuangan')
                ukm.push('{{ $g->nama_ukm }} ({{$g->nama}})');
            @else
                ukm.push('{{ $g->nama_ukm }}');
            @endif
            jml.push('{{ $g->graph_value }}');
        @endforeach
        jml = jml.map(Number);

        
        Highcharts.chart('grafik', {
            chart: {
                type: 'column'
            },
            title: {
                text: '{{ $graph_title }}'
            },
            xAxis: {
                categories: ukm,
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '{{ $graph_yaxis }}',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                },
                series: {
                    colorByPoint: true
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: '',
                showInLegend: false,
                data: jml
            }]
        });
    </script>
    @endpush 

@else
    
@endif

