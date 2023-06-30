<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\SuratSuara;
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
            if(!$voting->status){
                $validateData['status'] = true;
                Voting::where('kode', $request->qr_code)->update($validateData);
            }
            return response()->json([
                'status' => 200,
                'kandidat' => $kandidat,
                'kode' => $voting->status
            ]);
        }else{
            return response()->json([
                'status' => 404,
            ]);

        }
    }
}
