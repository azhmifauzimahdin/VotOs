@extends('layouts.main')

@section('container')
    <div class="row pt-md-4">
        <div class="col-md-12 text-center mb-3">
            <h3>Login Pemilih</h3>
        </div>
        <div class="col-md-4 col-10 mx-auto py-5 px-4 shadow-sm p-3 mb-5 bg-white rounded-3">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <main class="w-100 m-auto">
                <img src="/img/icon_vote.png" class="mx-auto d-block" style="width: 30%" alt="Vote">
                <h4 class="text-center">Sistem E-Voting</h4>
                <p class="text-center mb-3">Pemilihan Ketua OSIS</p>
                <form action="/login" method="post">
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
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                </form>
            </main>
        </div>
    </div>
@endsection