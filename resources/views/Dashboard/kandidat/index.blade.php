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
                    <div class="d-flex justify-content-between mb-3">
                        <a href="/dashboard/kandidat/create" class="btn btn-primary">
                            <i class="fa-solid fa-plus pr-1"></i>
                            Tambah {{ $title }}
                        </a>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                Search :
                            </li>
                            <li class="list-inline-item">
                                <input class="form-control" type="text" aria-label="default input example">
                            </li>
                        </ul>
                    </div>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">JENIS KELAMIN</th>
                                <th scope="col">FOTO</th>
                                <th scope="col">TENTANG</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kandidats as $kandidat)
                                <tr>
                                    <td>{{ $kandidat->nomor }}</td>
                                    <td>{{ $kandidat->nama }}</td>
                                    <td>{{ $kandidat->slug }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'.$kandidat->foto) }}" style="width: 120px; height: 160px;" alt="Foto kandidat">    
                                    </td>
                                    <td>
                                        <b>Visi :</b>
                                        <div>{!! $kandidat->visi !!}</div>
                                        <b>Misi :</b>
                                        <div>{!! $kandidat->misi !!}</div>
                                    </td>
                                    <td class="text-nowrap">
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
                        </tbody>
                    </table>
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