@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="info-voting alert border" role="alert" >
                        Data voting akan muncul ketika waktu pemilihan umum telah selesai atau semua pemilih sudah melakukan voting.
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
                            <a href="/dashboard/voting/print?kandidat={{ request('kandidat') }}" target="_blank" class="btn btn-info mb-2 mb-md-0">
                                <i class="fa-solid fa-print"></i>
                                <span class="ml-1">Print Data Voting</span>
                            </a>
                            <a href="/dashboard/voting/printSuratSuara" target="_blank" class="btn btn-info mb-2 mb-md-0">
                                <i class="fa-solid fa-print"></i>
                                <span class="ml-1">Print Semua Surat Suara</span>
                            </a>
                            <a class="btn btn-danger konfirmasi_ulang_voting">
                                <i class="fa-solid fa-check-to-slot"></i>
                                <span class="ml-1">Ulang Voting</span>
                            </a>
                            @endif
                        </div>
                        <ul class="list-inline mb-0 mt-2 mt-md-0">
                            <li class="list-inline-item">
                                Search :
                            </li>
                            <li class="list-inline-item">
                                <form action="/dashboard/voting" class="input-search">
                                    <input class="form-control" type="text" name="search" id="search" value="{{  request('search') }}">
                                    <a class="delete-input-search btn btn-transparent" id="hapus_value">
                                        <i class="fa-solid fa-xmark" style="color: #a0a0a0;"></i>
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
                                        <td>
                                            @if (request('kandidat'))
                                                {{ request('kandidat') }}
                                            @else
                                                Semua kandidat
                                            @endif
                                        </td> 
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
                                            <td>{{ $voting->kandidat->nomor }} - {{ $voting->kandidat->nama }}</td>
                                            <td>{{ $voting->created_at }}</td>
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
                            Showing {{ $votings->firstItem() }} to {{ $votings->lastItem() }} of {{$votings->total()}} entries
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
@endsection

@push('script')
    <script>
        $("#hapus_value").on('click', function(event) {
            event.preventDefault();
            $('#search').attr('value', '');
            $("#search").focus();
        });

        $(document).ready(function(){
            $('.select-search').select2();
        });

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