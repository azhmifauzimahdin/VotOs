@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 px-3 text-light bg-votos">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3 garis-bawah-gradient">Ganti Password</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Gunakan password yang kuat untuk keamanan yang lebih baik.</p>
        </div>
    </div>
    <div class="row d-flex align-items-center justify-content-center pt-4 pb-5 g-5 px-3">
        <div class="ilustrasi-ganti-password col-md-4 d-flex justify-content-center">
            <img src="/img/password.svg" alt="ilustrasi" width="70%">
        </div>
        <div class="col-md-5 d-flex justify-content-center">
            <div class="card kotak-ganti-password p-md-2">
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="/ganti_password" method="post">
                        @csrf
                        <div class="mb-2">
                            <label for="password_lama" class="form-label">Password Lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password_lama') is-invalid @enderror" id="password_lama" name="password_lama" placeholder="Password Lama" required>
                                <span class="input-group-text" id="show_hide_password_lama">
                                    <a show-hide-password><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
                                </span>
                                @error('password_lama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="password_baru" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password_baru') is-invalid @enderror" id="password_baru" name="password_baru" placeholder="Password Baru" required>
                                <span class="input-group-text" id="show_hide_password_baru">
                                    <a show-hide-password><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
                                </span>
                                @error('password_baru')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="password_baru_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password_baru_confirmation') is-invalid @enderror" id="password_baru_confirmation" name="password_baru_confirmation" placeholder="Konfirmasi Password" required>
                                <span class="input-group-text" id="show_hide_konfirmasi_password">
                                    <a show-hide-password><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
                                </span>
                                @error('password_baru_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100 my-3">Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $("#show_hide_password_lama a").on('click', function(event) {
                event.preventDefault();
                if($('#password_lama').attr("type") == "text"){
                    $('#password_lama').attr('type', 'password');
                    $('#show_hide_password_lama i').addClass( "fa-eye-slash" );
                    $('#show_hide_password_lama i').removeClass( "fa-eye" );
                }else if($('#password_lama').attr("type") == "password"){
                    $('#password_lama').attr('type', 'text');
                    $('#show_hide_password_lama i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password_lama i').addClass( "fa-eye" );
                }
            });

            $("#show_hide_password_baru a").on('click', function(event) {
                event.preventDefault();
                if($('#password_baru').attr("type") == "text"){
                    $('#password_baru').attr('type', 'password');
                    $('#show_hide_password_baru i').addClass( "fa-eye-slash" );
                    $('#show_hide_password_baru i').removeClass( "fa-eye" );
                }else if($('#password_baru').attr("type") == "password"){
                    $('#password_baru').attr('type', 'text');
                    $('#show_hide_password_baru i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password_baru i').addClass( "fa-eye" );
                }
            });
            $("#show_hide_konfirmasi_password a").on('click', function(event) {
                event.preventDefault();
                if($('#password_baru_confirmation').attr("type") == "text"){
                    $('#password_baru_confirmation').attr('type', 'password');
                    $('#show_hide_konfirmasi_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_konfirmasi_password i').removeClass( "fa-eye" );
                }else if($('#password_baru_confirmation').attr("type") == "password"){
                    $('#password_baru_confirmation').attr('type', 'text');
                    $('#show_hide_konfirmasi_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_konfirmasi_password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
@endpush