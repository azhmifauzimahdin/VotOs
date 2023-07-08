<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilih;
use App\Models\Kandidat;
use App\Models\Voting;
use Illuminate\Support\Facades\Hash;

class UserBerandaController extends Controller
{
    public function index()
    {
        // $temp = Pemilih::first();
        // if (Hash::check('YOiTM4', $temp->password)) {
        //     ddd("Masuk");
        // }
        // ddd("Keluar");
        return view('beranda', [
            "title" => "Beranda",
            'pemilihs' => Pemilih::get(),
            'kandidats' => Kandidat::get(),
            'votings' => Voting::get()
        ]);
    }
}
