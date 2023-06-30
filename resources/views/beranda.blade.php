@extends('layouts.main')

@section('container')
    <div class="row pt-md-5 pt-3 pb-5 px-2 text-white d-flex align-items-center justify-content-center" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-md-5 col-11 mb-3">
            <h3 class="mb-4 lh-base">Sistem E-Voting Pemilihan Ketua OSIS Berbasis Web</h3>
            <a href="/kandidat" class="btn btn-outline-light px-3 rounded-pill" style="margin-right: 0.5rem">Lihat Kandidat</a>
            <a href="/voting" class="btn text-white px-3 rounded-pill" style="background: #03C988">Voting Sekarang</a>
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
                        <i class="on-beranda fa-solid fa-person-booth fa-4x" style="color: #03C988;"></i>
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
                        <i class="on-beranda fa-solid fa-user-tie fa-4x" style="color: #3dabff;"></i>
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
                        <i class="on-beranda fa-solid fa-file-shield fa-4x" style="color: #6C63FF;"></i>
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
                        <i class="on-beranda fa-solid fa-file-circle-question fa-4x" style="color: #EB455F;"></i>
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
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Login</span></li>
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Pilih Menu Voting</span></li>
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Pilih Kandidat</span></li>
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Pilih Tombol Voting (Bagian bawah)</span></li>
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Masukan One Time Password</span></li>
                    <li><i class="bi bi-check2-circle" style="color:#0D6EFD"></i><span class="mx-2">Selesai</span></li>
                </ul>
            </div>
        </div>
    </div>
    
@endsection