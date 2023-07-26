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
        .page-break {
            page-break-before: always;
        }
        
    </style>
@endpush

@section('container') 
    @include('partials.kop')
    <p class="text-center mb-0">HASIL PERHITUNGAN SUARA PEMILU</p>
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
                <th>Kandidat</th>
                <th>Jumlah Suara</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @if (count($kandidats))
                @foreach ($kandidats as $index => $kandidat)
                    <tr>
                        <td>{{ $index + $kandidats->firstItem() }}</td>
                        <td>{{ $kandidat->nomor}} - {{ $kandidat->nama }}</td>
                        <td>{{ $kandidat->jumlah_suara }}</td>
                        <td>{{ $kandidat->keterangan }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data voting</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="page-break"></div>
    @include('partials.kop')
    <p class="text-center">LEMBAR PENGESAHAN</p>
    <table class="w-100 text-center">
        <tr class="text-end">
            <td colspan="3" class="pb-3">Yogyakarta, {{ $waktuSekarang }}</td>
        </tr>
        <tr class="fw-bold align-top">
            <td style="width:42%; height: 120px">Ketua Umum</td>
            <td></td>
            <td style="width:42%">Sekretaris</td>
        </tr>
        <tr class="text-decoration-underline align-top">
            <td style="width:42%; height: 60px">{{ $pihak->ketua }}</td>
            <td></td>
            <td style="width:42%">{{ $pihak->sekretaris }}</td>
        </tr>
        <tr class="fw-bold align-top">
            <td style="width:42%; height: 120px">Waka Kesiswaan</td>
            <td></td>
            <td style="width:42%">Pembina IPM</td>
        </tr>
        <tr class="text-decoration-underline align-top">
            <td style="width:42%; height: 60px">{{ $pihak->kesiswaan }}</td>
            <td></td>
            <td style="width:42%">{{ $pihak->pembina }}</td>
        </tr>
        <tr class="fw-bold">
            <td colspan="3" style="height: 40px">Mengetahui,</td>
        </tr>
        <tr class="fw-bold align-top">
            <td colspan="3"  style="height: 120px">Kepala Sekolah</td>
        </tr>
        <tr class="text-decoration-underline">
            <td colspan="3">{{ $pihak->kepala_sekolah }}</td>
        </tr>
    </table>
@endsection