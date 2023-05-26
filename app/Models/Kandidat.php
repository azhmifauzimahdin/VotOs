<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Kandidat extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function scopeHasil($query){
        $kandidat = Kandidat::all();
        $query = [];
        foreach($kandidat as $data){
            $query[] = $data->jumlah_suara;
        }
        return $query;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('jk', 'like', '%' . $search . '%')
                ->orWhere('visi', 'like', '%' . $search . '%')
                ->orWhere('misi', 'like', '%' . $search . '%')
                ->orWhere('nomor', 'like', '%' . $search . '%');
        });
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

    public function votings()
    {
        return $this->hasMany(Voting::class);
    }
}
