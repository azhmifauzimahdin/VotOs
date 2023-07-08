@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="row alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row d-flex justify-content-between mb-3">
                        <a href="/dashboard/user/create" class="btn btn-primary">
                            <i class="fa-solid fa-plus pr-1"></i>
                            Tambah {{ $title }}
                        </a>
                        <ul class="list-inline mb-0 mt-2 mt-md-0">
                            <li class="list-inline-item">
                                Search :
                            </li>
                            <li class="list-inline-item">
                                <form action="/dashboard/user">
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
                                    <th scope="col">USERNAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">JENIS KELAMIN</th>
                                    <th scope="col">LEVEL</th>
                                    <th scope="col">FOTO</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users))
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td class="align-middle">{{ $index + $users->firstItem() }}</td>
                                            <td class="align-middle">{{ $user->nama }}</td>
                                            <td class="align-middle">{{ $user->username }}</td>
                                            <td class="align-middle">{{ $user->email }}</td>
                                            <td class="align-middle">{{ $user->jenis_kelamin }}</td>
                                            <td class="align-middle">{{ $user->level }}</td>
                                            <td class="pb-2">
                                                @if ($user->foto)
                                                    <img src="{{ asset('storage/'.$user->foto) }}" style="width: 80px; aspect-ratio:3/4" alt="Foto kandidat">    
                                                @else
                                                    <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg" style="width: 80px; aspect-ratio:3/4" alt="Foto kandidat">    
                                                @endif
                                            </td>
                                            <td class="text-nowrap align-middle">
                                                <a href="/dashboard/user/{{ $user->slug }}/edit" class="btn btn-sm bg-warning">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form action="/dashboard/user/{{ $user->slug }}" name="formDeletee" method="post" class="d-inline">
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
                                        <td colspan="7" class="text-center py-2">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-between mx-1">
                        <div>
                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{$users->total()}} entries
                        </div>
                        <div class="mt-2 mt-md-0">
                            {{ $users->onEachSide(0)->links() }}
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