<?php

namespace App\Http\Controllers;

use App\Models\Pemilih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserGantiPasswordController extends Controller
{
    public function index()
    {
        return view('ganti_password', [
            'title' => 'Ganti Password'
        ]);
    }

    public function gantiPassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'current_password:pemilih',
            'password_baru' => 'required|min:6|confirmed|different:password_lama'
        ]);

        $validateData['password'] = Hash::make($request->password_baru);
        Pemilih::where('id', auth('pemilih')->user()->id)->update($validateData);
        return back()->with("success", "Password berhasil diganti!");
    }
}
