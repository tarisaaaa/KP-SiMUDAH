@extends('layouts.main')

@section('title', 'SiMUDAH | Lupa Password')

@section('content')
    <div class="container">
        <center>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="ml-5 mr-5">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        <form action="{{ url('forgotpassword') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="email">MASUKKAN ALAMAT EMAIL ANDA UNTUK MERESET PASSWORD</label>
                                <input type="text" class="form-control mt-2 @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-block">Kirim Link</button>
                            <br>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </div>
@endsection
