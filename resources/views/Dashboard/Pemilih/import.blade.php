@extends('dashboard.layouts.main')

@section('container')
    <div class="row">
        <section class="col-md-12">
            <div class="card">
                <h5 class="card-header ">Upload Data {{ $objek }}</h5>
                <div class="card-body">
                    <div class="info-voting alert border" role="alert">
                        Pilih file berisi data {{ Str::lower($objek) }} dalam format xlsx, xls, ata csv. Data dari file yang akan disimpan ke dalam sistem hanya berupa nama,
                        @if ($role == 'siswa')
                            kelas,
                        @else
                            jabatan,
                        @endif
                        jenis kelamin, dan email. Jika email sudah digunakan, maka data dalam sistem akan diupdate sesuai dengan file data {{ $role }}. Pastikan judul tabel berada di baris pertama supaya data dapat terbaca oleh sistem. Untuk lebih jelas bisa lihat di <a href="/dashboard/pemilih/{{ $role }}/download" class="text-primary">template</a> data {{ $role }}. 
                    </div>
                    <div class="alert alert-warning d-none alert-format" role="alert" >
                        Pilih format file yang valid (xlsx, xls, atau csv).
                    </div>
                    <div class="alert alert-warning d-none alert-gagal" role="alert" >
                        Gagal menampilkan data.
                    </div>
                    <div class="alert alert-warning d-none alert-header" role="alert" id="alert-header">
                        Data <b id="header-nama"></b> tidak ada.
                    </div>
                    <form action="/dashboard/pemilih/{{ $role }}/import" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file" required>
                            @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" id="simpan" disabled>Simpan</button>
                        <a href="/dashboard/pemilih/{{ $role }}" class="btn btn-danger">Batal</a>
                    </form>
                    <div class="table-responsive" id="tabel-data">
                        <table class="table table-striped table-sm">
                            <thead id="tabel-head">
                            </thead>
                            <tbody id="tabel-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.min.js"></script>
    <script>
        var file = document.querySelector('#file');
        var simpan = document.querySelector('#simpan');
        
        file.addEventListener("change", function(){
            var format = document.querySelector('.alert-format');
            var files = document.getElementById('file').files;
            format.classList.add('d-none');
            if(files.length==0){
                return;
            }
            var filename = files[0].name;
            var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
            if (extension == '.XLS' || extension == '.XLSX' || extension == '.CSV') {
                excelFileToJSON(files[0]);
            }else{
                format.classList.remove('d-none');
            }
        });
	  
        function excelFileToJSON(file){
            var gagal = document.querySelector('.alert-gagal');
            gagal.classList.add('d-none');
            try {
                var reader = new FileReader();
                reader.readAsBinaryString(file);
                reader.onload = function(e) {
                    var data = e.target.result;
                    var workbook = XLSX.read(data, {type : 'binary'});
                    var result = {};
                    var firstSheetName = workbook.SheetNames[0];
                    var jsonData = XLSX.utils.sheet_to_json(workbook.Sheets[firstSheetName]);
                    displayJsonToHtmlTable(jsonData);
                    cekHeader(jsonData);
                }
            }catch(e){
                gagal.classList.remove('d-none');
            }
        }
        
        function cekHeader(jsonData){
            var alertheader = document.querySelector('#alert-header');
            var cekAtrributeSimpan = simpan.hasAttribute('disabled');
            if(!cekAtrributeSimpan){
                simpan.setAttribute('disabled','');
            }
            if(jsonData.length > 0){
                var namaheader = document.querySelector('#header-nama');
                var header = Object.keys(jsonData[0]);
                var nama = header.includes('nama') || header.includes('Nama') || header.includes('NAMA');
                var kelas = header.includes('kelas') || header.includes('Kelas') || header.includes('KELAS');
                var jabatan = header.includes('jabatan') || header.includes('Jabatan') || header.includes('JABATAN');
                var jenis_kelamin = header.includes('jenis kelamin') || header.includes('Jenis kelamin') || header.includes('Jenis Kelamin') || header.includes('JENIS KELAMIN');
                var email = header.includes('email') || header.includes('Email') || header.includes('EMAIL');
                namaheader.innerHTML = '';
                alertheader.classList.add('d-none');
                if(!nama){
                    alertheader.classList.remove('d-none');
                    namaheader.append('[NAMA] ');
                }
                if('{{ $role }}' == 'siswa'){
                    if(!kelas){
                        alertheader.classList.remove('d-none');
                        namaheader.append('[KELAS] ')
                    }
                }
                else{
                    if(!jabatan){
                        alertheader.classList.remove('d-none');
                        namaheader.append('[JABATAN] ')
                    }
                }
                if(!jenis_kelamin){
                    alertheader.classList.remove('d-none');
                    namaheader.append('[JENIS KELAMIN] ')
                }
                if(!email){
                    alertheader.classList.remove('d-none');
                    namaheader.append('[EMAIL] ')
                }
                if('{{ $role }}' == 'siswa'){
                    if(nama && kelas && jenis_kelamin && email){
                        simpan.removeAttribute('disabled');
                    }
                }
                else{
                    if(nama && jabatan && jenis_kelamin && email){
                        simpan.removeAttribute('disabled');
                    }
                }
            }else{
                alertheader.classList.add('d-none');
            }
        }
        
        function displayJsonToHtmlTable(jsonData){
            var tabeldata = document.querySelector("#tabel-data");
            var tablehead = document.querySelector("#tabel-head");
            var tablebody = document.querySelector("#tabel-body");
            tabeldata.classList.add('mt-3');
            if(jsonData.length > 0){
                var htmlDataHead = '';
                if('{{ $role }}' == 'siswa'){
                    htmlDataHead += '<tr><th>NO</th><th>NAMA</th><th>KELAS</th><th>JENIS KELAMIN</th><th>EMAIL</th></tr>';
                }
                else{
                    htmlDataHead += '<tr><th>NO</th><th>NAMA</th><th>JABATAN</th><th>JENIS KELAMIN</th><th>EMAIL</th></tr>';
                }
                tablehead.innerHTML = htmlDataHead;
                var htmlData = ' ';
                jsonData.forEach((row, i) => {
                    if('{{ $role }}' == 'siswa'){
                        htmlData += '<tr><td>'+(i+1)+'</td><td>'+ (row['nama'] || row['Nama'] || row['NAMA']) +'</td><td>'+(row['kelas'] || row['Kelas'] || row['KELAS'])+'</td><td>'+(row['jenis kelamin'] || row['Jenis kelamin'] || row['Jenis Kelamin'] || row['JENIS KELAMIN'])+'</td><td>'+(row['email'] || row['Email'] || row['EMAIL'])+'</td></tr>';
                    }
                    else{
                        htmlData += '<tr><td>'+(i+1)+'</td><td>'+ (row['nama'] || row['Nama'] || row['NAMA']) +'</td><td>'+(row['jabatan'] || row['Jabatan'] || row['JABATAN'])+'</td><td>'+(row['jenis kelamin'] || row['Jenis kelamin'] || row['Jenis Kelamin'] || row['JENIS KELAMIN'])+'</td><td>'+(row['email'] || row['Email'] || row['EMAIL'])+'</td></tr>';
                    }
                });
                tablebody.innerHTML=htmlData;
            }else{
                tablehead.innerHTML= '';
                tablebody.innerHTML= '<td class="text-center">Tidak ada data yang ditemukan di dalam file</td>';
            }
        }
    </script>
@endpush