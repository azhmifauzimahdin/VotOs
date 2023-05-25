<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- Boostrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    {{-- Jquery --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {{-- My Style --}}
    <link rel="stylesheet" href="/css/main.css">
    <title>Votos | {{ $title }}</title>

    <style>
        .candidate_thumb {
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        .candidate_thumb::after{
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            position: absolute;
            width: 150%;
            height: 80px;
            bottom: -45px;
            left: -25%;
            content: "";
            background-color: #ffffff;
            -webkit-transform: rotate(-15deg);
            transform: rotate(-10deg);
        }
        .kotak-profil:hover{
        }
        @media only screen and (max-width: 600px) {
            .img-ilustration-beranda{
                display: none !important;
            }
            .icon-beranda {
                display: none !important;
            }
            .foto-kandidat{
                height: 170px;
            }
        }
    </style>

</head>

<body>
    @include('partials.navbar')
    <div class="mainContainer overflow-hidden pt-5">
        @yield('container')
    </div>
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dd7eecbb67.js" crossorigin="anonymous"></script>
</body>

</html>