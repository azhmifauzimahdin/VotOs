<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;

class UserPerolehanSuaraController extends Controller
{
    public function index(){
        $kandidats = Kandidat::all();
        foreach($kandidats as $data){
            $label[] = $data->nama;
            $hasil[] = $data->jumlah_suara;
        }

        return view('perolehan_suara', [
            'title' => 'Perolehan Suara',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'label' => $label,
            'hasil' => $hasil
        ]);
    }
}
