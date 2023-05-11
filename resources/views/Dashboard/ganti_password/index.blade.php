@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-8">
            <div class="card">
                <h5 class="card-header">Ganti Password</h5>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Konfirmasi Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </form>
                </div>
            </div>
        </section>
    </div>
@endsection