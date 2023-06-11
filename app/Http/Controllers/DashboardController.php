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
        $kandidats = Kandidat::all();
        $pemilu = Pemilu::first();
        $now = Carbon::now();

        $label[] = [];
        $hasil[] = [];
        if($pemilu){
            if ($now->isAfter($pemilu->selesai)){
                foreach($kandidats as $data){
                    $label[] = $data->nama;
                    $hasil[] = $data->jumlah_suara;
                }
            }
        }

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'pemilihs' => Pemilih::get(),
            'votings' => Voting::get(),
            'kandidats' => $kandidats,
            'label' => $label,
            'hasil' => $hasil,
        ]);
    }
}
