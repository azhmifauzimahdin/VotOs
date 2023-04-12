@extends('layouts.main')

@section('container')
    <div class="px-5 pt-md-3">
        <div class="row">
            <div class="col-12 text-center my-4">
                <h3>Daftar Kandidat</h3>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-4 g-2 g-md-3 mb-5 d-flex justify-content-center">
            <div class="col">
                <div class="px-md-5 pt-3 pb-4 border bg-light hover-zoom" style="border-radius: 1vw">
                    <h3 class="text-center">1</h3>
                    <img src="https://birokratmenulis.org/wp-content/uploads/2017/05/hd-wallpapers.jpg" alt="Foto Kandidat" class="object-fit-contain border rounded w-100" style="height: 300px; width: 100%">
                    <div class="pt-3">
                        <h4 class="card-title text-center pb-2" style="width: 100%">Nama Kandidat</h4>
                        <div class="d-flex justify-content-center"> 
                            <a href="/kandidat/detail" class="btn btn-primary py-1 px-4 rounded-pill border-0">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection