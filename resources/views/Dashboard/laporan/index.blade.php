@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="info-voting alert border" role="alert" >
                        Lengkapi data laporan sebelum melakukan cetak hasil pemilu.
                    </div>
                    <div class="mb-3">
                    @if (count($laporans) == 0)   
                    <a href="/dashboard/hasilPemilu/laporan/create" class="btn btn-primary">
                        <i class="fa-solid fa-plus pr-1"></i>
                        Lengkapi {{ $title }}
                    </a>
                    @endif
                    <a href="/dashboard/voting" class="btn btn-success">
                        <i class="fa-solid fa-database"></i>
                        <span class="ml-1">Data Voting</span>
                    </a>
                    <a href="/dashboard/hasilPemilu" class="btn btn-success">
                        <i class="fa-solid fa-database"></i>
                        <span class="ml-1">Hasil Pemilu</span>
                    </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">KETUA</th>
                                    <th scope="col">SEKRETARIS</th>
                                    <th scope="col">WAKA KESISWAAN</th>
                                    <th scope="col">PEMBINA IPM</th>
                                    <th scope="col">KEPALA SEKOLAH</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($laporans))
                                    @foreach ($laporans as $laporan)
                                        <tr>
                                            <td>{{ $laporan->ketua }}</td>
                                            <td>{{ $laporan->sekretaris }}</td>
                                            <td>{{ $laporan->kesiswaan }}</td>
                                            <td>{{ $laporan->pembina }}</td>
                                            <td>{{ $laporan->kepala_sekolah }}</td>
                                            <td class="text-nowrap">
                                                <a href="/dashboard/hasilPemilu/laporan/{{ $laporan->id }}/edit" class="btn btn-sm bg-warning">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form action="/dashboard/hasilPemilu/laporan/{{ $laporan->id }}" id="formHapus" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger border-0 konfirmasi_hapus">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center py-2">Tidak ada data yang ditemukan</td>
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

@push('script')
    <script>
        $("#hapus_value").on('click', function(event) {
            event.preventDefault();
            $('#search').val('');
            $("#search").focus();
        });

        $('.konfirmasi_hapus').click(function(event) {
            var form =  $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data Anda tidak dapat dikembalikan.",
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
                        form.submit();
                    })
                }
            })
        });
    </script>
@endpush