<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilih;
use App\Models\Kandidat;

class UserBerandaController extends Controller
{
    public function index()
    {
        return view('beranda', [
            "title" => "Beranda",
            'pemilihs' => Pemilih::get(),
            'kandidats' => Kandidat::get()
        ]);
    }
}
