@extends('auth.layout.main')

@section('content1')
    <div class="col-md-6 d-flex justify-content-center box_loginPemilih">
        <img src="/img/loginGreen.svg" alt="ilustrasi" width="50%" class="ilustrasi_loginPemilih">
    </div>
@endsection
@section('content2')
    <img src="/img/icon_vote.png" class="mx-auto d-block mb-2" style="width: 20%" alt="Vote">
    <h4 class="text-center">Login Pemilih</h4>
    <p class="text-center mb-0">Sistem E-Voting Pemilihan</p>
    <p class="text-center mb-3">Ketua OSIS</p>
    <form action="/loginPemilih" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ old('username') }}" autofocus required>
            <label for="username">Username</label>
            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
            <div id="emailHelp" class="form-text d-flex justify-content-between mt-2">
                <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Lihat password
                    </label>
                </div>
                <a href="/lupa-password" class="text-decoration-none">Lupa Password?</a>
            </div>
        </div>
        <button class="w-100 btn btn-primary" type="submit">Login</button>
    </form>
    <script>
        $(document).ready(function(){
            $('.form-check-input').click(function(){
                if($(this).is(':checked')){
                    $('#password').attr('type','text');
                }else{
                    $('#password').attr('type','password');
                }
            });
        });
    </script>
@endsection