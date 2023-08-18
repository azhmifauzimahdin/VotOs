<?php

namespace App\Exports;

use App\Models\Pemilih;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemilihExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pemilih::select('nama', 'kelas_jabatan', 'jenis_kelamin', 'email')->get();
    }

    public function headings(): array
    {
        return [
            'NAMA',
            'KELAS/JABATAN',
            'JENIS KELAMIN',
            'EMAIL'
        ];
    }
}
