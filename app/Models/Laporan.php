<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'ketua', 'sekretaris', 'kesiswaan', 'pembina', 'kepala_sekolah', 'kode', 'qr_code'];
}
