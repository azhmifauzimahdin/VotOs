<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Models\Laporan;
use App\Models\Kandidat;
use App\Models\SuratSuara;
use Illuminate\Http\Request;

class DashboardScanController extends Controller
{
    public function index()
    {
        $cekScan = false;
        if (count(SuratSuara::where('status', 1)->get()) == count(SuratSuara::whereNotNull('kode')->get())) {
            $cekScan = true;
        }

        return view('dashboard.scan.index', [
            'title' => 'Scan Surat Suara',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'cekScan' => $cekScan,
            'surat_suara' => SuratSuara::whereNotNull('kode')->get(),
            'sudah_scan' => SuratSuara::whereNotNull('kode')->where('status', true)->get(),
            'waktupemiluselesai' => $this->cekWaktuPemiluSelesai()
        ]);
    }

    public function validasi(Request $request)
    {
        $suratSuara = SuratSuara::where('kode', $request->qr_code)->first();
        if ($suratSuara) {
            if (!$suratSuara->status) {
                SuratSuara::where('id', $suratSuara->id)->update(['status' => true]);
                SuratSuara::where('kandidat_id', $suratSuara->kandidat_id)->increment('perhitungan_suara');
            }
            return response()->json([
                'status' => 200,
                'suratSuara' => $suratSuara,
                'kode' => $suratSuara->status,
                'kandidat' => Kandidat::where('nomor', $suratSuara->kandidat_id)->first()
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }

    public function scanUlang()
    {
        SuratSuara::whereNotNull('kode')->where('status', '=', 1)->update(['status' => 0]);
        SuratSuara::whereNotNull('kode')->where('perhitungan_suara', '>', 0)->update(['perhitungan_suara' => 0]);

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
