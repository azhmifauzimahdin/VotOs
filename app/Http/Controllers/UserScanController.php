<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\SuratSuara;
use App\Models\Voting;
use Illuminate\Http\Request;

class UserScanController extends Controller
{
    public function index()
    {
        return view('scanQRCode', [
            "title" => "Scan Suarat Suara",
        ]);
    }

    public function validasi(Request $request)
    {
        $voting = SuratSuara::where('kode', $request->qr_code)->first();
        if ($voting) {
            return response()->json([
                'status' => 200,
                'kandidat' => $voting->kandidat,
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }
}
