@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-sm-6">
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
                    <div class="row d-flex justify-content-between mb-3 mx-1">
                        <a href="/dashboard/kelas/create" class="btn btn-primary">
                            <i class="fa-solid fa-plus pr-1"></i>
                            Tambah {{ $title }}
                        </a>
                        <ul class="list-inline mb-0 mt-2 mt-md-0">
                            <li class="list-inline-item">
                                Search :
                            </li>
                            <li class="list-inline-item">
                                <form action="/dashboard/kelas">
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
                                    <th scope="col">NAMA KELAS</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $index => $data)
                                    <tr>
                                        <td style="width: 10%">{{ $index + $kelas->firstItem() }}</td>
                                        <td style="width: 90%">{{ $data->nama }}</td>
                                        <td class="text-nowrap" style="width: auto">
                                            <a href="/dashboard/kelas/{{ $data->slug }}/edit" class="btn btn-sm bg-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="/dashboard/kelas/{{ $data->slug }}" name="formDeletee" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf 
                                                <button class="btn btn-sm bg-danger border-0 konfirmasi_hapus" type="submit">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-between mx-1">
                        <div>
                            Showing {{ $kelas->firstItem() }} to {{ $kelas->lastItem() }} of {{$kelas->total()}} entries
                        </div>
                        <div class="mt-2 mt-md-0">
                            {{ $kelas->onEachSide(0)->links() }}
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
                title: 'Hapus Data?',
                text: "Klik Hapus untuk menghapus data",
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