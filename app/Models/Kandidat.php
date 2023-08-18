<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Kandidat extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];
    protected $primaryKey = 'nomor';

    public function scopeHasil($query)
    {
        $kandidat = Kandidat::all();
        $query = [];
        foreach ($kandidat as $data) {
            $query[] = $data->jumlah_suara;
        }
        return $query;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nomor', 'like', '%' . $search . '%')
                ->orWhere('nama', 'like', '%' . $search . '%')
                ->orWhere('kelas', 'like', '%' . $search . '%')
                ->orWhere('jabatan_sebelumnya', 'like', '%' . $search . '%')
                ->orWhere('jenis_kelamin', 'like', '%' . $search . '%');
        });

        // $query->when($filters['hasilPemilu'] ?? false, function ($query, $search) {
        //     return $query->where('nama', 'like', '%' . $search . '%')
        //         ->orWhere('nomor', 'like', '%' . $search . '%')
        //         ->orWhere('jumlah_suara', 'like', '%' . $search . '%');
        // });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

    public function suratSuara()
    {
        return $this->hasMany(SuratSuara::class, 'kandidat_id');
    }
}
