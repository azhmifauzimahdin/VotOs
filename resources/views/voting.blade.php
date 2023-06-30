@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 text-light" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3" style="border-bottom-style: solid; border-width: 2px; border-radius: 50% ; border-image: linear-gradient(to right, #2dcddf, #2ddfbb,#2ddf8f) 1">Voting</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Voting kandidat pilihan kamu</p>
        </div>
    </div>
    @guest('pemilih')
        <div class="row d-flex align-items-center justify-content-center mb-5 mt-3 g-5 px-3">
            <div class="col-md-5 d-flex justify-content-center">
                <img src="/img/autentikasi.svg" alt="ilustrasi" width="60%">
            </div>  
            <div class="col-md-5">
                <h4 class="text-center">Silakan Login Untuk Melakukan Voting</h4>
                <p class="text-center w-75 mx-auto">Anda harus login terlebih dahulu sebelum melakukan voting</p>
                <div class="d-flex justify-content-center">
                    <a href="/loginPemilih" class="btn btn-primary rounded-pill px-4">Login Sekarang</a>
                </div>
            </div>
        </div>
    @endguest
    @auth('pemilih')
        @if($status)
            <div class="px-5">
                @if(session()->has('message'))
                <div class="row">
                    <div class="alert alert-success alert-dismissible fade show " role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <div class="row d-flex justify-content-center mx-md-5 mb-5">
                    <div class="col-12 col-md-3 bg-light shadow-sm overflow-hidden px-0 mb-3" style="border-radius: 1vw; height: 100%">
                        <div class="py-3"></div>
                        @if ($status->kandidat->foto)
                            <img src="{{ asset('storage/'. $status->kandidat->foto) }}" alt="Foto Kandidat" width="100%" height="300px">
                        @else
                            <img src="{{ asset('AdminLTE') }}/dist/img/default_user.jpg" alt="Foto Kandidat" width="100%" height="320px">
                        @endif
                        <h6 class="text-center py-2"><b>{{ $status->kandidat->nama }}</b></h6>
                    </div>
                    <div class="col-12 col-md-4 bg-light shadow-sm py-3 px-4 px-md-4 mx-md-2" style="border-radius: 1vw;">
                        <div class="row py-md-4 border-bottom">
                            {!! $qrcode !!}
                        </div>
                        <div class="row border-bottom py-2">
                            <div class="col-md-5"><b>Nomor</b></div>
                            <div class="col-md-7">
                                {{ $status->kandidat->nomor }}
                            </div>
                        </div>
                        <div class="row border-bottom py-2">
                            <div class="col-md-5"><b>Nama</b></div>
                            <div class="col-md-7">{{ $status->kandidat->nama }}</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="/voting/print" target="_blank" class="btn btn-success rounded-pill mt-3 px-3" style="margin-right: 4%;"><i class="fa-solid fa-print"></i> Print</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @if($pemilu)
                @if ($waktu->isAfter($pemilu->selesai))
                <div class="row d-flex align-items-center justify-content-center mb-5 mt-3 g-4 px-3">
                    <div class="col-md-5 d-flex justify-content-center">
                        <img src="/img/waktu.svg" alt="ilustrasi" width="60%">
                    </div>  
                    <div class="col-md-5">
                        <h4 class="text-center">WAKTU PEMILU TELAH SELESAI</h4>
                        <p class="text-center w-75 mx-auto">Anda terlambat melakukan vote.</p>
                        <div class="d-flex justify-content-center">
                            <a href="/perolehan-suara" class="btn btn-primary rounded-pill px-3">Hasil Perolehan Suara</a>
                        </div>
                    </div>
                </div>
                @endif
                @if ($waktu->isAfter($pemilu->mulai) && $waktu->isBefore($pemilu->selesai))
                <div class="px-5 mx-md-5">
                    <form action="/voting/generate" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-cols-2 row-cols-md-4 g-2 g-md-4 mb-4 d-flex justify-content-center px-md-5 mx-md-3">
                            @foreach ($kandidats as $kandidat)
                                <div class="col">
                                    <div class="kotak-profil border bg-white overflow-hidden" style="border-radius: 1vw; min-height: 100%; position:relative" >
                                        <div class="candidate_thumb" style="height: 80%">
                                            @if ($kandidat->foto)
                                                <img src="{{ asset('storage/'. $kandidat->foto) }}" class="foto-kandidat" alt="Foto Kandidat" width="100%" height="250px">
                                            @else
                                                <img src="{{ asset('AdminLTE') }}/dist/img/default_user.jpg" class="foto-kandidat" alt="Foto Kandidat" width="100%" height="250px">
                                            @endif
                                            <div class="px-3" style="position: absolute; z-index: 1; width: 100%; bottom: 0; text-align: right;">
                                                <h5 class="text-primary">
                                                    {{ $kandidat->nomor }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="px-3 pt-1 pb-3"> 
                                            <h6 class="card-title text-end mb-4">{{ $kandidat->nama }}</h6>
                                            <div class="px-3 mb-2 w-100 d-flex justify-content-center" style="position: absolute; bottom:0; left: 0"> 
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="slug" id="slug{{ $kandidat->id }}" value="{{ $kandidat->slug }}" style="cursor: pointer">
                                                    <label class="form-check-label" for="slug{{ $kandidat->id }}">
                                                        <b class="text-primary">Vote</b>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach  
                        </div>
                        <div class="row mb-5">
                            <div class="col d-flex justify-content-center">
                                <button type="submit" id="submit_voting" disabled class="btn btn-success rounded-pill px-4">Voting</button>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                <div class="row d-flex align-items-center justify-content-center mb-5 mt-3 g-4 px-3">
                    <div class="col-md-5 d-flex justify-content-center">
                        <img src="/img/waktu.svg" alt="ilustrasi" width="60%">
                    </div>  
                    <div class="col-md-5">
                        <h4 class="text-center">WAKTU PEMILU BELUM DIMULAI</h4>
                        <p class="text-center w-75 mx-auto">Tunggu sampai waktu pemilu dimulai.</p>
                    </div>
                </div>
                @endif
            @else
            <div class="row d-flex align-items-center justify-content-center mb-5 mt-3 g-4 px-3">
                <div class="col-md-5 d-flex justify-content-center">
                    <img src="/img/waktu.svg" alt="ilustrasi" width="60%">
                </div>  
                <div class="col-md-5">
                    <h4 class="text-center">WAKTU PEMILU BELUM DITENTUKAN</h4>
                    <p class="text-center w-75 mx-auto">Tunggu sampai waktu pemilu dimulai.</p>
                </div>
            </div>
            @endif
        @endif
    @endauth
    <script>
        $(document).ready(function() {
            $('#submit_voting').attr('disabled', true);
                $("input[name=slug]:radio").click(function(){
                    $('#submit_voting').attr('disabled', false);
                })
                
            });
    </script>
@endsection