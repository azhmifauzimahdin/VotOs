<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Pemilih;
use Illuminate\Support\Str;
use App\Jobs\SendAccountJob;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SiswaImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {
        $kelas = Kelas::where('nama', $row['kelas'])->first();
        if ($kelas) {
            $row['kelas'] = $kelas->id;
        } else {
            $validateData['nama'] = $row['kelas'];
            $validateData['slug'] = SlugService::createSlug(Kelas::class, 'slug', $row['kelas']);
            $kelasID = Kelas::create($validateData);
            $row['kelas'] = $kelasID->id;
        }

        $password = Str::random(6);
        $details = [
            'email' => $row['email'],
            'nama' => $row['nama'],
            'password' => $password,
            'url' => 'http://' . request()->getHttpHost() . '/loginPemilih'
        ];
        // dispatch(new SendAccountJob($details));

        return new Pemilih([
            'user_id' => auth()->user()->id,
            'kelas_id' => $row['kelas'],
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
