@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 text-light" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3" style="border-bottom-style: solid; border-width: 2px; border-radius: 50% ; border-image: linear-gradient(to right, #2dcddf, #2ddfbb,#2ddf8f) 1">Daftar Kandidat</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Pelajari visi misi kandidat sebelum memilih</p>
        </div>
    </div>
    <div class="px-5 mx-md-5">
        <div class="row row-cols-2 row-cols-md-4 g-2 g-md-4 mb-5 d-flex justify-content-center px-md-5 mx-md-3">
            <div class="col">
                <div class="border bg-white overflow-hidden" style="border-radius: 1vw">
                    <div class="candidate_thumb" style="height: 80%">
                        <img src="https://akcdn.detik.net.id/community/media/visual/2023/04/04/siswa-sma-pradita-dirgantara-diterima-di-10-kampus-luar-negeri.jpeg?w=700&q=90" alt="Foto Kandidat" width="100%" height="300px">
                        <div class="px-3" style="position: absolute; z-index: 1; width: 100%; bottom: 0; text-align: right;"><h5 class="text-primary">02</h5></div>
                    </div>
                    <div class="px-3 pt-2 pb-3">
                        <h6 class="card-title text-end">Azhmi Fauzi Mahdin</h6>
                        <div class="d-flex justify-content-end"> 
                            <a href="/kandidat/detail" class="text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="border bg-white overflow-hidden" style="border-radius: 1vw">
                    <div class="candidate_thumb" style="height: 80%">
                        <img src="https://akcdn.detik.net.id/community/media/visual/2023/04/04/siswa-sma-pradita-dirgantara-diterima-di-10-kampus-luar-negeri.jpeg?w=700&q=90" alt="Foto Kandidat" width="100%" height="300px">
                        <div class="px-3" style="position: absolute; z-index: 1; width: 100%; bottom: 0; text-align: right;"><h5 style="color: #2C6EFD">02</h5></div>
                    </div>
                    <div class="px-3 pt-2 pb-3">
                        <h6 class="card-title text-end">Azhmi Fauzi Mahdin</h6>
                        <div class="d-flex justify-content-end"> 
                            <a href="/kandidat/detail" class="text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection