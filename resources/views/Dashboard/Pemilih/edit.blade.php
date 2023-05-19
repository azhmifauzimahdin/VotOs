@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-8">
            <div class="card">
                <h5 class="card-header">Edit Data Pemilih</h5>
                <div class="card-body">
                    <form action="/dashboard/pemilih/{{ $pemilih->slug }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" placeholder="NISN" required value="{{  old('nisn', $pemilih->nisn) }}" autofocus>
                            @error('nisn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" required value="{{  old('nama', $pemilih->nama) }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" required value="{{  old('username', $pemilih->username) }}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" required value="{{  old('slug', $pemilih->slug) }}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" placeholder="Kelas" required value="{{  old('kelas', $pemilih->kelas) }}">
                            @error('kelas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-control" id="jk" name="jk">
                                <option value="Laki-laki" {{ old('jk', $pemilih->jk) == "Laki-laki" ? "selected" : "" }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jk', $pemilih->jk) == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @else
                                <small id="emailHelp" class="form-text text-muted">Jika password tidak ada perubahan. Password bisa dikosongkan.</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/dashboard/pemilih" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection