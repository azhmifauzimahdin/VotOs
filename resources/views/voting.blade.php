@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 text-light bg-votos">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3 garis-bawah-gradient">Voting</h3>
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
        @if($suratSuara && $suratSuara->kode)
            <div class="px-5">
                <div class="row d-flex justify-content-center mx-md-5 mb-5">
                    <div class="col-12 col-md-3 bg-light shadow-sm overflow-hidden border-radius-1 px-0 mb-3 h-100">
                        <div class="py-3"></div>
                        @if ($suratSuara->kandidat->foto)
                            <img src="{{ asset('storage/'. $suratSuara->kandidat->foto) }}" alt="Foto Kandidat" class="foto-kandidat-voting">
                        @else
                            <img src="{{ asset('storage/foto-kandidat/defaultKandidat.jpg') }}" alt="Foto Kandidat" class="foto-kandidat-voting">
                        @endif
                        <h6 class="text-center py-2"><b>{{ $suratSuara->kandidat->nama }}</b></h6>
                    </div>
                    <div class="col-12 col-md-4 bg-light shadow-sm border-radius-1 py-3 px-4 px-md-4 mx-md-2">
                        <div class="row border-bottom-dashed py-md-4">
                            {!! $suratSuara->qr_code !!}
                        </div>
                        <div class="row border-bottom py-2">
                            <div class="col-md-5"><b>Nomor</b></div>
                            <div class="col-md-7">
                                {{ $suratSuara->kandidat->nomor }}
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-md-5"><b>Nama</b></div>
                            <div class="col-md-7">{{ $suratSuara->kandidat->nama }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @if($pemilu)
                @if ($waktupemiluselesai)
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
                @if ($waktupemiluberlangsung)
                <div class="px-5 mx-md-5">
                    <form action="/voting/generate" method="post">
                        @csrf
                        <div class="row row-cols-2 row-cols-md-4 g-2 g-md-4 mb-4 d-flex justify-content-center px-md-5 mx-md-3">
                            @foreach ($kandidats as $kandidat)
                                <div class="col">
                                    <div class="kotak-profil border bg-white overflow-hidden">
                                        <div class="candidate_thumb">
                                            @if ($kandidat->foto)
                                                <img src="{{ asset('storage/'. $kandidat->foto) }}" class="foto-kandidat" alt="Foto Kandidat" width="100%">
                                            @else
                                                <img src="{{ asset('storage/foto-kandidat/defaultKandidat.jpg') }}" class="foto-kandidat" alt="Foto Kandidat" width="100%">
                                            @endif
                                            <div class="thumbnail-foto-kandidat px-3">
                                                <h5 class="text-primary">
                                                    {{ $kandidat->nomor }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="px-3 pt-1 pb-3"> 
                                            <h6 class="card-title text-end mb-4">{{ $kandidat->nama }}</h6>
                                            <div class="px-3 mb-2 w-100 d-flex justify-content-center lihat-detail"> 
                                                <div class="form-check">
                                                    <input class="form-check-input csr-pointer" type="radio" name="nomor" id="nomor{{ $kandidat->nomor }}" value="{{ $kandidat->nomor }}">
                                                    <label class="form-check-label csr-pointer" for="id{{ $kandidat->nomor }}">
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
                @endif
                @if($waktupemilubelumdimulai)
                <div class="row d-flex align-items-center justify-content-center mb-5 mt-3 g-4 px-3">
                    <div class="col-md-5 d-flex justify-content-center">
                        <img src="/img/waktu.svg" alt="ilustrasi" width="60%">
                    </div>  
                    <div class="col-md-5">
                        <h4 class="text-center">WAKTU PEMILU BELUM DIMULAI</h4>
                        <p class="text-center w-75 mx-auto mb-4">Voting Akan Segera Dimulai</p>
                        <div class="row mb-4 d-flex justify-content-center ms-1 text-white">
                            <div id="hari" class="col-2 d-flex flex-column align-items-center rounded-3 aspect-ratio-1-1 bg-v-success me-2"><h1 class="my-1">0</h1><span>Hari</span></div>
                            <div id="jam" class="col-2 d-flex flex-column align-items-center rounded-3 aspect-ratio-1-1 bg-v-success me-2"><h1 class="my-1">0</h1><span>Jam</span></div>
                            <div id="menit" class="col-2 d-flex flex-column align-items-center rounded-3 aspect-ratio-1-1 bg-v-success me-2"><h1 class="my-1">0</h1><span>Menit</span></div>
                            <div id="detik" class="col-2 d-flex flex-column align-items-center rounded-3 aspect-ratio-1-1 bg-v-success me-2"><h1 class="my-1">0</h1><span>Detik</span></div>
                        </div>
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
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#submit_voting').attr('disabled', true);
            $('input[name=nomor]:radio').click(function(){
                $('#submit_voting').attr('disabled', false);
            });
        
            var end = new Date({{ Js::from($waktupemilu) }});
            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var timer;
            
            function showRemaining() {
                var now = new Date();
                var distance = end - now;
                if (distance < 0) {
                    if({{ Js::from($reloadpage) }}){
                        location.reload();
                    }
                    clearInterval(timer);
                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor((distance % _day) / _hour);
                var minutes = Math.floor((distance % _hour) / _minute);
                var seconds = Math.floor((distance % _minute) / _second);

                $("#hari").html("<h1 class='my-1'>" + days + "</h1><span>Hari</span>");
                $("#jam").html("<h1 class='my-1'>" + hours + "</h1><span>Jam</span>");
                $("#menit").html("<h1 class='my-1'>" + minutes + "</h1><span>Menit</span>");
                $("#detik").html("<h1 class='my-1'>" + seconds + "</h1><span>Detik</span>");
            }
            
            timer = setInterval(showRemaining, 1000);
        });
    </script>
@endpush