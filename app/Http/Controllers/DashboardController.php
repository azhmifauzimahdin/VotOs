<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilih;
use App\Models\Kandidat;
use App\Models\Voting;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'pemilihs' => Pemilih::get(),
            'kandidats' => Kandidat::get(),
            'votings' => Voting::get()
        ]);
    }
}
