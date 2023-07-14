<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;

class UserKandidatController extends Controller
{
    public function index()
    {
        return view('kandidat', [
            "title" => "Kandidat",
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get()
        ]);
    }

    public function detail($slug)
    {
        return view('detail_kandidat', [
            'title' => 'Detail Kandidat',
            'kandidat' => Kandidat::where('slug', $slug)->first()
        ]);
    }
}
