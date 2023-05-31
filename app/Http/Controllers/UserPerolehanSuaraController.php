<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\Pemilu;
use Carbon\Carbon;

class UserPerolehanSuaraController extends Controller
{
    public function index(){
        $kandidats = Kandidat::all();
        $pemilu = Pemilu::first();
        $now = Carbon::now();

        if($pemilu){
            if ($now->isAfter($pemilu->selesai)){
                foreach($kandidats as $data){
                    $label[] = $data->nama;
                    $hasil[] = $data->jumlah_suara;
                }
            }else{
                $label[] = [];
                $hasil[] = [];
            }
        }

        return view('perolehan_suara', [
            'title' => 'Perolehan Suara',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'label' => $label,
            'hasil' => $hasil,
            'waktu' => $now,
            'pemilu' => $pemilu
        ]);
    }
}
