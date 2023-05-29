@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-8">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <form action="/dashboard/kelas/{{ $kelas->slug }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Kelas</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Kelas" required value="{{  old('nama', $kelas->nama) }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group d-none">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" required value="{{  old('slug', $kelas->slug) }}">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/dashboard/kelas" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');

        nama.addEventListener('change',function(){
            fetch('/dashboard/kelas/checkSlug?nama=' + nama.value)
            .then(response => response.json())
            .then(data => {
                slug.value = data.slug;
            })
        });
    </script>
@endsection