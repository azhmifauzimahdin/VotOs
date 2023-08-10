<?php

namespace App\Imports;

use App\Models\Jabatan;
use App\Models\Pemilih;
use Illuminate\Support\Str;
use App\Jobs\SendAccountJob;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Cviebrock\EloquentSluggable\Services\SlugService;

class GuruKaryawanImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {
        $jabatan = Jabatan::where('nama', $row['jabatan'])->first();
        if ($jabatan) {
            $row['jabatan'] = $jabatan->id;
        } else {
            $validateData['nama'] = $row['jabatan'];
            $validateData['slug'] = SlugService::createSlug(Jabatan::class, 'slug', $row['jabatan']);
            $jabatanID = Jabatan::create($validateData);
            $row['jabatan'] = $jabatanID->id;
        }

        $password = Str::random(6);
        $details = [
            'email' => $row['email'],
            'nama' => $row['nama'],
            'password' => $password,
            'url' => 'http://' . request()->getHttpHost() . '/loginPemilih'
        ];
        dispatch(new SendAccountJob($details));

        return new Pemilih([
            'user_id' => auth()->user()->id,
            'jabatan_id' => $row['jabatan'],
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
