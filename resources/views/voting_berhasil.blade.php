@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 text-light" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3" style="border-bottom-style: solid; border-width: 2px; border-radius: 50% ; border-image: linear-gradient(to right, #2dcddf, #2ddfbb,#2ddf8f) 1">Voting Berhasil</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Hasil voting berhasil ditambahkan</p>
        </div>
    </div>
    <div class="row mb-5 d-flex justify-content-center">
        <div class="col-md-3 px-4 py-4 border bg-light">
            <div class="row d-flex justify-content-center pb-4 border-bottom">
                <img src="https://cdn.britannica.com/17/155017-050-9AC96FC8/Example-QR-code.jpg" alt="QR Code" class="object-fit-contain border rounded" style="height: 300px; width: 300px">
            </div>
            <div class="row border-bottom py-2">
                <div class="col-md-4"><b>ID</b></div>
                <div class="col-md-8">xxxx</div>
            </div>
            <div class="row border-bottom py-2">
                <div class="col-md-4"><b>Kandidat</b></div>
                <div class="col-md-8">Nama Kandidat</div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="/kandidat" class="btn btn-success rounded-pill mt-3 px-4" style="margin-right: 4%;"><i class="fa-solid fa-print"></i>  Cetak</a>
                <a href="/kandidat" class="btn btn-primary rounded-pill mt-3 px-4"><i class="fa-solid fa-chart-simple"></i> Perolehan suara</a>
            </div>
        </div>
    </div>
@endsection