@extends('layouts.main')

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('container')
    <div class="row bg-primary mb-0 mb-md-4 text-light" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3" style="border-bottom-style: solid; border-width: 2px; border-radius: 50% ; border-image: linear-gradient(to right, #2dcddf, #2ddfbb,#2ddf8f) 1">Scan Surat Suara</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Scan QR Code untuk mengetahui hasil vote dan keaslian surat</p>
        </div>
    </div>
    <div class="px-4 px-md-5">
        <div class="row d-flex justify-content-center my-4 my-md-5">
            <div class="col-12 col-md-4 bg-light shadow py-md-2 pt-5 pb-2 mx-2 mb-5 mb-md-0" style="border-radius: 0.5vw;">
                <div class="row py-md-4 mb-3 mb-md-0 d-flex justify-content-center">
                    <div id="reader" width="100%"></div>
                    <img src="" class="foto-scan-pemilih px-0" id="foto" style="display: none;">
                </div>
                <div class="row border-bottom pb-2 mx-1">
                    <div class="col-md-4"><b>Nomor</b></div>
                    <div class="col-md-8" id="nomor">-</div>
                </div>
                <div class="row py-2 mx-1">
                    <div class="col-md-4"><b>Nama</b></div>
                    <div class="col-md-8" id="nama">-</div>
                </div>
                <div class="row border-top mx-1 py-2">
                    <input type="hidden" id="scanulang" class="btn btn-success rounded-pill mt-3 px-3" value="Scan Ulang" onClick="document.location.reload(true)">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- QR Code --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    {{-- JQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            html5QrcodeScanner.clear().then(_ => {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('pemilih.scan.validasi') }}",
                    type: 'POST', 
                    data: {
                        _methode : "POST",
                        _token: CSRF_TOKEN, 
                        qr_code : decodedText
                    },            
                    success: function (response) { 
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
                                $('#foto').attr('src', $temp + '/' + response.kandidat.foto);
                            }else{
                                $('#foto').attr('src', "{{ asset('storage/foto-kandidat/defaultKandidat.jpg') }}");
                            }
                            $('#foto').css('display', 'block');
                            $("#nomor").append(response.kandidat.nomor);
                            $("#nama").append(response.kandidat.nama);
                            $('#scanulang').attr('type','button')
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
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>  
@endpush