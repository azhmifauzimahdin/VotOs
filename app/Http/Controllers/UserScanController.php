<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserScanController extends Controller
{
    public function index()
    {
        return view('scanQRCode', [
            "title" => "Scan QR Code",
        ]);
    }

    public function validasi(Request $request){
        $voting = Voting::where('kode', $request->qr_code)->first();
        if($voting){
            $kandidat = Kandidat::where('id', $voting->kandidat_id)->first();
            return response()->json([
                'status' => 200,
                'kandidat' => $kandidat
            ]);
        }else{
            return response()->json([
                'status' => 404,
            ]);

        }
    }
}
