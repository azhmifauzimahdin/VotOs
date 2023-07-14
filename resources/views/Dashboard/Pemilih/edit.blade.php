@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-8">
            <div class="card">
                <h5 class="card-header">Edit Data {{ $objek}}</h5>
                <div class="card-body">
                    <form action="/dashboard/pemilih/{{ $role }}/{{ $pemilih->slug }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" required value="{{  old('nama', $pemilih->nama) }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @if ($role === 'siswa')
                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select class="form-control" name="kelas_id" id="kelas_id">
                                @foreach ($kelas as $data)
                                    <option value="{{ $data->id }}" {{ old('kelas_id', $pemilih->kelas_id) == $data->id ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @else
                        <div class="form-group">
                            <label for="jabatan_id">Kelas</label>
                            <select class="form-control" name="jabatan_id" id="jabatan_id">
                                @foreach ($jabatan as $data)
                                    <option value="{{ $data->id }}" {{ old('jabatan_id', $pemilih->jabatan_id) == $data->id ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('jabatan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki" {{ old('jenis_kelamin', $pemilih->jenis_kelamin) == "Laki-laki" ? "selected" : "" }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $pemilih->jenis_kelamin) == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required value="{{  old('email', $pemilih->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group d-none">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" required value="{{  old('slug', $pemilih->slug) }}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/dashboard/pemilih/{{ $role }}" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');
        
        nama.addEventListener('change',function(){
            fetch('/dashboard/pemilih/checkSlug?nama=' + nama.value)
            .then(response => response.json())
            .then(data => {
                slug.value = data.slug;
            })
        });
    </script>
@endsection