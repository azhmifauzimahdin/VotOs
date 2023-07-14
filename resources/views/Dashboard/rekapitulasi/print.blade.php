<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Votos | {{ $title }}</title>
    <style>
        body{
            font-size: 12px;
        }

        .label{
            padding-right: 20px;
            font-weight: 900;
        }
        .tabel-rekapitulasi{
            width: 100%;
            border-collapse: collapse;
            margin-top: 14px;
        }

        .tabel-rekapitulasi>thead>tr>th,  .tabel-rekapitulasi>tbody>tr>td {
            border: 1px solid black;
            padding: 4px;
        }
        th{
            text-align: start;
        }
        .text-center{
            text-align: center;
        }

    </style>
</head>
<body onload="window.print()">
    <h3 class="text-center">REKAPITULASI HASIL VOTING</h3>
    @if (request('kandidat'))  
        <table> 
            <tbody> 
                <tr> 
                    <td class="label">Kandidat</td> 
                    <td>:</td> 
                    <td>
                        @if (request('kandidat'))
                            {{ request('kandidat') }}
                        @else
                            Semua kandidat
                        @endif
                    </td> 
                </tr>
            </tbody>
        </table>
    @endif
    <table class="tabel-rekapitulasi">
        <thead>
            <tr>
                <th>No</th>
                <th>Pemilih</th>
                <th>Kandidat</th>
                <th>Waktu Voting</th>
            </tr>
        </thead>
        <tbody>
            @if (count($votings))
                @foreach ($votings as $index => $voting)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $voting->pemilih->nama }}</td>
                        <td>{{ $voting->kandidat->nomor }} - {{ $voting->kandidat->nama }}</td>
                        <td>{{ $voting->created_at }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data voting</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>