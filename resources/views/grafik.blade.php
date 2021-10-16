@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Grafik Kehadiran')

@section('content')
    <div class="container">
        <div>
            <div class="card m-5">
                @if (session('user')->role == 'wk')
                    <div class="row">
                        <div class="col-lg-4 m-4">
                            <p>Lihat grafik per UKM/HMJ</p>
                            <div class="dropdown">
                                <a class="btn btn-info dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pilih UKM/HMJ
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @foreach ($list_ukm as $ukm)
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

            <a href="/dashboard" class="btn btn-outline-info btn-sm ml-5 mb-3">Kembali</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var ukm = [];
        var jml = [];
        @foreach ($graph as $g)
            ukm.push('Pertemuan ke-{{ $loop->iteration }}');
            jml.push('{{ $g->graph_value }}');
        @endforeach
        jml = jml.map(Number);
        
        Highcharts.chart('grafik', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Kehadiran Mahasiswa {{ $g->nama_ukm }}'
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
                    text: 'Jumlah kehadiran',
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

