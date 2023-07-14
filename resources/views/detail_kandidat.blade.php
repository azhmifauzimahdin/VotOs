@extends('layouts.main')

@section('container')
    <div class="row bg-primary mb-4 px-3 text-light" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3" style="border-bottom-style: solid; border-width: 2px; border-radius: 50% ; border-image: linear-gradient(to right, #2dcddf, #2ddfbb,#2ddf8f) 1">Detail Kandidat</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Pelajari visi misi kandidat sebelum memilih</p>
        </div>
    </div>
    <div class="px-3 px-md-5 mx-md-5 mb-4">
        <div class="row gutters-sm px-md-5 mx-md-5">
            <div class="col-md-4 mb-3">
                <div class="card border overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($kandidat->foto)
                            <img src="{{ asset('storage/'.$kandidat->foto) }}" alt="Admin" class="rounded-circle" width="120" style="aspect-ratio:1/1">
                            @else
                            <img src="{{ asset('AdminLTE') }}/dist/img/default_user.jpg" alt="Admin" class="rounded-circle" width="120" style="aspect-ratio:1/1">
                            @endif
                            <div class="mt-3 w-100">
                                <h5>{{ $kandidat->nama }}</h5>
                                <p>
                                    @if ($kandidat->kelas)
                                        {{ $kandidat->kelas->nama }}   
                                    @else
                                        -   
                                    @endif
                                </p>
                                <hr>
                                <a href="/kandidat" class="text-decoration-none">Daftar Kandidat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3 border">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-md-0">Nomor Kandidat</h6>
                            </div>
                            <div class="col-sm-8 ps-md-4">
                                {{ $kandidat->nomor }}
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-md-0">Nama Lengkap</h6>
                            </div>
                            <div class="col-sm-8 ps-md-4">
                                {{ $kandidat->nama }}   
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-md-0">Jabatan Sebelumnya</h6>
                            </div>
                            <div class="col-sm-8 ps-md-4">
                                {{ $kandidat->jabatan }}   
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-md-0">Kelas</h6>
                            </div>
                            <div class="col-sm-8 ps-md-4">
                                @if ($kandidat->kelas)
                                    {{ $kandidat->kelas->nama }}   
                                @else
                                    -   
                                @endif   
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-md-0">Jenis Kelamin</h6>
                            </div>
                            <div class="col-sm-8 ps-md-4">
                                {{ $kandidat->jenis_kelamin }}   
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-md-0">Tempat, Tanggal Lahir</h6>
                            </div>
                            <div class="col-sm-8 ps-md-4">
                                {{ $kandidat->tempat_lahir }}, {{ Carbon\Carbon::parse($kandidat->tanggal_lahir)->translatedFormat('d F Y') }}  
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-md-0">Alamat</h6>
                            </div>
                            <div class="col-sm-8 ps-md-4">
                                {{ $kandidat->alamat }}
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-md-0">Visi</h6>
                            </div>
                            <div class="col-sm-8 ps-md-4">
                                {!! $kandidat->visi !!}
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-md-0">Misi</h6>
                            </div>
                            <div class="col-sm-8 ps-md-4">
                                {!! $kandidat->misi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection