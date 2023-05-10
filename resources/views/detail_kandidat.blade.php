@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 text-light" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3" style="border-bottom-style: solid; border-width: 2px; border-radius: 50% ; border-image: linear-gradient(to right, #2dcddf, #2ddfbb,#2ddf8f) 1">Detail Kandidat</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Pelajari visi misi kandidat sebelum memilih</p>
        </div>
    </div>
    <div class="px-5 mb-4">
        <div class="row d-flex justify-content-center g-2">
            <div class="col-md-3 border bg-light p-5 mx-2 " style="height: 100%">
                <div style="margin: 0 auto; width: 140px">
                    <img src="https://akcdn.detik.net.id/community/media/visual/2023/04/04/siswa-sma-pradita-dirgantara-diterima-di-10-kampus-luar-negeri.jpeg?w=700&q=90" alt="Foto Kandidat" class="object-fit-contain border rounded-circle shadow-4-strong" style="width: 140px; height: 140px; margin: 0 auto">
                </div>
                <h5 class="text-center pt-3">Azhmi Fauzi Mahdin</h5>
                <hr>    
                <a href="/kandidat" class="btn btn-success rounded-pill w-100 mt-2">Daftar Kandidat</a>
            </div>
            <div class="col-md-6 border bg-light py-3 px-4 mx-2">
                <div class="row border-bottom py-2">
                    <div class="col-md-4"><b>Nomor Kandidat</b></div>
                    <div class="col-md-8">1</div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-md-4"><b>Nama Lengkap</b></div>
                    <div class="col-md-8">Azhmi Fauzi Mahdin</div>
                </div>
                <div class="row border-bottom py-2">
                    <div class="col-md-4"><b>Visi</b></div>
                    <div class="col-md-8">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam, saepe sequi repellat quis sint eos magni quaerat a vel tempore, cupiditate libero facere impedit nesciunt totam dignissimos labore iste rerum vitae in blanditiis quo cum sapiente! Quia consectetur at natus rem earum eaque libero provident dolorem tenetur voluptatum. Magnam, est!</div>
                </div>
                <div class="row py-2">
                    <div class="col-md-4"><b>Misi</b></div>
                    <div class="col-md-8">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum ratione nisi, voluptatem hic pariatur repudiandae recusandae fugit culpa deserunt obcaecati?</div>
                </div>
            </div>
        </div>
    </div>
@endsection