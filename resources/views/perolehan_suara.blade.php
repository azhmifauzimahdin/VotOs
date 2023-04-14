@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 text-light" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3" style="border-bottom-style: solid; border-width: 2px; border-radius: 50% ; border-image: linear-gradient(to right, #2dcddf, #2ddfbb,#2ddf8f) 1">Perolehan Suara</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Hasil Perolehan Suara</p>
        </div>
    </div>
    <div class="px-5 pt-md-3">
        <div class="row row-cols-2 row-cols-md-4 g-2 g-md-3 mb-5 d-flex justify-content-center">
            <div class="col">
                <div class="px-md-5 pt-3 pb-5 border bg-light" style="border-radius: 1vw">
                    <h4 class="text-center">1</h4>
                    <img src="https://birokratmenulis.org/wp-content/uploads/2017/05/hd-wallpapers.jpg" alt="Foto Kandidat" class="object-fit-contain border rounded" style="height: 300px; width: 100%">
                    <div class="pt-3">
                        <h4 class="card-title text-center">Nama Kandidat</h4>
                        <p class="card-text text-center text-primary"><b>8</b> Suara</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-4">
                <h3>Grafik Perolehan Suara</h3>
            </div>
            <div class="col-12 text-center mb-4">
                <p>Hasil perolehan suara</p>
            </div>
        </div>
    </div>
@endsection