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
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" placeholder="NISN" required value="{{  old('nisn', $pemilih->nisn) }}">
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
                        <div class="form-group d-none">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" required value="{{  old('slug', $pemilih->slug) }}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-control" id="jk" name="jk">
                                <option value="Laki-laki" {{ old('jk', $pemilih->jk) == "Laki-laki" ? "selected" : "" }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jk', $pemilih->jk) == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="password">Password</label>
                            <small id="passwordRule" class="form-text text-muted">
                                <ul class="py-0 px-3 ">
                                    <li>Berisi minimal 6 karakter.</li>
                                    <li>Berisi setidaknya satu huruf kecil.</li>
                                    <li>Berisi setidaknya satu huruf besar.</li>
                                    <li>Berisi setidaknya satu angka.</li>
                                    <li>Berisi setidaknya satu karakter khusus.</li>
                                </ul>
                            </small>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <a href=""><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
                                    </span>
                                </div>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <small id="passwordHelp" class="form-text text-muted">
                                Jika password tidak diubah. Password bisa dikosongkan.
                            </small>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/dashboard/pemilih" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');
        const nisn = document.querySelector('#nisn');
        const username = document.querySelector('#username');
        const password = document.querySelector('#password');
        const passwordHelp = document.querySelector('#passwordHelp');

        nisn.addEventListener('change',function(){
            fetch('/dashboard/pemilih/checkSlug?nama=' + nama.value+'&nisn=' + nisn.value)
            .then(response => response.json())
            .then(data => {
                slug.value = data.slug;
                username.value = data.username;
            })
        });
        
        nama.addEventListener('change',function(){
            fetch('/dashboard/pemilih/checkSlug?nama=' + nama.value+'&nisn=' + nisn.value)
            .then(response => response.json())
            .then(data => {
                slug.value = data.slug;
                username.value = data.username;
            })
        });

        password.addEventListener('click',function(){
            passwordHelp.style.display = 'none';
        });

        password.addEventListener('change',function(){
            if(password.value == ""){
                passwordHelp.style.display = 'block';
            }
        });

        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
@endsection