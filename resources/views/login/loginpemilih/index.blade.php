<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- Boostrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    {{-- Jquery --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {{-- My Style --}}
    <link rel="stylesheet" href="/css/mainn.css">
    <title>Votos | {{ $title }}</title>

</head>

<body>
    <div class="container valign">
        <div class="row d-flex px-4">
            <div class="col-md-8 mx-auto shadow bg-white rounded overflow-hidden">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center box_loginPemilih">
                        <img src="/img/loginGreen.svg" alt="ilustrasi" width="50%" class="ilustrasi_loginPemilih">
                    </div>
                    <div class="col-md-6 col-12 px-md-5 pt-md-5">
                        <div class="pb-5 py-3">
                            @if(session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
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
                                    <div id="emailHelp" class="form-text mt-2">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Lihat password
                                        </label> 
                                    </div>
                                </div>
                                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                            </form>
                        </div>
                        <div class="mb-2 mt-md-5 text-center">
                            <a href="/" class="mt-4 text-decoration-none">kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dd7eecbb67.js" crossorigin="anonymous"></script>
</body>

</html>