@extends('dashboard.layouts.main')

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('container')
    <div class="row">
        <div class="col-md-4">
            <div class="card p-3 mb-0" id="card-reader">
                @if ($waktupemiluselesai)
                <div id="reader"></div>
                @else
                <div class="alert alert-info mb-0 text-center" role="alert">
                    Tunggu pemilu selesai
                </div>
                @endif
            </div>
            <div class="bg-tranparent d-flex mb-3">
                <img src="" class="foto-scan-pemilih rounded-circle img-thumbnail d-none" id="foto-kandidat">
            </div>
            <div class="alert alert-warning d-none" id="status" role="alert">
                Surat suara sudah pernah discan!
            </div>
            <div class="card">
                <div class="row px-3 py-2">
                    <div class="col-3">Nomor</div>
                    <div class="col-9 text-muted pl-3" id="nomor">-</div>
                </div>
                <hr class="my-0">
                <div class="row px-3 py-2">
                    <div class="col-3">Nama</div>
                    <div class="col-9 text-muted pl-3" id="nama">-</div>
                </div>
            </div>
            <div class="card bg-transparent shadow-none d-none" id="scan-ulang">
                <input type="button" id="scanulang" class="btn btn-success" value="Scan Surat Suara" onClick="document.location.reload(true)">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Perhitungan Suara
                </div>
                <div class="card-body">
                    @if (!$waktupemiluselesai)
                    <div class="alert alert-info" role="alert">
                        Scan surat suara dapat dilakukan ketika waktu pemilu telah selesai.
                    </div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if ($cekScan && count($surat_suara) > 0)
                    <div class="alert alert-success" role="alert">
                        Surat suara sudah terscan semua.
                    </div>
                    @endif
                    <form action="/dashboard/scan/ulang" method="post" class="row px-2 mb-3">
                        @csrf
                        <button class="btn bg-danger konfirmasi_hitung_ulang">
                            Hitung Ulang
                        </button>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">JUMLAH SURAT SUARA</th>
                                    <th scope="col">SUDAH DISCAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">{{ count($surat_suara) }}</td>
                                    <td class="align-middle" id="sudahscan">{{ count($sudah_scan) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">NOMOR</th>
                                    <th scope="col">KANDIDAT</th>
                                    <th scope="col">PEROLEHAN SUARA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($kandidats))
                                    @foreach ($kandidats as $kandidat)
                                        <tr>
                                            <td class="align-middle">{{ $kandidat->nomor }}</td>
                                            <td class="align-middle">{{ $kandidat->nama }}</td>
                                            <td class="align-middle" id="hasil{{ $kandidat->id }}">{{ $kandidat->hitung_suara }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-2">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            html5QrcodeScanner.clear().then(_ => {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('user.scan.validasi') }}",
                    type: 'POST', 
                    data: {
                        _methode : "POST",
                        _token: CSRF_TOKEN, 
                        qr_code : decodedText
                    },            
                    success: function (response) {
                        console.log(response); 
                        if(response.status == 404){
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Surat suara tidak valid!',
                            }).then((result) => {
                                document.location.reload(true);
                            })
                        }else{
                            $temp = "{{ asset('storage/') }}";
                            $("#nomor").empty();
                            $("#nama").empty();
                            $("#kode").empty();
                            if(response.kandidat.foto){
                                $('#foto-kandidat').attr('src', $temp + '/' + response.kandidat.foto);
                            }else{
                                $('#foto-kandidat').attr('src', "{{ asset('storage/foto-kandidat/defaultKandidat.jpg') }}");
                            }
                            $('#foto-kandidat').removeClass('d-none');
                            $("#nomor").append(response.kandidat.nomor);
                            $("#nama").append(response.kandidat.nama);
                            $('#scan-ulang').removeClass('d-none');
                            $('#card-reader').css('display', 'none');
                            if(response.kode){
                                $('#status').removeClass('d-none');
                            }else{
                                $("#hasil"+response.kandidat.id).append(`<span class="text-success"> + 1</span>`);
                                $("#sudahscan").append(`<span class="text-success"> + 1</span>`);
                            }
                        }
                        
                    }
                });   
            }).catch(error => {
                alert('something wrong');
            });
        }

        function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 600, height: 600} },
        false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        $('.konfirmasi_hitung_ulang').click(function(event) {
            var form =  $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Hitung ulang akan menghapus semua data hasil scan surat suara.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hitung Ulang',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Sukses!',
                    'Data berhasil dihapus.',
                    'success'
                    ).then(function(){
                        form.submit();
                    })
                }
            })
        });
    </script>
@endpush