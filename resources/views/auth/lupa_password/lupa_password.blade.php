@extends('auth.layout.main')

@section('content1')
    <div class="col-md-6 d-flex justify-content-center box_loginPemilih">
        <img src="/img/email.svg" alt="ilustrasi" width="64%" class="ilustrasi_loginPemilih">
    </div>
@endsection
@section('content2')
    <h4 class="text-center mb-4">Lupa Password</h4>
    <div class="alert alert-secondary" role="alert">
        Silakan masukan email Anda yang terdaftar
    </div>
    <form action="/lupa-password" method="POST">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" autofocus required>
            <label for="email">Email</label>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="w-100 btn btn-primary">Kirim Reset Password</button>
    </form>
@endsection
@section('content3')
    <a href="/loginPemilih" class="mt-4 text-decoration-none">kembali</a>
@endsection