@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 px-3 text-light bg-votos">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3 garis-bawah-gradient">One Time Password</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Gunakan kode One Time Password (OTP) untuk melakukan vote</p>
        </div>
    </div>
    <div class="row d-flex align-items-center justify-content-center my-md-5 pb-5 g-5 px-3">
        <div class="col-md-4 d-flex justify-content-center">
            <div class="row d-flex justify-content-center">
                <div class="col-6 col-md-8">
                    <div class="kotak-profil border bg-white overflow-hidden">
                        <div class="candidate_thumb">
                            @if ($suratSuara->kandidat->foto)
                                <img src="{{ asset('storage/public/'. $suratSuara->kandidat->foto) }}" class="foto-kandidat" alt="Foto Kandidat" width="100%">
                            @else
                                <img src="{{ asset('storage/public/foto-kandidat/defaultKandidat.jpg') }}" class="foto-kandidat" alt="Foto Kandidat" width="100%">
                            @endif
                            <div class="thumbnail-foto-kandidat px-3">
                                <h5 class="text-primary">
                                    {{ $suratSuara->kandidat->nomor }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 pt-1"> 
                            <h6 class="card-title text-end mb-4">{{ $suratSuara->kandidat   ->nama }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 d-flex justify-content-center">
            <div class="box-otp w-75">
                <p>Kode One Time Password (OTP) telah di Kirim ke email terdaftar. Periksa email dan masukan kodenya!</p>
                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session()->has('errormessage'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('errormessage') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="/voting/vote" method="post">
                    @csrf
                    <div class="form-floating input-group-sm mb-3">
                        <input type="password" class="form-control input-sm" name="otp" id="otp" placeholder="One Time Password (OTP)" required autofocus>
                        <label for="otp">One Time Password (OTP)</label>
                        <div id="emailHelp" class="form-text mt-2">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Lihat password
                            </label> 
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mb-3">Voting</button>
                </form>
                <form action="/voting/generate" method="post">
                    @csrf
                    <input type="hidden" name="nomor" id="nomor" value="{{ $suratSuara->kandidat->nomor }}">
                    <input type="hidden" name="update" id="update" value="{{ $suratSuara->kandidat->nomor }}">
                    <button type="submit" class="btn btn-sm btn-link px-0">Kirim ulang kode OTP</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.form-check-input').click(function(){
                if($(this).is(':checked')){
                    $('#otp').attr('type','text');
                }else{
                    $('#otp').attr('type','password');
                }
            });
	    });
    </script>
@endpush