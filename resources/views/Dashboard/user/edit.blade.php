@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-8">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <form action="/dashboard/user/{{ $user->slug }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" required value="{{  old('nama', $user->nama) }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" required value="{{  old('username', $user->username) }}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group d-none">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" required value="{{  old('slug', $user->slug) }}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required value="{{  old('email', $user->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control" id="level" name="level">
                                <option value="Administrator" {{ old('level', $user->level) == "Administrator" ? "selected" : "" }}>Administrator</option>
                                <option value="Panitia" {{ old('level', $user->level) == "Panitia" ? "selected" : "" }}>Panitia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="hidden" name="fotoLama" value="{{ $user->foto }}">
                            @if ($user->foto)
                                <img src="{{ asset('storage/' . $user->foto) }}" class="img-preview img-fluid mb-3 d-block" width="220">
                            @else
                                <img class="img-preview img-fluid mb-3" width="220">
                            @endif
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto" onchange="previewImage()">
                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <small id="passwordRule" class="form-text text-muted" style="display: none;">
                                <ul class="py-0 px-3 ">
                                    <li>Berisi minimal 6 karakter.</li>
                                    <li>Berisi setidaknya satu huruf kecil.</li>
                                    <li>Berisi setidaknya satu huruf besar.</li>
                                    <li>Berisi setidaknya satu angka.</li>
                                    <li>Berisi setidaknya satu karakter khusus.</li>
                                </ul>
                            </small>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @else
                                <small id="emailHelp" class="form-text text-muted">
                                    Jika password tidak diubah. Password bisa dikosongkan.
                                </small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/dashboard/user" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');
        const password = document.querySelector('#password');
        const passwordRule = document.querySelector('#passwordRule');

        nama.addEventListener('change',function(){
            fetch('/dashboard/user/checkSlug?nama=' + nama.value)
            .then(response => response.json())
            .then(data => {
                slug.value = data.slug;
            })
        });

        password.addEventListener('click',function(){
            passwordRule.style.display = 'block';
        })

        password.addEventListener('blur',function(){
            passwordRule.style.display = 'none';
        })

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        });

        function previewImage(){
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection