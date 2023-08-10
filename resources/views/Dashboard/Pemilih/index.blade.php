@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">Data Pemilih ({{ $objek }})</h5>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row d-flex justify-content-between mb-3 mx-0">
                        <div>
                            <a href="/dashboard/pemilih/{{ $role }}/create" class="btn btn-primary">
                                <i class="fa-solid fa-plus pr-1"></i>
                                Tambah Data Pemilih
                            </a>
                            <a href="/dashboard/pemilih/{{ $role }}/import" class="btn btn-success">
                                <i class="fa-solid fa-file-arrow-up pr-1"></i>
                                Import Data {{ $objek }}
                            </a>
                            <a href="/dashboard/pemilih/{{ $role }}/export" class="btn btn-info">
                                <i class="fa-solid fa-file-export pr-1"></i>
                                Export Data
                            </a>
                        </div>
                        <ul class="list-inline mb-0 mt-2 mt-md-0">
                            <li class="list-inline-item">
                                Search :
                            </li>
                            <li class="list-inline-item">
                                <form action="/dashboard/pemilih/{{ $role }}" class="input-search">
                                    <input class="form-control" type="text" name="search" id="search" value="{{  request('search') }}">
                                    <a class="delete-input-search btn btn-transparent" id="hapus_value">
                                        <i class="fa-solid fa-xmark clr-gray"></i>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA</th>
                                    @if ($role === 'siswa')
                                    <th scope="col">KELAS</th>                                        
                                    @else
                                    <th scope="col">JABATAN</th>                                           
                                    @endif
                                    <th scope="col">JENIS KELAMIN</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pemilihs))
                                    @foreach ($pemilihs as $index => $pemilih)
                                        <tr>
                                            <td>{{ $index + $pemilihs->firstItem() }}</td>
                                            <td>{{ $pemilih->nama }}</td>
                                            @if ($role === 'siswa')
                                                @if ($pemilih->kelas)
                                                    <td>{{ $pemilih->kelas->nama }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                            @else
                                                @if ($pemilih->jabatan)
                                                    <td>{{ $pemilih->jabatan->nama }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                            @endif
                                            <td>{{ $pemilih->jenis_kelamin }}</td>
                                            <td>{{ $pemilih->email }}</td>
                                            <td class="text-nowrap">
                                                <a href="/dashboard/pemilih/{{ $role }}/{{ $pemilih->slug }}/edit" class="btn btn-sm bg-warning">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                @if (!$waktupemilu)
                                                <form action="/dashboard/pemilih/{{ $role }}/{{ $pemilih->slug }}" id="formHapus" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger border-0 konfirmasi_hapus">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-2">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-between mx-1">
                        <div>
                            Showing {{ $pemilihs->firstItem() }} to {{ $pemilihs->lastItem() }} of {{$pemilihs->total()}} entries
                        </div>
                        <div class="mt-2 mt-md-0">
                            {{ $pemilihs->onEachSide(0)->links() }}
                        </div>
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