<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilih;
use App\Models\Kandidat;
use App\Models\Voting;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $kandidats = Kandidat::all();
        foreach($kandidats as $data){
            $label[] = $data->nama;
            $hasil[] = $data->jumlah_suara;
        }

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'pemilihs' => Pemilih::get(),
            'votings' => Voting::get(),
            'kandidats' => $kandidats,
            'label' => $label,
            'hasil' => $hasil
        ]);
    }
}
