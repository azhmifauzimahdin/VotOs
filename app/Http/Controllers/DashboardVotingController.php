<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voting;
use App\Models\Kandidat;

class DashboardVotingController extends Controller
{
    public function index()
    {
        return view('dashboard.voting.index', [
            'title' => 'Data Voting',
            'votings' => Voting::latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    public function rekapitulasi()
    {
        return view('dashboard.rekapitulasi.index', [
            'title' => 'Rekapitulasi',
            'votings' => Voting::latest()->filter(request(['search', 'kandidat', 'kelas']))->paginate(10)->withQueryString(),
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get()
        ]);
    }
}
