@extends('layouts.main')

@section('container')
    <div class="row pt-md-5 pt-3 pb-5 px-2 text-white d-flex align-items-center justify-content-center bg-votos">
        <div class="col-md-5 col-11 mb-3">
            <h3 class="mb-3 lh-base">Sistem E-Voting Pemilihan Ketua OSIS Berbasis Web</h3>
            @if ($pemilu)
                @if ($waktupemilubelumdimulai)
                <h6 class="mb-3 lh-base">Voting Akan Segera Dimulai</h6>
                @elseif($waktupemiluberlangsung)
                <h6 class="mb-3 lh-base">Voting Sedang Berlangsung</h6>
                @else
                <h6 class="mb-3 lh-base">Voting Telah Berakhir</h6>
                @endif
            <div class="row mb-4 ms-1">
                <div id="hari" class="col-2 d-flex flex-column align-items-center rounded-3 me-2 aspect-ratio-1-1 bg-v-black-1b"><h1 class="my-1">0</h1><span>Hari</span></div>
                <div id="jam" class="col-2 d-flex flex-column align-items-center rounded-3 me-2 aspect-ratio-1-1 bg-v-black-1b"><h1 class="my-1">0</h1><span>Jam</span></div>
                <div id="menit" class="col-2 d-flex flex-column align-items-center rounded-3 me-2 aspect-ratio-1-1 bg-v-black-1b"><h1 class="my-1">0</h1><span>Menit</span></div>
                <div id="detik" class="col-2 d-flex flex-column align-items-center rounded-3 me-2 aspect-ratio-1-1 bg-v-black-1b"><h1 class="my-1">0</h1><span>Detik</span></div>
            </div>
            @endif
            <div>
                <a href="/kandidat" class="btn btn-outline-light px-3 rounded-pill">Lihat Kandidat</a>
                <a href="/voting" class="btn text-white px-3 rounded-pill bg-v-success">Voting Sekarang</a>
            </div>
        </div>
        <div class="col-md-5 d-flex pt-5 justify-content-center img-ilustration-beranda1">
            <img src="/img/voting.svg" alt="ilustrasi" width="60%">
        </div>
    </div>
    <div class="px-md-5 px-3 pt-3">
        <div class="row py-md-3 px-2 px-md-5 d-flex justify-content-center">
            <div class="col-6 col-md-3 d-flex p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="on-beranda fa-solid fa-person-booth fa-4x clr-success"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h1>{{ count($pemilihs) }}</h1>
                        <h6>Jumlah Pemilih</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 d-flex p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="on-beranda fa-solid fa-user-tie fa-4x clr-v-aqua"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h1>{{ count($kandidats) }}</h1>
                        <h6>Jumlah Kandidat</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 d-flex p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="on-beranda fa-solid fa-file-shield fa-4x clr-v-purple"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h1>{{ count($votings) }}</h1>
                        <h6>Pemilih Sudah Memilih</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 d-flex p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="on-beranda fa-solid fa-file-circle-question fa-4x clr-v-red"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h1>{{ count($pemilihs) - count($votings) }}</h1>
                        <h6>Pemilih Belum Memilih</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-md-2 pb-5 px-3 d-flex align-items-center justify-content-center">
        <div class="col-md-5 col-8 d-flex pt-5 justify-content-center img-ilustration-beranda2">
            <img src="/img/alur.svg" alt="ilustrasi" width="70%">
        </div>
        <div class="col-md-5 mt-3 px-4 px-md-5 d-flex align-items-center">
            <div class="px-md-5">
                <h3>Cara Mengikuti Voting</h3>
                <p>Pastikan kamu sudah terdaftar di sistem e-voting ini. Jika belum silahkan hubungi panitia</p>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check2-circle clr-v-blue"></i><span class="mx-2">Login</span></li>
                    <li><i class="bi bi-check2-circle clr-v-blue"></i><span class="mx-2">Pilih Menu Voting</span></li>
                    <li><i class="bi bi-check2-circle clr-v-blue"></i><span class="mx-2">Pilih Kandidat</span></li>
                    <li><i class="bi bi-check2-circle clr-v-blue"></i><span class="mx-2">Pilih Tombol Voting (Bagian bawah)</span></li>
                    <li><i class="bi bi-check2-circle clr-v-blue"></i><span class="mx-2">Masukan One Time Password</span></li>
                    <li><i class="bi bi-check2-circle clr-v-blue"></i><span class="mx-2">Selesai</span></li>
                </ul>
            </div>
        </div>
    </div>
    
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var end = new Date('{{$waktupemilu}}');
            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var timer;
            
            function showRemaining() {
                var now = new Date();
                var distance = end - now;
                if (distance < 0) {
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