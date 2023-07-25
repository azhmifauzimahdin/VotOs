@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-7">
            <div class="card">
                <h5 class="card-header ">{{ $title }}</h5>
                <div class="card-body">
                    <div class="info-voting alert border" role="alert" >
                        Masukan beberapa nama pihak terkait yang akan digunakan di lembar pengesahan hasil pemilu.
                    </div>
                    <form action="/dashboard/rekapitulasi/laporan" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="ketua">Ketua Umum</label>
                            <input type="text" class="form-control" id="ketua" name="ketua" placeholder="Nama Ketua Umum" required value="{{  old('ketua') }}">
                        </div>
                        <div class="form-group">
                            <label for="sekretaris">Sekretaris Umum</label>
                            <input type="text" class="form-control" id="sekretaris" name="sekretaris" placeholder="Nama Sekretaris Umum" required value="{{  old('sekretaris') }}">
                        </div>
                        <div class="form-group">
                            <label for="kesiswaan">Waka Kesiswaan</label>
                            <input type="text" class="form-control" id="kesiswaan" name="kesiswaan" placeholder="Nama Waka Kesiswaan" required value="{{  old('kesiswaan') }}">
                        </div>
                        <div class="form-group">
                            <label for="pembina">Pembina IPM</label>
                            <input type="text" class="form-control" id="pembina" name="pembina" placeholder="pembina" required value="{{  old('pembina') }}">
                        </div>
                        <div class="form-group">
                            <label for="kepala_sekolah">Kepala Sekolah</label>
                            <input type="text" class="form-control" id="kepala_sekolah" name="kepala_sekolah" placeholder="Nama Kepala Sekolah" required value="{{  old('kepala_sekolah') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/dashboard/rekapitulasi" class="btn btn-danger">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
    
@push('script')    
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
@endpush