@extends('layouts.mainadv')

@section('title', 'Edit Jadwal')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h3 class="">Edit Jadwal</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('jadwal.update',['jadwal'=>$jadwal->id]) }}">
                            @method('put')
                            @csrf
                            <div class="form-group mt-3">
                                <label for="ukm_id">UKM/HMJ</label>
                                <input type="text" class="form-control @error('ukm_id') is-invalid @enderror" name="ukm_id" id="ukm_id" value="{{ $jadwal->ukm_id }}">
                                <div class="text-danger">{{ $errors->first('ukm_id')}}</div>
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
                                @error('hari')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="pelatih_id">Nama Pelatih</label>
                                <select name="pelatih_id" id="pelatih_id" class="form-control @error('pelatih_id') is-invalid @enderror">
                                    @foreach ($pelatih as $p)
                                        <option value="{{ $p->id }}" {{ $jadwal->pelatih_id == $p->id ? 'selected' : ''}}>{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                                @error('pelatih_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="waktu_mulai">Waktu Mulai</label>
                                        <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" name="waktu_mulai" id="waktu_mulai" value="{{ $jadwal->waktu_mulai }}">
                                        @error('waktu_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="waktu_selesai">Waktu Selesai</label>
                                        <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" name="waktu_selesai" id="waktu_selesai" value="{{ $jadwal->waktu_selesai }}">
                                        @error('waktu_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tempat">Tempat</label>
                                <input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" id="tempat" value="{{ $jadwal->tempat }}">
                                @error('tempat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="ketuamhs_id">Nama Ketua Mahasiswa</label>
                                <select name="ketuamhs_id" id="ketuamhs_id" class="form-control @error('ketuamhs_id') is-invalid @enderror">
                                    @foreach ($ketuamhs as $k)
                                        <option value="{{ $k->id }}" {{ $jadwal->ketuamhs_id == $k->id ? 'selected' : ''}}>{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                                @error('ketuamhs_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Edit Data</button>
                            <a href="/jadwal" class="btn btn-outline-secondary btn-block">Batal</a>
                        </form>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection