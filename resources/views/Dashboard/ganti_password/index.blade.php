@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-sm-6">
            <div class="card">
                <h5 class="card-header">Ganti Password</h5>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <small id="passwordRule" class="form-text text-muted">
                        <ul class="py-0 px-3 ">
                            <li>Berisi minimal 6 karakter.</li>
                            <li>Berisi setidaknya satu huruf kecil.</li>
                            <li>Berisi setidaknya satu huruf besar.</li>
                            <li>Berisi setidaknya satu angka.</li>
                            <li>Berisi setidaknya satu karakter khusus.</li>
                        </ul>
                    </small>
                    <form action="/dashboard/ganti_password/{{ auth()->user()->slug }}" method="post">
                        @method('put')
                        @csrf
                        <div class="input-group mb-3" id="show_hide_password">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">
                                    <a href=""><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
                                </span>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
@endsection