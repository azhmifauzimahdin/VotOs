@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-8">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                <div class="card-body">
                    <form action="/dashboard/hasilPemilu/laporan/{{ $laporan->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="ketua">Ketua Umum</label>
                            <input type="text" class="form-control @error('ketua') is-invalid @enderror" id="ketua" name="ketua" placeholder="Nama Ketua Umum" required value="{{  old('ketua', $laporan->ketua) }}">
                            @error('ketua')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sekretaris">Sekretaris Umum</label>
                            <input type="text" class="form-control @error('sekretaris') is-invalid @enderror" id="sekretaris" name="sekretaris" placeholder="Nama Sekretaris Umum" required value="{{  old('sekretaris', $laporan->sekretaris) }}">
                            @error('sekretaris')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kesiswaan">Waka Kesiswaan</label>
                            <input type="text" class="form-control @error('kesiswaan') is-invalid @enderror" id="kesiswaan" name="kesiswaan" placeholder="Nama Waka Kesiswaan" required value="{{  old('kesiswaan', $laporan->kesiswaan) }}">
                            @error('kesiswaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pembina">Pembina IPM</label>
                            <input type="text" class="form-control @error('pembina') is-invalid @enderror" id="pembina" name="pembina" placeholder="Nama Pembina IPM" required value="{{  old('pembina', $laporan->pembina) }}">
                            @error('pembina')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kepala_sekolah">Kepala Sekolah</label>
                            <input type="text" class="form-control @error('kepala_sekolah') is-invalid @enderror" id="kepala_sekolah" name="kepala_sekolah" placeholder="Nama Kepala Sekolah" required value="{{  old('kepala_sekolah', $laporan->kepala_sekolah) }}">
                            @error('kepala_sekolah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/dashboard/hasilPemilu/laporan" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.select-search').select2();
        });
    </script>
@endpush