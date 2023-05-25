<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\Voting;

class UserPerolehanSuaraController extends Controller
{
    public function index(){
        return view('perolehan_suara', [
            'title' => 'Perolehan Suara',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get()
        ]);
    }
}
