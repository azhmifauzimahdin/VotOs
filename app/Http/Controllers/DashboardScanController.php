<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Models\Voting;
use App\Models\Kandidat;
use Illuminate\Http\Request;

class DashboardScanController extends Controller
{
    public function index()
    {
        $cekScan = false;
        if (count(Voting::where('status', 1)->get()) == count(Voting::get())) {
            $cekScan = true;
        }

        return view('dashboard.scan.index', [
            "title" => "Scan Surat Suara",
            "kandidats" => Kandidat::orderBy('nomor', 'ASC')->get(),
            "cekScan" => $cekScan,
            "surat_suara" => Voting::get(),
            "sudah_scan" => Voting::where('status', true)->get(),
            "waktupemiluselesai" => $this->cekWaktuPemiluSelesai()
        ]);
    }

    public function validasi(Request $request)
    {
        $voting = Voting::where('kode', $request->qr_code)->first();
        if ($voting) {
            $kandidat = Kandidat::where('id', $voting->kandidat_id)->first();
            if (!$voting->status) {
                $validateData['status'] = true;
                Voting::where('id', $voting->id)->update($validateData);
                Kandidat::where('id', $voting->kandidat_id)->increment('hitung_suara', 1);
            }
            return response()->json([
                'status' => 200,
                'kandidat' => $kandidat,
                'kode' => $voting->status
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }

    public function scanUlang()
    {
        Kandidat::where('hitung_suara', '>', 0)->update(['hitung_suara' => 0]);
        Voting::where('status', '=', 1)->update(['status' => 0]);

        return redirect('/dashboard/scan')->with('success', 'Data hasil perhitungan scan surat suara berhasil dihapus!');
    }

    public function cekWaktuPemiluSelesai()
    {
        $pemilu = Pemilu::first();
        $now = Carbon::now();
        $cekwaktupemilu = false;
        if ($pemilu) {
            $cekwaktupemilu = $now->isAfter($pemilu->selesai);
        }

        return $cekwaktupemilu;
    }
}
