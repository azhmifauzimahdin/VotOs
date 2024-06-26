@extends('layouts.print')

@push('head')
    <style>
        @page { 
            margin: 90px;
        }
        .garis-bawah{
            border-bottom: 2px solid black;
        }
    </style>
@endpush

@section('container')
    @if (count($votings) > 0)
    @foreach ($votings as $voting)  
    <div class="row text-center garis-bawah mb-4 px-4">
        <h5 class="mb-2">SURAT SUARA PEMILIHAN UMUM</h5>
        <h6 class="mb-3">KETUA IPM PIMPINAN RANTING IKATAN PELAJAR MUHAMMADIYAH SMA MUHAMMADIYAH 4 YOGYAKARTA </h6>
    </div>
    <div class="row text-center mb-3">
        <div class="d-block">
            <img src="data:image/svg+xml;base64,{{ base64_encode($voting->qr_code)}}" width="300" alt="QR Code"/>
        </div>
    </div>
    <div class="text-center mb-3">
        PERIODE {{ $tahunSekarang }}/{{ $tahunDepan }}
    </div>
    @endforeach
    @endif
@endsection