@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="info-voting alert border" role="alert" >
                        Data hasil pemilu akan muncul ketika waktu pemilihan umum telah selesai atau semua pemilih sudah melakukan voting. Lengkapi data laporan sebelum melakukan cetak hasil pemilu.
                    </div>
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="mb-3">
                        @if ($cekAkhirPemilu)   
                            @if ($laporan)
                            <a href="/dashboard/hasilPemilu/print" class="btn btn-info mr-1" target="_blank">
                                <i class="fa-solid fa-print"></i>
                                <span class="ml-1">Cetak Hasil Pemilu</span>
                            </a>
                            @else
                            <a href="/dashboard/hasilPemilu/laporan" class="btn btn-info mr-1">
                                <i class="fa-solid fa-print"></i>
                                <span class="ml-1">Cetak Hasil Pemilu</span>
                            </a>
                            @endif
                            <a href="/dashboard/hasilPemilu/laporan" class="btn btn-success">
                                <i class="fa-solid fa-database"></i>
                                <span class="ml-1">Kelola Data Laporan</span>
                            </a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">KANDIDAT</th>
                                    <th scope="col">JUMLAH SUARA</th>
                                    <th scope="col">JABATAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($kandidats) > 0)
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
                                        <td colspan="4" class="text-center py-2">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection