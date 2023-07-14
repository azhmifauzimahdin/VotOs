<?php

namespace App\Http\Controllers;

use App\Models\Pemilih;
use App\Models\Kandidat;
use App\Models\Voting;

class UserBerandaController extends Controller
{
    public function index()
    {
        return view('beranda', [
            "title" => "Beranda",
            'pemilihs' => Pemilih::get(),
            'kandidats' => Kandidat::get(),
            'votings' => Voting::get()
        ]);
    }
}
