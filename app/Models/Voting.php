<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('created_at', 'like', '%' . $search . '%')
                ->orWhereHas('kandidat', function ($query) use ($search) {
                    $query->where('nomor', 'like', '%' . $search . '%')
                        ->orWhere('nama', 'like', '%' . $search . '%');
                })->orWhereHas('pemilih', function ($query) use ($search) {
                    $query->where('nisn', 'like', '%' . $search . '%')
                        ->orWhere('nama', 'like', '%' . $search . '%');
                });
        });

        $query->when($filters['kandidat'] ?? false, function ($query, $search) {
            return $query->whereHas('kandidat', function ($query) use ($search) {
                $query->where('nomor', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['kelas'] ?? false, function ($query, $search) {
            return $query->whereHas('pemilih', function ($query) use ($search) {
                $query->whereHas('kelas', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                });
            });
        });
    }

    public function pemilih()
    {
        return $this->belongsTo(Pemilih::class);
    }

    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}
