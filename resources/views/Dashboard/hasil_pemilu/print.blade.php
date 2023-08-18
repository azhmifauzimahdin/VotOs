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
        .w-4{
            width: 4%;
        }
        .w-14{
            width: 14%;
        }
        .w-29-4{
            width: 29.4%;
        }
        .w-42{
            width: 42%;
        }
        .h-40{
            height: 40px;
        }
        .h-60{
            height: 60px;
        }
        .h-120{
            height: 120px;
        }
        .paragraf{
            text-indent: 1.27cm;
            text-align: justify;
        }
    </style>
@endpush

@section('container') 
    @include('partials.kop')
    <p class="text-center mb-0">HASIL PERHITUNGAN SUARA PEMILU</p>
    <p class="text-center">KETUA UMUM IPM PIMPINAN RANTING IKATAN PELAJAR MUHAMMADIYAH SMA MUHAMMADIYAH 4 YOGYAKARTA PERIODE {{ $tahunSekarang }}/{{ $tahunDepan }}</p>
    <table class="w-100">
        <tr class="fw-bold">
            <td class="w-4">A.</td>
            <td colspan="2">PESERTA</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="paragraf">Seluruh peserta didik, guru, dan staff SMA Muhammadiyah 4 Yogyakarta dengan jumlah pemilih sebanyak {{ $laporan->jumlah_pemilih }} pemilih.</td>
        </tr>
        <tr class="fw-bold">
            <td class="pt-3">B.</td>
            <td class="pt-3" colspan="2">WAKTU DAN TEMPAT PELAKSANAAN</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="paragraf">Pemilihan ketua umum IPM pimpinan ranting Ikatan Pelajar Muhammadiyah SMA Muhammadiyah 4 Yogyakarta sudah dilaksanakan pada :</td>
        </tr>
        <tr>
            <td></td>
            <td class="w-14">Hari</td>
            <td>
                : {{ $hariMulaiPemilu }}
                @if($hariSelesaiPemilu)
                    - {{ $hariSelesaiPemilu }}
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Tanggal</td>
            <td>
                : {{ $tanggalMulaiPemilu }}
                @if( $tanggalSelesaiPemilu)
                    - {{ $tanggalSelesaiPemilu }}
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Waktu</td>
            <td>: {{ $waktuMulaiPemilu }} WIB - {{ $waktuSelesaiPemilu }} WIB</td>
        </tr>
        <tr>
            <td></td>
            <td>Tempat</td>
            <td>: SMA Muhammadiyah 4 Yogyakarta</td>
        </tr>
    </table>
    <table>
        <tr class="fw-bold">
            <td class="pt-3 w-4">C.</td>
            <td class="pt-3" colspan="2">HASIL PEMILU</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="paragraf">Hasil perolehan suara dari masing-masing kandidat ketua umum IPM pimpinan ranting Ikatan Pelajar Muhammadiyah SMA Muhammadiyah 4 Yogyakarta adalah sebagai berikut.</td>
        </tr>
        <tr>
            <td></td>
            <td class="w-29-4">Jumlah Kandidat</td>
            <td>: {{ $laporan->jumlah_kandidat }} orang</td>
        </tr>
        <tr>
            <td></td>
            <td class="w-29-4">Jumlah Pemilih</td>
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
        <tr>
            <td></td>
            <td class="text-center pt-3" colspan="2">Tabel 1. Perolehan Suara</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">
                <table class="tabel-voting mt-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kandidat</th>
                            <th>Jumlah Suara</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($kandidats))
                            @foreach ($kandidats as $index => $kandidat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kandidat->nomor}} - {{ $kandidat->nama }}</td>
                                    <td>{{ count($kandidat->suratSuara) ? $kandidat->suratSuara[0]->perolehan_suara : 0  }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data voting</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="paragraf pt-2 pb-5">Sesuai dengan pemilihan umum yang telah diikuti oleh seluruh peserta didik, guru, dan staff SMA Muhammadiyah 4 Yogyakarta. Maka susunan IPM pimpinan ranting Ikatan Pelajar Muhammadiyah SMA Muhammadiyah 4 Yogyakarta periode {{ $tahunSekarang }}/{{ $tahunDepan }} adalah sebagai berikut.</td>
        </tr>
        <tr>
            <td></td>
            <td class="text-center pt-4" colspan="2">Tabel 2. Susunan Pengurus IPM Baru</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">
                <table class="tabel-voting mt-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kandidat</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($kandidats))
                            @foreach ($kandidats as $index => $kandidat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kandidat->nomor}} - {{ $kandidat->nama }}</td>
                                    <td>
                                        @if($loop->iteration < 4)
                                            {{ $keterangan[$loop->iteration - 1] }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data voting</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
    @include('partials.kop')
    <p class="text-center">LEMBAR PENGESAHAN</p>
    <table class="w-100 text-center">
        <tr class="text-end">
            <td colspan="3" class="pb-3">Yogyakarta, {{ $waktuSekarang }}</td>
        </tr>
        <tr class="fw-bold align-top">
            <td class="w-42 h-120">Ketua Umum</td>
            <td></td>
            <td class="w-42">Sekretaris</td>
        </tr>
        <tr class="text-decoration-underline align-top">
            <td class="h-60">{{ $laporan->ketua }}</td>
            <td></td>
            <td>{{ $laporan->sekretaris }}</td>
        </tr>
        <tr class="fw-bold align-top">
            <td class="h-120">Waka Kesiswaan</td>
            <td></td>
            <td>Pembina IPM</td>
        </tr>
        <tr class="text-decoration-underline align-top">
            <td class="h-60">{{ $laporan->kesiswaan }}</td>
            <td></td>
            <td>{{ $laporan->pembina }}</td>
        </tr>
        <tr class="fw-bold">
            <td colspan="3" class="h-40">Mengetahui,</td>
        </tr>
        <tr class="fw-bold align-top">
            <td colspan="3" class="h-120">Kepala Sekolah</td>
        </tr>
        <tr class="text-decoration-underline">
            <td colspan="3">{{ $laporan->kepala_sekolah }}</td>
        </tr>
    </table>
@endsection