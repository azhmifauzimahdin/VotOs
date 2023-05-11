@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-12">
            <div class="card">
                <h5 class="card-header">Data Pemilih</h5>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="/dashboard/pemilih/create" class="btn btn-primary">
                            <i class="fa-solid fa-plus pr-1"></i>
                            Tambah Data Pemilih
                        </a>
                        <button class="btn btn-primary" onclick="konfirmasi()">Klik disini</button>
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
                                <th scope="col">No</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum dolor.</td>
                                <td>Lorem ipsum dolor sit.</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum dolor.</td>
                                <td>Lorem ipsum dolor sit.</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum dolor.</td>
                                <td>Lorem ipsum dolor sit.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        function konfirmasi() {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        }
    </script>
@endsection