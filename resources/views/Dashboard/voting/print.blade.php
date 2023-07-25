@extends('layouts.print')

@push('head')
    <style>
        @page { 
            margin: 90px;
        }  
        .tabel-voting{
            width: 100%;
            border-collapse: collapse;
            margin-top: 14px;
        }
        .tabel-voting>thead>tr>th, .tabel-voting>tbody>tr>td {
            border: 1px solid black;
            padding-left: 4px;
        }
    </style>
@endpush

@section('container')
    <table class="w-100">
        <tr>
            <td style="width: 10%">
                <img src="{{ public_path() . '/img/logo_IPM.png' }}" alt="logo IMP" width="100%">
                {{-- <img src="/img/logo_IPM.png" alt="logo IMP" width="100%"> --}}
            </td>
            <td class="text-center px-3">
                <h6 class="mb-1">PANITIA PEMILU</h6>
                <h6>KETUA UMUM IPM PIMPINAN RANTING IKATAN PELAJAR MUHAMMADIYAH SMA MUHAMMADIYAH 4 YOGYAKARTA</h6>
                <p class="mb-0">Jl. Mondorakan No. 51 Kotagede Yogyakarta. 55172</p> 
                <p>Telp: 0274371185 / 2840268</p>
            </td>
            <td style="width: 16%;">
                <img src="{{ public_path() . '/img/qrcode.png' }}" alt="QR Code" width="100%">
                {{-- <img src="/img/qrcode.png" alt="QR Code" width="100%"> --}}
            </td>
        </tr>
    </table>
    <hr class="mt-0" style="border-top: 2px solid black;">
    <p class="text-center mb-0">REKAPITULASI HASIL PEMILU</p>
    <p class="text-center">KETUA UMUM IPM PIMPINAN RANTING IKATAN PELAJAR MUHAMMADIYAH SMA MUHAMMADIYAH 4 YOGYAKARTA PERIODE {{ $tahunSekarang }}/{{ $tahunDepan }}</p>
    <table>
        <tr>
            <td>Jumlah Pemilih</td>
            <td>: {{ $jumlahPemilih }} orang</td>
        </tr>
        <tr>
            <td>Jumlah Kandidat</td>
            <td>: {{ $jumlahKandidat }} orang</td>
        </tr>
        <tr>
            <td class="pe-5">Jumlah Sudah Memilih</td>
            <td>: {{ $jumlahSudahMemilih }} orang</td>
        </tr>
        <tr>
            <td class="pe-5">Jumlah Tidak Memilih</td>
            <td>: {{ $jumlahTidakMemilih }} orang</td>
        </tr>
    </table>
    <table class="tabel-voting">
        <thead>
            <tr>
                <th>No</th>
                <th>Pemilih</th>
                <th>Kandidat</th>
                <th>Waktu Voting</th>
            </tr>
        </thead>
        <tbody>
            @if (count($votings))
                @foreach ($votings as $index => $voting)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $voting->pemilih->nama }}</td>
                        <td>{{ $voting->kandidat->nomor }} - {{ $voting->kandidat->nama }}</td>
                        <td>{{ $voting->created_at }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data voting</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection