@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Laporan')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
 
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1>Laporan</h1>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>UKM/HMJ</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><center><a href="/laporan/">Lihat</i></a></center></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection