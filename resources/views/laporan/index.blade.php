@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Laporan')

@section('content')
    <div class="container">
 
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1>Laporan Pelatih</h1>
            </div>
            <div class="card-body p-2 m-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="list-group">
                            <form action="{{ route('laporan.store') }}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mt-3">
                                            <label for="tanggalmulai">Tanggal Mulai</label>
                                            <input type="date" class="form-control @error('tanggalmulai') is-invalid @enderror" name="tanggalmulai" id="tanggalmulai" value="{{ old('tanggalmulai') }}">
                                            @error('tanggalmulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mt-3">
                                            <label for="tanggalselesai">Tanggal Selesai</label>
                                            <input type="date" class="form-control @error('tanggalselesai') is-invalid @enderror" name="tanggalselesai" id="tanggalselesai" value="{{ old('tanggalselesai') }}">
                                            @error('tanggalselesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark border pt-2">Lihat</button>

                            </form>

                        </div>
                    </div>
                    <div class="col-lg-6 my-auto">
                        <center>
                        <img src="{{asset('assets/img/logo.png')}}" alt="" width="80%" class="align-middle">
                    </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection