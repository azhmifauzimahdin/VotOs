<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Laporan;
use App\Models\Pemilu;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $pemilu = Pemilu::first();
        $laporan = Laporan::first();
        $kandidats = Kandidat::get();
        $now = Carbon::now();
        $waktupemilu = $now;

        $label = [];
        $hasil = [];
        if ($pemilu) {
            $waktupemilu = $pemilu->mulai;
            if ($now->isAfter($pemilu->selesai) || $laporan->jumlah_belum_memilih == 0) {
                foreach ($kandidats as $data) {
                    $label[] = $data->nama;
                    $hasil[] = count($data->suratSuara) ? intval($data->suratSuara[0]->perolehan_suara) : 0;
                }
            }
        }

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'label' => $label,
            'hasil' => $hasil,
            'laporan' => $laporan,
            'waktupemilu' => $waktupemilu,
            'pemilu' => $pemilu
        ]);
    }
}
