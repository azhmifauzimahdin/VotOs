<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title>Votos | {{ $title }}</title>
</head>
<body>
    <h5 class="text-center">REKAPITULASI DATA VOTING</h5>
    <p class="text-center">Sistem E-Voting Pemilihan Ketua OSIS</p>
    @if (request('kandidat') || request('kelas'))  
        <table class="table table-borderless table-sm"> 
            <tbody> 
                <tr> 
                    <td width="190px">Kandidat</td> 
                    <td width="5px">:</td> 
                    <td>
                        @if (request('kandidat'))
                            {{ request('kandidat') }}
                        @else
                            Semua kandidat
                        @endif
                    </td> 
                </tr> 
                <tr> 
                    <td>Kelas</td>
                    <td>:</td>
                    <td>
                        @if (request('kelas'))
                            {{ request('kelas') }}
                        @else
                            Semua kelas
                        @endif
                    </td> 
                </tr> 
            </tbody>
        </table>
    @endif
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pemilih</th>
                <th scope="col">Kandidat</th>
                <th scope="col">Waktu Voting</th>
            </tr>
        </thead>
        <tbody>
            @if (count($votings))
                @foreach ($votings as $index => $voting)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $voting->pemilih_id }} - {{ $voting->pemilih->kelas->nama }} - {{ $voting->pemilih->nama }}</td>
                        <td>{{ $voting->kandidat->nomor }} - {{ $voting->kandidat->nama }}</td>
                        <td>{{ $voting->created_at }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center py-2">Tidak ada data yang ditemukan</td>
                </tr>
            @endif
        </tbody>
    </table>
    <script>
        window.print();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>