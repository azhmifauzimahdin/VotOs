@extends('auth.layout.main')

@section('content1')
    <div class="col-md-6 d-flex justify-content-center box_loginUser">
        <img src="/img/loginBlue.svg" alt="ilustrasi" width="50%" class="ilustrasi_loginUser">
    </div>
@endsection
@section('content2')
    <img src="/img/icon_vote.png" class="mx-auto d-block mb-2" style="width: 20%" alt="Vote">
    <h4 class="text-center">Login Admin/Panitia</h4>
    <p class="text-center mb-0">Sistem E-Voting Pemilihan</p>
    <p class="text-center mb-3">Ketua OSIS</p>
    <form action="/loginUser" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" autofocus required>
            <label for="email">Email</label>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
            <div id="emailHelp" class="form-text mt-2">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Lihat password
                </label> 
            </div>
        </div>
        <button class="w-100 btn btn-primary" type="submit">Login</button>
    </form>
@endsection
@section('content3')
    <a href="/" class="mt-4 text-decoration-none">kembali</a>
@endsection

@push('script')
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
@endpush