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
                    <div class="row d-flex justify-content-between mb-3 mx-0">
                        <a href="/dashboard/kandidat/create" class="btn btn-primary">
                            <i class="fa-solid fa-plus pr-1"></i>
                            Tambah {{ $title }}
                        </a>
                        <ul class="list-inline mb-0 mt-2 mt-md-0">
                            <li class="list-inline-item">
                                Search :
                            </li>
                            <li class="list-inline-item">
                                <form action="/dashboard/kandidat">
                                    <input class="form-control" type="text" name="search" id="search" value="{{  request('search') }}">
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
                                    <th scope="col">JABATAN</th>
                                    <th scope="col">KELAS</th>
                                    <th scope="col">JENIS KELAMIN</th>
                                    <th scope="col">FOTO</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($kandidats))
                                    @foreach ($kandidats as $kandidat)
                                        <tr>
                                            <td class="align-middle">{{ $kandidat->nomor }}</td>
                                            <td class="align-middle">{{ $kandidat->nama }}</td>
                                            <td class="align-middle">{{ $kandidat->jabatan }}</td>
                                            <td class="align-middle">{{ $kandidat->kelas->nama }}</td>
                                            <td class="align-middle">{{ $kandidat->jenis_kelamin }}</td>
                                            <td>
                                                @if ($kandidat->foto)
                                                    <img src="{{ asset('storage/'.$kandidat->foto) }}" style="width: 80px; aspect-ratio:3/4" alt="Foto kandidat">    
                                                @else
                                                    <img src="{{ asset('AdminLTE') }}/dist/img/default_user.jpg" style="width: 80px; aspect-ratio:3/4" alt="Foto kandidat">    
                                                @endif
                                            </td>
                                            <td class="text-nowrap align-middle">
                                                <a href="/dashboard/kandidat/{{ $kandidat->slug }}" class="btn btn-sm bg-info">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                                <a href="/dashboard/kandidat/{{ $kandidat->slug }}/edit" class="btn btn-sm bg-warning">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form action="/dashboard/kandidat/{{ $kandidat->slug }}" name="formDeletee" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf 
                                                    <button class="btn btn-sm bg-danger border-0 konfirmasi_hapus" type="submit">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-2">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-between mx-1">
                        <div>
                            Showing {{ $kandidats->firstItem() }} to {{ $kandidats->lastItem() }} of {{$kandidats->total()}} entries
                        </div>
                        <div class="mt-2 mt-md-0">
                            {{ $kandidats->onEachSide(0)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
@endsection