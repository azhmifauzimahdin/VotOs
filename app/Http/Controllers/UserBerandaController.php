<?php

namespace App\Http\Controllers;

use App\Models\Pemilu;
use App\Models\Voting;
use App\Models\Pemilih;
use App\Models\Kandidat;
use Carbon\Carbon;

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
            'pemilihs' => Pemilih::get(),
            'kandidats' => Kandidat::get(),
            'votings' => Voting::get(),
            'waktupemilu' => $waktupemilu,
            'pemilu' => $pemilu,
            'waktupemilubelumdimulai' => $waktupemilubelumdimulai,
            'waktupemiluberlangsung' => $waktupemiluberlangsung,
        ]);
    }
}
