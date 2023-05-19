<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pemilih()
    {
        return $this->belongsTo(Pemilih::class);
    }

    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}
