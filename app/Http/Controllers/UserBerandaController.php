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
        $waktupemilu = Carbon::now();
        if ($pemilu) {
            $waktupemilu = $pemilu->mulai;
        }

        return view('beranda', [
            'title' => "Beranda",
            'pemilihs' => Pemilih::get(),
            'kandidats' => Kandidat::get(),
            'votings' => Voting::get(),
            'waktupemilu' => $waktupemilu,
            'pemilu' => $pemilu
        ]);
    }
}
