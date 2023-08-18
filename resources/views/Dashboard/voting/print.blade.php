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
        .w-4{
            width: 4%;
        }
        .w-29-6{
            width: 29.6%;
        }
        .paragraf{
            text-indent: 1.27cm;
            text-align: justify;
        }
    </style>
@endpush

@section('container')
    @include('partials.kop')
    <p class="text-center mb-0">REKAPITULASI DATA VOTING</p>
    <p class="text-center">KETUA UMUM IPM PIMPINAN RANTING IKATAN PELAJAR MUHAMMADIYAH SMA MUHAMMADIYAH 4 YOGYAKARTA PERIODE {{ $tahunSekarang }}/{{ $tahunDepan }}</p>
    <table class="w-100">
        <tr class="fw-bold">
            <td class="w-4">A.</td>
            <td colspan="2">PESERTA</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="paragraf">Seluruh peserta didik, guru, dan staff SMA Muhammadiyah 4 Yogyakarta dengan detail jumlah sebagai berikut.</td>
        </tr>
        <tr>
            <td></td>
            <td class="w-29-6 px-0">Jumlah Pemilih</td>
            <td>: {{ $laporan->jumlah_pemilih }} orang</td>
        </tr>
        <tr>
            <td></td>
            <td class="pe-5">Jumlah Sudah Memilih</td>
            <td>: {{ $laporan->jumlah_sudah_memilih }} orang</td>
        </tr>
        <tr>
            <td></td>
            <td class="pe-5">Jumlah Tidak Memilih</td>
            <td>: {{ $laporan->jumlah_belum_memilih }} orang</td>
        </tr>
        <tr class="fw-bold">
            <td class="pt-3">B.</td>
            <td class="pt-3" colspan="2">DATA VOTING</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="paragraf">Data pemilihan ketua umum IPM pimpinan ranting Ikatan Pelajar Muhammadiyah SMA Muhammadiyah 4 Yogyakarta.</td>
        </tr>
        <tr>
            <td></td>
            <td>Jumlah Kandidat</td>
            <td>: {{ $laporan->jumlah_kandidat }} orang</td>
        </tr>
        <tr>
            <td></td>
            <td class="text-center pt-3" colspan="2">
                Tabel 1. Data Voting 
                @if ($filterKandidat)
                    Kandidat {{ $filterKandidat }} 
                @else   
                    Semua kandidat
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">
                <table class="tabel-voting mt-1">
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
                                    <td>{{ $voting->waktu }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                @if ($filterKandidat)
                                    <td colspan="4" class="text-center">Tidak ada data voting untuk kandidat {{ $filterKandidat }}</td>
                                @else   
                                    <td colspan="4" class="text-center">Tidak ada data voting</td>
                                @endif
                            </tr>
                        @endif
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
@endsection