@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-8">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <form action="/dashboard/kandidat/{{ $kandidat->slug }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nomor">Nomor Kandidat</label>
                            <input type="number" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" placeholder="Nomor Kandidat" required value="{{  old('nomor', $kandidat->nomor) }}">
                            @error('nomor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" required value="{{  old('nama', $kandidat->nama) }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan Sebelumnya</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" placeholder="Jabatan sebelumnya" required value="{{  old('jabatan', $kandidat->jabatan) }}">
                            @error('jabatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select class="form-control" name="kelas_id" id="kelas_id">
                                @foreach ($kelas as $data)
                                    <option value="{{ $data->id }}" {{ old('kelas_id', $kandidat->kelas_id) == $data->id ? "selected" : "" }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki" {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == "Laki-laki" ? "selected" : "" }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required value="{{ old('tempat_lahir', $kandidat->tempat_lahir) }}">
                                @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" required value="{{ old('tanggal_lahir', $kandidat->tanggal_lahir) }}">
                                @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat" required>{{ old('alamat', $kandidat->alamat) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group d-none">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" required value="{{  old('slug', $kandidat->slug) }}">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="hidden" name="fotoLama" value="{{ $kandidat->foto }}">
                            @if ($kandidat->foto)
                                <img src="{{ asset('storage/' . $kandidat->foto) }}" class="img-preview img-fluid mb-3 d-block" width="220">
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
                            <label for="visi">Visi</label>
                            <input id="visi" type="hidden" name="visi" value="{{  old('visi', $kandidat->visi) }}" required>
                            <trix-editor input="visi"></trix-editor>
                            <input type="hidden" class="form-control @error('visi') is-invalid @enderror">
                            @error('visi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>                            
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="misi">Misi</label>
                            <input id="misi" type="hidden" name="misi" value="{{  old('misi', $kandidat->misi) }}" required>
                            <trix-editor input="misi"></trix-editor>
                            <input type="hidden" class="form-control @error('misi') is-invalid @enderror">
                            @error('misi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>                            
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/dashboard/kandidat" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');

        nama.addEventListener('change',function(){
            fetch('/dashboard/kandidat/checkSlug?nama=' + nama.value)
            .then(response => response.json())
            .then(data => {
                slug.value = data.slug;
            })
        });

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