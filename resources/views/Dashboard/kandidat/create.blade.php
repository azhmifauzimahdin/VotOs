@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-8">
            <div class="card">
                <h5 class="card-header ">{{ $title }}</h5>
                <div class="card-body">
                    <form action="/dashboard/kandidat" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nomor">Nomor Kandidat</label>
                            <input type="number" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" placeholder="Nomor Kandidat" required value="{{  old('nomor') }}" autofocus>
                            @error('nomor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" required value="{{  old('nama') }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-control" id="jk" name="jk">
                                <option value="Laki-laki" {{ old('jk') == "Laki-laki" ? "selected" : "" }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jk') == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" required value="{{  old('slug') }}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="visi">Visi</label>
                            <input id="visi" type="hidden" name="visi" value="{{  old('visi') }}" required>
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
                            <input id="misi" type="hidden" name="misi" value="{{  old('misi') }}" required>
                            <trix-editor input="misi"></trix-editor>
                            <input type="hidden" class="form-control @error('misi') is-invalid @enderror">
                            @error('misi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>                            
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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

    </script>
@endsection