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
                            Wakil Ketua III
                        @else
                            {{ session('user')->role }}     
                        @endif
                       
                    </h6>
                    @if (!empty($profile->user_id))
                        <a href="{{ route('profile.edit',['profile' => $profile->id]) }}">Edit Profil</a>
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
                    @if (!empty($profile->user_id))
                        <p><strong>Username :</strong> {{ session('user')->user_name }}</p>
                        <p><strong>NIK/NPM :</strong> {{ $profile->niknpm }}</p>
                        <p><strong>Email :</strong> {{ $profile->email }}</p>
                        <p><strong>Nomor HP :</strong> {{ $profile->nohp }}</p>
                        <p><strong>Alamat :</strong> {{ $profile->alamat }}</p>                  
                    @else
                        <p><strong>Username :</strong> {{ session('user')->user_name }}</p>
                        <p><strong>NIK/NPM :</strong> -</p>
                        <p><strong>Email :</strong> -</p>
                        <p><strong>Nomor HP :</strong> -</p>
                        <p><strong>Alamat :</strong> -</p>
                    @endif
                </div>
            </div>
        </div>

        @if (session('user')->role == 'wk' || session('user')->role == 'adminkeuangan' || session('user')->role == 'pembina' || session('user')->role == 'pelatih')

            <div>
                <div class="card m-5">
                    <figure class="highcharts-figure">
                        <div id="grafik"></div>
                    </figure>

                    @if (session('user')->role == 'wk')
                        <form action="" method="post">
                            <p class="ml-4">Lihat grafik per UKM</p>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select name="grafik_ukm" id="grafik_ukm" class="custom-select ml-4">
                                            @foreach ($graph as $ukm)
                                                <option value="{{ $ukm->ukm_id }}">{{ $ukm->nama_ukm }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-primary ml-4" data-toggle="modal" data-target="#exampleModalCenter">
                                        Tampilkan Grafik
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>

                    

                @if(!empty($graph2))
                    <div class="card m-5">
                        

                        {{-- <figure class="highcharts-figure">
                            <div id="grafik2"></div>
                        </figure> --}}
                    </div>
                @endif

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

            @if(!empty($graph2))
                var ukm2 = [];
                var jml2 = [];
                @foreach ($graph2 as $g)
                    ukm2.push('{{ $loop->iteration }}');
                    jml2.push('{{ $g->graph_value }}');
                @endforeach
                jml2 = jml2.map(Number);
                
                Highcharts.chart('grafik2', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Grafik Keaktifan {{ $g->nama_ukm }}'
                    },
                    xAxis: {
                        categories: ukm2,
                        title: {
                            text: 'Pertemuan ke-'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah kehadiran mahasiswa',
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
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: '',
                        showInLegend: false,
                        data: jml2
                    }]
                });
            @endif
    </script>
    @endpush 

@else
    
@endif

