<?php

namespace App\Imports;

use App\Models\Jabatan;
use App\Models\Laporan;
use App\Models\Pemilih;
use Illuminate\Support\Str;
use App\Jobs\SendAccountJob;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PemilihImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {
        $password = Str::random(6);
        $details = [
            'email' => $row['email'],
            'nama' => $row['nama'],
            'password' => $password,
            'url' => 'http://' . request()->getHttpHost() . '/loginPemilih'
        ];
        dispatch(new SendAccountJob($details));

        $laporan = Laporan::where('id', 1)->first();
        if ($laporan) {
            $laporan->increment('jumlah_pemilih', 1);
            $laporan->increment('jumlah_belum_memilih', 1);
        } else {
            Laporan::create(['id' => 1, 'user_id' => auth()->user()->id, 'jumlah_pemilih' => 1, 'jumlah_belum_memilih' => 1]);
        }

        return new Pemilih([
            'user_id' => auth()->user()->id,
            'kelas_jabatan' => $temp = $row['kelasjabatan'] ?? $row['jabatankelas'] ?? $row['jabatan'] ?? $row['kelas'],
            'nama' => $row['nama'],
            'jenis_kelamin' => str_replace(' ', '', Str::ucfirst($row['jenis_kelamin'])),
            'email' => $row['email'],
            'password' => Hash::make($password),
            'slug' => SlugService::createSlug(Pemilih::class, 'slug', $row['nama'])
        ]);
    }

    public function uniqueBy()
    {
        return 'email';
    }
}
