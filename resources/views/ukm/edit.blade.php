@extends('layouts.mainadv')

@section('title', 'Edit Data UKM/HMJ')

@section('content')
<div class="container">
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h3 class="">Edit Data UKM/HMJ</h3>
        </div>

        <div class="card-body p-2 m-2">
            <form method="post" action="{{ route('ukm.update',['ukm'=>$ukm->id]) }}">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mt-3">
                            <label for="nama_ukm">Nama UKM/HMJ</label>
                            <input type="text" class="form-control @error('nama_ukm') is-invalid @enderror" name="nama_ukm" id="nama_ukm" value="{{ $ukm->nama_ukm }}">
                            <div class="text-danger">{{ $errors->first('nama_ukm')}}</div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="pembina_id">Nama Pembina</label>
                            <select name="pembina_id" id="pembina_id" class="form-control select2bs4 @error('pembina_id') is-invalid @enderror">
                                <option value="">-</option>
                                @foreach ($pembina as $p)
                                    <option value="{{ $p->id }}" {{ $ukm->pembina_id == $p->id ? 'selected' : ''}}>{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            @error('pembina_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        @php
                            $idpelatih = App\Users::whereIn('id', explode(',', $ukm->pelatih_id))->get()
                        @endphp

                        <div class="form-group mt-3">
                            <label for="pelatih_id[]">Nama Pelatih</label>
                            <select name="pelatih_id[]" id="pelatih_id[]" class="form-control select2bs4 @error('pelatih_id[]') is-invalid @enderror" multiple>
                                <option value="">-</option>
                                @foreach ($pelatih as $p)
                                    <option value="{{ $p->id }}" @foreach ($idpelatih as $pelatihid)
                                        {{ $pelatihid->id == $p->id ? 'selected' : ''}}
                                    @endforeach>{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            @error('pelatih_id[]')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="ketuamhs_id">Nama Ketua Mahasiswa</label>
                            <select name="ketuamhs_id" id="ketuamhs_id" class="form-control select2bs4 @error('ketuamhs_id') is-invalid @enderror">
                                @foreach ($ketuamhs as $k)
                                    <option value="{{ $k->id }}" {{ $ukm->ketuamhs_id == $k->id ? 'selected' : ''}}>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                            @error('ketuamhs_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="Aktif" {{ ($ukm->status == 'Aktif') ? 'selected' : '' }}>Aktif</option>
                                <option value="Non-aktif" {{ ($ukm->status == 'Non-aktif') ? 'selected' : '' }}>Non Aktif</option>
                            </select>
                            <div class="text-danger">{{ $errors->first('status')}}</div>
                        </div>

                    </div>
                    
                    <div class="col-lg-6 mt-3">
                        <strong>STATUS PELATIH</strong>

                        @php
                            $pelatih = App\Users::whereIn('id', explode(',', $ukm->pelatih_id))->get()
                        @endphp
                        
                        @foreach ($pelatih as $p)
                            <div class="form-group form-inline mt-3">
                                <label for="status_user[{{$p->id}}]" class="col-lg-5">{{ $p->nama }}</label>
                                <select name="status_user[{{$p->id}}]" id="status_user[{{$p->id}}]" class="form-control col-lg-7">
                                    <option value="Aktif" {{ ($p->status_user == 'Aktif') ? 'selected' : '' }}>Aktif</option>
                                    <option value="Non-aktif" {{ ($p->status_user == 'Non-aktif') ? 'selected' : '' }}>Non Aktif</option>
                                </select>
                            </div>
                            
                        @endforeach
                            

                    </div>
                    
                    <button type="submit" class="btn btn-success btn-block border pt-2">Edit Data</button>
                    <a href="/ukm" class="btn btn-outline-secondary btn-block">Batal</a>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection