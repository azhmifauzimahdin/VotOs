<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class VerifikasiLaporanController extends Controller
{
    public function index($kode)
    {
        return view('verifikasi', [
            'title' => 'Verifikasi Hasil Pemilu',
            'verifikasi' => Laporan::where('kode', $kode)->get()
        ]);
    }
}
