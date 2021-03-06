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
                        <small style="color: red">Harap segera melengkapi data profil!</small>
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

        <div>
            @if (session('user')->role == 'wk')
                grafik
            @elseif (session('user')->role == 'pembina')
                grafik pembina
            @endif
        </div>
    </div>
@endsection