<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Votos | {{ $title }}</title>
</head>
<body>
    @if (count($votings))
        @foreach ($votings as $voting)  
            <h5 class="text-center">QR CODE HASIL VOTING</h5>
            <p class="text-center mb-0">Sistem E-Voting Pemilihan Ketua OSIS</p>
            <div class="row d-flex justify-content-center">
                <div class="col-6 d-flex justify-content-center">
                    {!! $voting->qr_code  !!}
                </div>
            </div>
        @endforeach
    @endif
    <script>
        window.print();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>