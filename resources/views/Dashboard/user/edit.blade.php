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
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control select-search" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == "Laki-laki" ? "selected" : "" }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                            </select>
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
                            <select class="form-control select-search" id="level" name="level">
                                <option value="Administrator" {{ old('level', $user->level) == "Administrator" ? "selected" : "" }}>Administrator</option>
                                <option value="Panitia" {{ old('level', $user->level) == "Panitia" ? "selected" : "" }}>Panitia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="hidden" name="fotoLama" value="{{ $user->foto }}">
                            @if ($user->foto)
                                <img src="{{ asset('storage/public/' . $user->foto) }}" class="img-preview img-fluid mb-3 d-block" width="220">
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
                                        <a class="show-hide-password"><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
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
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/dashboard/user" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script>
        const password = document.querySelector('#password');
        const passwordHelp = document.querySelector('#passwordHelp');

        password.addEventListener('click',function(){
            passwordHelp.style.display = 'none';
        });

        password.addEventListener('blur',function(){
            if(password.value == ""){
                passwordHelp.style.display = 'block';
            }
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

        $(document).ready(function(){
            $('.select-search').select2();
        });
        
    </script>
@endpush