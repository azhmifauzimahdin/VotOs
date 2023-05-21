<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voting;

class DashboardVotingController extends Controller
{
    public function index()
    {
        return view('dashboard.voting.index', [
            'title' => 'Data Voting',
            'votings' => Voting::latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }
}
