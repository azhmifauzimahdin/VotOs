@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-7">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <form action="/dashboard/waktupemilu/{{ $pemilu->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="mulai">Waktu Mulai</label>
                            <input type="datetime-local" class="form-control @error('mulai') is-invalid @enderror" id="mulai" name="mulai" placeholder="Waktu Mulai" required value="{{  old('mulai', $pemilu->mulai) }}">
                            @error('mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="selesai">Waktu Selesai</label>
                            <input type="datetime-local" class="form-control @error('selesai') is-invalid @enderror" id="selesai" name="selesai" placeholder="Waktu Selesai" required value="{{  old('selesai', $pemilu->selesai) }}">
                            @error('selesai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/dashboard/waktupemilu" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection