@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="info-voting alert border" role="alert" >
                        Data voting akan muncul ketika waktu pemilu telah selesai atau semua pemilih sudah melakukan voting. Lengkapi data laporan sebelum melakukan cetak Data Voting. Untuk kelola data laporan terdapat di menu hasil pemilu. Tombol 'Reset Voting' digunakan ketika ulang pemilu atau pemilu periode baru.
                    </div>
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="/dashboard/voting" class="needs-validation">
                        <div class="form-row">
                            <div class="col-md-4 mb-2 mb-md-0">
                                <label for="kandidat">Kandidat</label>
                                <select class="form-control select-search" name="kandidat" id="kandidat">
                                    <option value="" {{ request('kandidat') == "" ? "selected" : "" }}>Semua kandidat</option>
                                    @foreach ($kandidats as $kandidat)
                                        <option value="{{ $kandidat->nama }}" {{ request('kandidat') == $kandidat->nama ? "selected" : "" }}>{{ $kandidat->nomor }} - {{ $kandidat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-success mr-2">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row d-flex justify-content-between mb-3 mx-0">
                        <div class="tombol">
                            @if ($cekAkhirPemilu) 
                                <button class="btn btn-info mb-2 mb-md-0" data-toggle="modal" data-target="#passwordModal" {{ $laporan ? null : "disabled" }}>
                                    <i class="fa-solid fa-print"></i>
                                    <span class="ml-1">Cetak Data Voting</span>
                                </button>
                                <a href="/dashboard/voting/printSuratSuara" target="_blank" class="btn btn-info mb-2 mb-md-0">
                                    <i class="fa-solid fa-print"></i>
                                    <span class="ml-1">Cetak Surat Suara</span>
                                </a>
                                <a class="btn btn-danger konfirmasi_ulang_voting">
                                    <i class="fa-solid fa-check-to-slot"></i>
                                    <span class="ml-1">Reset Voting</span>
                                </a>
                            @endif
                        </div>
                        <ul class="list-inline mb-0 mt-2 mt-md-0">
                            <li class="list-inline-item">
                                Cari :
                            </li>
                            <li class="list-inline-item">
                                <form action="/dashboard/voting" class="input-search">
                                    <input class="form-control" type="text" name="search" id="search" value="{{  request('search') }}">
                                    <a class="delete-input-search btn btn-transparent" id="hapus_value">
                                        <i class="fa-solid fa-xmark clr-gray"></i>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @if (request('kandidat'))  
                        <div class="table-scrollable table-scrollable-borderless"> 
                            <table class="table table-hover table-light"> 
                                <tbody> 
                                    <tr> 
                                        <td width="20%">Kandidat</td> 
                                        <td width="1%">:</td> 
                                        <td>{{ request('kandidat') }}</td> 
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">PEMILIH</th>
                                    <th scope="col">KANDIDAT</th>
                                    <th scope="col">WAKTU VOTING</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($votings))
                                    @foreach ($votings as $index => $voting)
                                        <tr>
                                            <td>{{ $index + $votings->firstItem() }}</td>
                                            <td>{{ $voting->pemilih->nama }}</td>
                                            <td>{{ $voting->kandidat_id }} - {{ $voting->kandidat->nama }}</td>
                                            <td>{{ $voting->waktu }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        @if (request('kandidat'))
                                        <td colspan="4" class="text-center py-2">Tidak ada data voting untuk kandidat {{ request('kandidat') }}.</td>
                                        @else
                                        <td colspan="4" class="text-center py-2">Tidak ada data yang ditemukan</td>
                                        @endif
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($cekAkhirPemilu) 
                    <div class="row d-flex justify-content-between mx-1">
                        <div>
                            Menampilkan {{ $votings->firstItem() }} sampai {{ $votings->lastItem() }} dari {{$votings->total()}} entri
                        </div>
                        <div class="mt-2 mt-md-0">
                            {{ $votings->onEachSide(0)->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Cetak Data Voting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/dashboard/voting/print" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="info-voting alert border" role="alert" >
                            Buat password untuk mengamankan file data voting.
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
                        @if (request('kandidat'))
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="filter_kandidat" name="filter_kandidat" value="{{ request('kandidat') }}">
                        </div>
                        @endif
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
        $("#hapus_value").on('click', function(event) {
            event.preventDefault();
            $('#search').val('');
            $("#search").focus();
        });

        $(document).ready(function(){
            $('.select-search').select2();
        });

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

        $('.konfirmasi_ulang_voting').click(function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Semua data hasil voting akan dihapus dan data tidak dapat dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Sukses!',
                    'Data berhasil dihapus.',
                    'success'
                    ).then(function(){
                        window.location.href = "/dashboard/voting/ulangvoting";
                    })
                }
            })
        });
        
    </script>
@endpush