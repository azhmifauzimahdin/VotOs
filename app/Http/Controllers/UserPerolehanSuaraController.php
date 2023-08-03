<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\Pemilu;
use App\Models\Pemilih;
use App\Models\Voting;
use Carbon\Carbon;

class UserPerolehanSuaraController extends Controller
{
    public function index()
    {
        $pemilihs = Pemilih::get();
        $votings = Voting::get();
        $kandidats = Kandidat::all();
        $pemilu = Pemilu::first();
        $now = Carbon::now();

        $label = [];
        $hasil = [];
        $cekPerolehan = null;
        if ($pemilu) {
            $cekPerolehan = $now->isAfter($pemilu->selesai) || count($pemilihs) - count($votings) == 0;
            if ($cekPerolehan) {
                foreach ($kandidats as $data) {
                    $label[] = $data->nama;
                    $hasil[] = intval($data->jumlah_suara);
                }
            }
        }

        return view('perolehan_suara', [
            'title' => 'Perolehan Suara',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'label' => $label,
            'hasil' => $hasil,
            'waktu' => $now,
            'pemilu' => $pemilu,
            'cekPerolehan' => $cekPerolehan
        ]);
    }
}
