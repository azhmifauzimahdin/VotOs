<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Models\Pemilih;
use App\Models\Kandidat;
use App\Models\Laporan;
use App\Models\PemungutanSuara;
use App\Models\SuratSuara;

class UserBerandaController extends Controller
{
    public function index()
    {
        $pemilu = Pemilu::first();
        $waktupemilubelumdimulai = false;
        $waktupemiluberlangsung = false;
        $waktupemilu = Carbon::now();

        if ($pemilu) {
            $waktupemilubelumdimulai = $waktupemilu->isBefore($pemilu->mulai);
            $waktupemiluberlangsung = $waktupemilu->isAfter($pemilu->mulai) && $waktupemilu->isBefore($pemilu->selesai);
            $waktupemilu = $pemilu->mulai;
        }

        return view('beranda', [
            'title' => "Beranda",
            'laporan' => Laporan::first(),
            'waktupemilu' => $waktupemilu,
            'pemilu' => $pemilu,
            'waktupemilubelumdimulai' => $waktupemilubelumdimulai,
            'waktupemiluberlangsung' => $waktupemiluberlangsung,
        ]);
    }
}
