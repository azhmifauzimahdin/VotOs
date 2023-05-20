@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-6">
            <div class="card">
                <h5 class="card-header">Ganti Password</h5>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="/dashboard/ganti_password/{{ auth()->user()->slug }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                          <label for="password">Password Baru</label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password Baru" required>
                          @error('password')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>
                        {{-- <div class="form-group">
                          <label for="password_confirmation">Konfirmasi Password</label>
                          <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password Baru" required>
                          @error('password_confirmation')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </form>
                </div>
            </div>
        </section>
    </div>
@endsection