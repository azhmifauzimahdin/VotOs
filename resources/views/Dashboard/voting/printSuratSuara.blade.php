@extends('layouts.print')

@push('head')
    <style>
        @page { margin: 0;}  
    </style>
@endpush

@section('container')
    @if (count($votings) > 0)
    @foreach ($votings as $voting)  
    <div class="row bg-primary text-white text-center pt-5 pb-4 mb-4">
        <h3 class="mb-2">SURAT SUARA PEMILIHAN UMUM</h3>
        <h6>KETUA UMUM IPM PIMPINAN RANTING IKATAN PELAJAR MUHAMMADIYAH SMA MUHAMMADIYAH 4 YOGYAKARTA </h6>
    </div>
    <div class="row text-center mb-4 py-2">
        <div class="d-block">
            <img src="data:image/svg+xml;base64,{{ base64_encode($voting->qr_code)}}" width="300" alt="QR Code"/>
        </div>
    </div>
    <div class="bg-primary text-white text-center mb-2 py-2">
        PERIODE {{ $tahunSekarang }}/{{ $tahunDepan }}
    </div>
    @endforeach
    @endif
@endsection