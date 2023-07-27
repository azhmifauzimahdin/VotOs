@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 px-3 text-light bg-votos">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3 garis-bawah-gradient">Daftar Kandidat</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Pelajari visi misi kandidat sebelum memilih</p>
        </div>
    </div>
    <div class="px-5 mx-md-5">
        <div class="row row-cols-2 row-cols-md-4 g-2 g-md-4 d-flex justify-content-center px-md-5 mx-md-3 mb-5">
            @foreach ($kandidats as $kandidat) 
                <div class="col">
                    <div class="kotak-profil bg-white overflow-hidden">
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
                            <div class="px-3 mb-2 lihat-detail"> 
                                <a href="/kandidat/{{ $kandidat->slug }}" class="text-decoration-none">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection