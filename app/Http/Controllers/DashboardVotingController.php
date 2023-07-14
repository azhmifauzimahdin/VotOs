<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voting;
use App\Models\Kandidat;
use App\Models\Kelas;

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
            'votings' => Voting::latest()->filter(request(['search', 'kandidat']))->paginate(10)->withQueryString(),
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'kelas' => Kelas::orderBy('nama', 'ASC')->get()
        ]);
    }

    public function cetakPdf()
    {
        return view('dashboard.voting.print', [
            'title' => 'Cetak Data Voting',
            'votings' => Voting::latest()->get()
        ]);
    }

    public function cetakPdfSuratSuara()
    {
        return view('dashboard.voting.printSuratSuara', [
            'title' => 'Cetak Data Voting',
            'votings' => Voting::latest()->get()
        ]);
    }

    public function cetakPdfRekapitulasi()
    {
        return view('dashboard.rekapitulasi.print', [
            'title' => 'Cetak Rekapitulasi Voting',
            'votings' => Voting::latest()->filter(request(['kandidat', 'kelas']))->get()
        ]);
    }
}
