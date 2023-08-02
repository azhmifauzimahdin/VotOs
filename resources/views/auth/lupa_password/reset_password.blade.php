@extends('auth.layout.main')

@section('content1')
    <div class="col-md-6 d-flex justify-content-center box_loginPemilih">
    <img src="/img/resetPassword.svg" alt="ilustrasi" width="64%" class="ilustrasi_loginPemilih">
    </div>
@endsection
@section('content2')
    <h4 class="text-center mb-4">Reset Password</h4>
    <form action="/reset-password" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" autofocus required>
            <label for="email">Email</label>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required>
            <label for="password_confirmation">Konfirmasi Password</label>
            @error('password_confirmation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <div class="form-text d-flex justify-content-between mt-2">
                <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Lihat password
                    </label>
                </div>
                <a href="/loginPemilih" class="text-decoration-none">Login?</a>
            </div>
        </div>
        <button type="submit" class="w-100 btn btn-primary">Reset Password</button>
    </form>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.form-check-input').click(function(){
                if($(this).is(':checked')){
                    $('#password').attr('type','text');
                    $('#password_confirmation').attr('type','text');
                }else{
                    $('#password').attr('type','password');
                    $('#password_confirmation').attr('type','password');
                }
            });
        });
    </script>
@endpush