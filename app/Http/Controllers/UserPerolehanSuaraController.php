<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Models\Laporan;
use App\Models\Pemilih;
use App\Models\Kandidat;
use App\Models\SuratSuara;
use Illuminate\Http\Request;
use App\Models\PerolehanSuara;
use App\Models\PemungutanSuara;

class UserPerolehanSuaraController extends Controller
{
    public function index()
    {
        $pemilu = Pemilu::first();
        $laporan = Laporan::first();
        $kandidats = Kandidat::get();
        $now = Carbon::now();
        $pemiluSelesai = false;

        $label = [];
        $hasil = [];
        if ($pemilu) {
            if ($now->isAfter($pemilu->selesai) || $laporan->jumlah_belum_memilih == 0) {
                $pemiluSelesai = true;
                foreach ($kandidats as $data) {
                    $label[] = $data->nama;
                    $hasil[] = count($data->suratSuara) ? intval($data->suratSuara[0]->perolehan_suara) : 0;
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
            'pemiluSelesai' => $pemiluSelesai
        ]);
    }
}
