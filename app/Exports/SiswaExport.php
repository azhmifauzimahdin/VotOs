<?php

namespace App\Exports;

use App\Models\Pemilih;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pemilih::whereNotNull('kelas_id')->join('kelas', 'pemilihs.kelas_id', '=', 'kelas.id')->select('pemilihs.nama', 'kelas.nama as nama_kelas', 'pemilihs.jenis_kelamin', 'pemilihs.email')->get();
    }

    public function headings(): array
    {
        return [
            'NAMA',
            'KELAS',
            'JENIS KELAMIN',
            'EMAIL'
        ];
    }
}
