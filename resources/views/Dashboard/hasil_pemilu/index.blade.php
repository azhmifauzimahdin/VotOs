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
                            <button class="btn btn-info" data-toggle="modal" data-target="#passwordModal">
                                <i class="fa-solid fa-print"></i>
                                <span class="ml-1">Cetak Hasil Pemilu</span>
                            </button>
                            @else
                            <a href="/dashboard/hasilPemilu/laporan" class="btn btn-info">
                                <i class="fa-solid fa-print"></i>
                                <span class="ml-1">Cetak Hasil Pemilu</span>
                            </a>
                            @endif
                        @endif
                        <a href="/dashboard/hasilPemilu/laporan" class="btn btn-success">
                            <i class="fa-solid fa-database"></i>
                            <span class="ml-1">Kelola Data Laporan</span>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col" class="col-3">JUMLAH PEMILIH</th>
                                    <th scope="col" class="col-3">JUMLAH KANDIDAT</th>
                                    <th scope="col" class="col-3">JUMLAH SUDAH MEMILIH</th>
                                    <th scope="col" class="col-3">JUMLAH BELUM MEMILIH</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $jumlahPemilih }} orang</td>
                                    <td>{{ $jumlahKandidat }} orang</td>
                                    <td>{{ $jumlahSudahMemilih }} orang</td>
                                    <td>{{ $jumlahBelumMemilih }} orang</td>
                                </tr>
                            </tbody>
                        </table>
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

    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Cetak Hasil Pemilu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/dashboard/hasilPemilu/print" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="info-voting alert border" role="alert" >
                            Buat password untuk mengamankan file hasil pemilu.
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autofocus>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <a class="show-hide-password"><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
                                    </span>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger mr-0" id="modal-close" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });

        $('#passwordModal').on('shown.bs.modal', function() {
            $('#password').focus();
        })

        $('#passwordModal').on('hidden.bs.modal', function() {
            $("#password").val("");
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }
        })
    </script>
@endpush