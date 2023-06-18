<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilih;
use App\Models\Kandidat;
use App\Models\Voting;
use App\Models\Pemilu;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $pemilihs = Pemilih::get();
        $votings = Voting::get();
        $kandidats = Kandidat::get();
        $pemilu = Pemilu::first();
        $now = Carbon::now();

        $label[] = [];
        $hasil[] = [];
        if($pemilu){
            if ($now->isAfter($pemilu->selesai) || count($pemilihs) - count($votings) == 0){
                foreach($kandidats as $data){
                    $label[] = $data->nama;
                    $hasil[] = $data->jumlah_suara;
                }
            }
        }

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'pemilihs' => $pemilihs,
            'votings' => $votings,
            'kandidats' => $kandidats,
            'label' => $label,
            'hasil' => $hasil,
        ]);
    }
}
