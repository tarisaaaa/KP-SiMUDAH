@extends('layouts.mainadv')

@section('title', 'Edit Data Kegiatan')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h3 class="">Edit Data Kegiatan</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('kegiatan.update',['kegiatan'=>$kegiatan->id]) }}">
                            @method('put')
                            @csrf

                            @if (session('user')->role == 'ketuamahasiswa')
                                <div class="form-group mt-3" hidden>
                                    <label for="ukm_id">UKM / HMJ</label>
                                    <select name="ukm_id" id="ukm_id" class="form-control select2bs4 @error('ukm_id') is-invalid @enderror">
                                        @foreach ($ukm as $ukm)
                                            <option value="{{ $ukm->id }}" {{ $kegiatan->ukm_id == $ukm->id ? 'selected' : ''}}>{{ $ukm->nama_ukm }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{ $errors->first('ukm_id')}}</div>
                                </div>
                            @else
                                <div class="form-group mt-3">
                                    <label for="ukm_id">UKM / HMJ</label>
                                    <select name="ukm_id" id="ukm_id" class="form-control select2bs4 @error('ukm_id') is-invalid @enderror">
                                        @foreach ($ukm as $ukm)
                                            <option value="{{ $ukm->id }}" {{ $kegiatan->ukm_id == $ukm->id ? 'selected' : ''}}>{{ $ukm->nama_ukm }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{ $errors->first('ukm_id')}}</div>
                                </div>
                            @endif
                            

                            <div class="form-group mt-3">
                                <label for="nama_kegiatan">Nama Kegiatan</label>
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" id="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}">
                                <div class="text-danger">{{ $errors->first('nama_kegiatan')}}</div>
                                @error('nama_kegiatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{ $kegiatan->tanggal }}">
                                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan">{!! ($kegiatan->keterangan) !!}</textarea>
                                <div class="text-danger">{{ $errors->first('keterangan')}}</div>
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Edit Data</button>
                            <a href="/kegiatan" class="btn btn-outline-secondary btn-block">Batal</a>
                        </form>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection