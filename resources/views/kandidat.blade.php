@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 px-3 text-light" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3" style="border-bottom-style: solid; border-width: 2px; border-radius: 50% ; border-image: linear-gradient(to right, #2dcddf, #2ddfbb,#2ddf8f) 1">Daftar Kandidat</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Pelajari visi misi kandidat sebelum memilih</p>
        </div>
    </div>
    <div class="px-5 mx-md-5">
        <div class="row row-cols-2 row-cols-md-4 g-2 g-md-4 d-flex justify-content-center px-md-5 mx-md-3 mb-5">
            @foreach ($kandidats as $kandidat) 
                <div class="col">
                    <div class="kotak-profil bg-white overflow-hidden" style="border-radius: 1vw; min-height: 100%; position:relative" >
                        <div class="candidate_thumb" style="height: 80%">
                            @if ($kandidat->foto)
                                <img src="{{ asset('storage/'. $kandidat->foto) }}" class="foto-kandidat" alt="Foto Kandidat" width="100%">
                            @else
                                <img src="{{ asset('storage/foto-kandidat/defaultKandidat.jpg') }}" class="foto-kandidat" alt="Foto Kandidat" width="100%">
                            @endif
                            <div class="px-3" style="position: absolute; z-index: 1; width: 100%; bottom: 0; text-align: right;">
                                <h5 class="text-primary">
                                    {{ $kandidat->nomor }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 pt-1 pb-3">
                            <h6 class="card-title text-end mb-4">{{ $kandidat->nama }}</h6>
                            <div class="px-3 mb-2" style="position: absolute; bottom:0; right: 0"> 
                                <a href="/kandidat/{{ $kandidat->slug }}" class="text-decoration-none">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection