@extends('layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('container')
    <div class="row bg-primary mb-4 text-light" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
        <div class="col-12 mt-5 text-center pb-2">
            <h3 class="d-inline pb-2 px-3" style="border-bottom-style: solid; border-width: 2px; border-radius: 50% ; border-image: linear-gradient(to right, #2dcddf, #2ddfbb,#2ddf8f) 1">Scan QR Code</h3>
        </div>
        <div class="col-12 text-center mb-4 mt-2">
            <p>Scan QR Code untuk mengetahui hasil vote dan keaslian surat</p>
        </div>
    </div>
    <div class="px-5">
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row d-flex justify-content-center my-5">
            <div class="col-12 col-md-4 bg-light border py-3 px-5 mx-2" style="border-radius: 0.5vw;">
                <div class="row py-md-4">
                    <div id="reader" width="600px"></div>
                    <img src="" alt="Foto Kandidat" width="100%" height="320px" id="foto" style="display: none">
                </div>
                <div class="row border-bottom pb-2">
                    <div class="col-md-4"><b>Nomor Kandidat</b></div>
                    <div class="col-md-8" id="nomor">-</div>
                </div>
                <div class="row py-2">
                    <div class="col-md-4"><b>Nama Kandidat</b></div>
                    <div class="col-md-8" id="nama">-</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            $('#result').val(decodedText);
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
                            console.log(response)
                            if(response.status == 404){
                            }else{
                                $temp = "{{ asset('storage/') }}";
                                $("#nomor").empty();
                                $("#nama").empty();
                                if(response.kandidat.foto){
                                    $('#foto').attr('src', $temp + '/' + response.kandidat.foto);
                                }else{
                                    $('#foto').attr('src', "{{ asset('AdminLTE') }}/dist/img/default_user.jpg");
                                }
                                $('#foto').css('display', 'block');
                                $("#nomor").append(response.kandidat.nomor);
                                $("#nama").append(response.kandidat.nama);
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
@endsection