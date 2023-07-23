<?php

namespace App\Exports;

use App\Models\Pemilih;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class GuruKaryawanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pemilih::whereNotNull('jabatan_id')->join('jabatans', 'pemilihs.jabatan_id', '=', 'jabatans.id')->select('pemilihs.nama', 'jabatans.nama as nama_jabatan', 'pemilihs.jenis_kelamin', 'pemilihs.email')->get();
    }

    public function headings(): array
    {
        return [
            'NAMA',
            'JABATAN',
            'JENIS KELAMIN',
            'EMAIL'
        ];
    }
}
