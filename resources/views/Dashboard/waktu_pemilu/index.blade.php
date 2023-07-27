@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-sm-7">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <div class="info-voting alert border" role="alert">
                        Waktu pemilu otomatis terhapus jika melakukan reset voting di menu data voting.
                    </div>
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (count($pemilus) == 0)   
                        <div class="row d-flex justify-content-between mb-3 mx-0">
                            <a href="/dashboard/waktupemilu/create" class="btn btn-primary">
                                <i class="fa-solid fa-plus pr-1"></i>
                                Tambah {{ $title }}
                            </a>
                        </div>
                    @else
                        @if($cek)
                            <div class="row d-flex justify-content-between mb-3 mx-0">
                                <form action="/dashboard/waktupemilu/selesai" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-regular fa-clock pr-1"></i>
                                        Waktu Pemilu Selesai
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">WAKTU MULAI</th>
                                    <th scope="col">WAKTU SELESAI</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pemilus))
                                    @foreach ($pemilus as $pemilu)
                                        <tr>
                                            <td>{{ $pemilu->mulai }}</td>
                                            <td>{{ $pemilu->selesai }}</td>
                                            <td class="text-nowrap">
                                                <a href="/dashboard/waktupemilu/{{ $pemilu->id }}/edit" class="btn btn-sm bg-warning">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
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