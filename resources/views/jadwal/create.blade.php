@extends('layouts.mainadv')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow m-4">

            <div class="card-header py-3">
                <h3 class="mt-2">Tambah Jadwal</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('jadwal.store') }}">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="ukm_id">Nama UKM/HMJ</label>
                                <select name="ukm_id" id="ukm_id" class="form-control select2bs4 @error('ukm_id') is-invalid @enderror"> 
                                    @foreach ($ukm as $ukm)
                                        <option value="{{ $ukm->id }} {{ old('ukm_id') }}">{{ $ukm->nama_ukm }}</option>
                                    @endforeach
                                </select>
                                @error('ukm_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="hari">Hari</label>
                                <div class="form-check ml-4">
                                    <input type="checkbox" class="form-check-input" name="hari[]" value="Senin" id="senin">
                                    <label class="form-check-label" for="senin">Senin</label>
                                </div>
                                <div class="form-check ml-4">
                                    <input type="checkbox" class="form-check-input" name="hari[]" value="Selasa" id="selasa">
                                    <label class="form-check-label" for="selasa">Selasa</label>
                                </div> 
                                <div class="form-check ml-4">
                                    <input type="checkbox" class="form-check-input" name="hari[]" value="Rabu" id="rabu">
                                    <label class="form-check-label" for="rabu">Rabu</label>
                                </div>  
                                <div class="form-check ml-4">
                                    <input type="checkbox" class="form-check-input" name="hari[]" value="Kamis" id="kamis">
                                    <label class="form-check-label" for="kamis">Kamis</label>
                                </div>     
                                <div class="form-check ml-4">
                                    <input type="checkbox" class="form-check-input" name="hari[]" value="Jumat" id="jumat">
                                    <label class="form-check-label" for="jumat">Jumat</label>
                                </div>
                                <div class="form-check ml-4">
                                    <input type="checkbox" class="form-check-input" name="hari[]" value="Sabtu" id="sabtu">
                                    <label class="form-check-label" for="sabtu">Sabtu</label>
                                </div>
                                <div class="form-check ml-4">
                                    <input type="checkbox" class="form-check-input" name="hari[]" value="Minggu" id="minggu">
                                    <label class="form-check-label" for="sabtu">Minggu</label>
                                </div>
                                @error('hari')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="waktu_mulai">Waktu Mulai</label>
                                        <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai') }}">
                                        @error('waktu_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="waktu_selesai">Waktu Selesai</label>
                                        <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai') }}">
                                        @error('waktu_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tempat">Tempat</label>
                                <input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" id="tempat" value="{{ old('tempat') }}">
                                @error('tempat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>


                            <button type="submit" class="btn btn-success btn-block border pt-2">Tambah Data</button>
                            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary btn-block">Batal</a>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection