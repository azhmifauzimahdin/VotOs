@extends('dashboard.layouts.main')

@section('container')
<div class="main-body">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        @if ($kandidat->foto)
                        <img src="{{ asset('storage/public/'.$kandidat->foto) }}" alt="Admin" class="rounded-circle aspect-ratio-1-1" width="150">
                        @else
                        <img src="{{ asset('storage/public/foto-kandidat/defaultKandidat.jpg') }}" alt="Admin" class="rounded-circle aspect-ratio-1-1" width="150">
                        @endif
                        <div class="mt-3 w-100">
                            <h4>{{ $kandidat->nama }}</h4>
                            <p class="text-secondary mb-1">{{ $kandidat->kelas }}</p>
                            <hr>
                            <a class="text-decoration-none" href="/dashboard/kandidat">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nomor Kandidat</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $kandidat->nomor }}   
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nama Lengkap</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $kandidat->nama }}   
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Jabatan Sebelumnya</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $kandidat->jabatan_sebelumnya }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Kelas</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $kandidat->kelas }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Jenis Kelamin</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $kandidat->jenis_kelamin }}   
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Tempat, Tanggal Lahir</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $kandidat->tempat_lahir }}, {{ Carbon\Carbon::parse($kandidat->tanggal_lahir)->translatedFormat('d F Y') }}  
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Alamat</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $kandidat->alamat }} 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Visi</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {!! $kandidat->visi !!}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Misi</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {!! $kandidat->misi !!}
                        </div>
                    </div>
                </div>
            </div>
      </div>
    </div>
</div>
@endsection