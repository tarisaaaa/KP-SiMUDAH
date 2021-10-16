@extends('layouts.mainadv')

@section('title', 'Tambah Absensi')

@section('content')
<div class="container">
        <div class="card shadow m-4">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card-header py-3">
                <h3 class="mt-2">Tambah Absensi {{ $ukm->nama_ukm }}</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        @if (\Carbon\Carbon::now()->format('H:i') >= $jam_mulai && \Carbon\Carbon::now()->format('H:i') <= $jam_selesai)
                            
                            <form method="post" enctype="multipart/form-data" data-id="{{$ukm->id}}" id="formabsensi">
                                <div class="row">
                                <div class="col-lg-5">
                                    @csrf

                                    <div class="form-group mt-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" value="{{ old('keterangan') }}"></textarea>
                                        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="foto">Foto</label>
                                        <div class="custom-file">
                                            <input type="file" accept="img/png, image/jpeg" class="form-control custom-file-input @error('foto') is-invalid @enderror" name="foto" id="foto" value="{{ old('foto') }}">
                                            <label class="custom-file-label" for="foto">Upload foto</label>
                                            @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    @if (!empty($pelatih->nama))

                                        @if (count(explode(',', $pelatih_ids->pelatih_id)) > 1)
                                            @php
                                                $idpelatih = App\Users::whereIn('id', explode(',', $pelatih_ids->pelatih_id))->where('status_user', 'Aktif')->get()
                                            @endphp

                                            @foreach ($idpelatih as $pelatih)
                                                <div class="form-group">
                                                    <label for="kehadiran_pelatih[{{$pelatih->id}}]">Kehadiran Pelatih ({{ $pelatih->nama }})</label><br>
                                                    <input type="radio" name="kehadiran_pelatih[{{$pelatih->id}}]" class="ml-3" value="Hadir"> Hadir <br>
                                                    <input type="radio" name="kehadiran_pelatih[{{$pelatih->id}}]" class="ml-3" value="Tidak Hadir" checked> Tidak Hadir
                                                </div>
                                            @endforeach

                                        @else
                                            <div class="form-group">
                                                <label for="kehadiran_pelatih">Kehadiran Pelatih ({{ $pelatih->nama }})</label><br>
                                                <input type="radio" name="kehadiran_pelatih" class="ml-3" value="Hadir"> Hadir <br>
                                                <input type="radio" name="kehadiran_pelatih" class="ml-3" value="Tidak Hadir" checked> Tidak Hadir
                                            </div>

                                        @endif

                                    @endif

                            
                                </div>

                                <div class="col-lg-7 mt-3">

                                    <table class="table" id="listAnggota">
                                        <thead>
                                            <th>No.</th>
                                            <th>Nama Anggota</th>
                                            <th>H</th>
                                            <th>I</th>
                                            <th>A</th>
                                            <th>Keterangan</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($anggota as $a)
                                                <tr data-id="{{ $a->id }}" class="anggota">
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $a->nama_anggota }}</td>
                                                    
                                                        <td>
                                                            <input type="radio" name="status_absen{{ $a->id }}" value="H">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="status_absen{{ $a->id }}" value="I">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="status_absen{{ $a->id }}" value="A" checked>
                                                        </td>
                                                    
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="keterangan_absen{{$a->id}}">
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                
                            </div>
                                    <button type="button" id="btnTambahData" class="btn btn-success border pt-2 float-right">SIMPAN</button>
                                    <a href="/absensi/{{$ukm->id}}" class="btn btn-outline-secondary">BATAL</a>
                                        
                            </form>

                        @else

                            <center>
                                <p class="mt-3">Lakukan pengisian absensi sesuai dengan jadwal UKM/HMJ!</p>
                                <strong><p>Jadwal kegiatan = {{ $jam_mulai }} - {{ $jam_selesai }} WIB</p></strong>
                            </center>
                            
                        @endif
                        

                    </div>
                </div>
            </div>

            <div class="card-footer text-muted">
                <center><small>{{ \Carbon\Carbon::now()->isoFormat('dddd, lll') }} WIB</small></center>
            </div>

        </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('#btnTambahData').on('click', function(){
                
                
                let formData = new FormData();
                formData.append('ukm_id', $('#formabsensi').data('id'))
                formData.append('keterangan', myEditor.getData());
                formData.append('foto', $('#foto')[0].files[0]);
                @if (!empty($pelatih->nama))
                    @if (count(explode(',', $pelatih_ids->pelatih_id)) > 1)
                        var kehadiran_pelatih = []
                        var pelatih_id = []
                        @php
                            $idpelatih = App\Users::whereIn('id', explode(',', $pelatih_ids->pelatih_id))->get()
                        @endphp
                        @foreach ($idpelatih as $pelatih)
                            // kehadiran_pelatih.push($('input[name="kehadiran_pelatih[{{$pelatih->id}}]"]:checked').val())
                            // kehadiran_pelatih[{{$pelatih->id}}].push($('input[name="kehadiran_pelatih[{{$pelatih->id}}]"]:checked').val())
                            formData.append('kehadiran_pelatih[{{$pelatih->id}}]', $('input[name="kehadiran_pelatih[{{$pelatih->id}}]"]:checked').val());
                            pelatih_id.push({{$pelatih->id}})
                        @endforeach
                        // formData.append('kehadiran_pelatih', JSON.stringify(kehadiran_pelatih));
                        formData.append('pelatih_id', JSON.stringify(pelatih_id));
                    @else
                        formData.append('kehadiran_pelatih', $('input[name=kehadiran_pelatih]:checked').val());
                        formData.append('pelatih_id', {{$ukm->pelatih_id}});
                    @endif
                @endif
                // console.log(formData)
                
                let listAnggota = $('.anggota')
                let absensi = []
                listAnggota.each(function(e){
                    let id = $(this).data('id')
                    absensi.push({
                        anggota_id: id,
                        status_absen: $(this).find('input[name=status_absen'+id+']:checked').val(),
                        keterangan: $(this).find('input[name=keterangan_absen'+id+']').val()
                    })
                    
                })
                formData.append('absensi', JSON.stringify(absensi))
                formData.append('_token', '{{csrf_token()}}')
                // console.log(listAnggota)
                for (var pair of formData.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
                }
                $.ajax({
                    type:'POST',
                    url: "{{ url('inputabsensi') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(result){
                        console.log(result)
                        if (result.success) {
                            window.location = '{{url("absensi")}}/'+$('#formabsensi').data('id')
                        } else {
                            alert("gagal")
                        }
                    }
                })
            })
        })
    </script>
@endpush