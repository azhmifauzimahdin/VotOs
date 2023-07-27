@extends('auth.layout.main')

@section('content1')
    <div class="col-md-6 d-flex justify-content-center box_loginUser">
        <img src="/img/verifikasi.svg" alt="ilustrasi" width="50%" class="ilustrasi_loginUser">
    </div>
@endsection
@section('content2')
    <h3 class="text-center text-primary fw-bold mb-3">Votos</h3>
    @if (count($verifikasi))
        <div class="border border-success border-1 rounded-3 p-4 mx-4 mx-md-0">
            <img src="/img/icon_qrcode.png" class="mx-auto d-block mb-3 w-50" alt="QR Code">
            <h6 class="text-center text-success">Data Laporan Valid</h6>
        </div>
    @else
        <div class="border border-danger border-1 rounded-3 p-4 mx-4 mx-md-0">
            <img src="/img/icon_qrcode.png" class="mx-auto d-block mb-3 w-50" alt="QR Code">
            <h6 class="text-center text-danger">Data Laporan Tidak Valid</h6>
        </div>
        @endif
</form>
@endsection