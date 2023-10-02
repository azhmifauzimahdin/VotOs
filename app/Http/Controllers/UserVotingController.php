<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Mail\SendEmail;
use App\Models\Laporan;
use App\Models\Kandidat;
use App\Models\SuratSuara;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserVotingController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $pemilu = Pemilu::first();
        $waktupemilubelumdimulai = false;
        $waktupemiluselesai = false;
        $waktupemiluberlangsung = false;
        $waktupemilu = $now;
        $reloadpage = false;
        if ($pemilu) {
            $waktupemilubelumdimulai = $now->isBefore($pemilu->mulai);
            $waktupemiluselesai = $now->isAfter($pemilu->selesai);
            $waktupemiluberlangsung = $now->isAfter($pemilu->mulai) && $now->isBefore($pemilu->selesai);
            $waktupemilu = $pemilu->mulai;
            $reloadpage = $now->isAfter($pemilu->mulai) ? false : true;
        }

        return view('voting', [
            'title' => 'Voting',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'suratSuara' => SuratSuara::where('pemilih_id', $this->cekIdUser())->first(),
            'pemilu' => $pemilu,
            'waktupemilubelumdimulai' => $waktupemilubelumdimulai,
            'waktupemiluselesai' => $waktupemiluselesai,
            'waktupemiluberlangsung' => $waktupemiluberlangsung,
            'waktupemilu' => $waktupemilu,
            'reloadpage' => $reloadpage
        ]);
    }

    public function generate(Request $request)
    {
        $validateData = $request->validate(
            [
                'nomor' => 'required',
            ]
        );
        $update = $request->update;
        $this->generateOtp($validateData['nomor']);

        if ($update) {
            return redirect()->route('pemilih.voting.otp')->with('message', 'Kode OTP telah dikirim ulang');
        }
        return redirect()->route('pemilih.voting.otp');
    }

    public function generateOtp($kandidat_id)
    {
        $pemilih_id = auth('pemilih')->user()->id;
        $otp = rand(123456, 999999);
        $details = [
            'nama' => auth('pemilih')->user()->nama,
            'kode' => $otp
        ];

        Mail::to(auth('pemilih')->user()->email)->send(new SendEmail($details));

        $perolehanSuara = SuratSuara::where('kandidat_id', $kandidat_id)->first();
        $verificationCode = SuratSuara::where('pemilih_id', $pemilih_id)->first();
        if ($verificationCode) {
            return $verificationCode->update([
                'kandidat_id' => $kandidat_id,
                'perolehan_suara' => $perolehanSuara ? $perolehanSuara->perolehan_suara : 0,
                'otp' => $otp,
                'waktu_kadaluarsa' => Carbon::now()->addMinutes(2)
            ]);
        }

        return SuratSuara::create([
            'pemilih_id' => $pemilih_id,
            'kandidat_id' => $kandidat_id,
            'perolehan_suara' => $perolehanSuara ? $perolehanSuara->perolehan_suara : 0,
            'otp' => $otp,
            'waktu_kadaluarsa' => Carbon::now()->addMinutes(2)
        ]);
    }

    public function otp()
    {
        $id = $this->cekIdUser();
        $suratSuara = SuratSuara::where('pemilih_id', $id)->first();
        $pemilu = Pemilu::first();
        $waktupemilubelumdimulai = false;
        $waktupemiluselesai = false;
        $now = Carbon::now();

        if ($pemilu) {
            $waktupemilubelumdimulai = $now->isBefore($pemilu->mulai);
            $waktupemiluselesai = $now->isAfter($pemilu->selesai);
        }

        if (!$suratSuara || $suratSuara->kode || !$pemilu || $waktupemilubelumdimulai || $waktupemiluselesai) {
            abort(403);
        }

        return view('otp')->with([
            'title' => 'One Time Password',
            'suratSuara' => $suratSuara
        ]);
    }

    public function VoteWithOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $kode = $this->generateKodeVoting();
        $validateData = [
            'otp' => 0,
            'kode' => $kode,
            'qr_code' => QrCode::size(300)->errorCorrection('M')->generate($kode),
            'waktu' => Carbon::now()
        ];

        $pemilih_id = auth('pemilih')->user()->id;
        $suratSuara = SuratSuara::where('pemilih_id', $pemilih_id)->first();

        $now = Carbon::now();
        if (intval($request->otp) !== intval($suratSuara->otp)) {
            return redirect()->back()->with('errormessage', 'Kode OTP salah!');
        } elseif (intval($request->otp) === intval($suratSuara->otp) && $now->isAfter($suratSuara->waktu_kadaluarsa)) {
            return redirect()->back()->with('errormessage', 'Kode OTP telah kadaluarsa!');
        }

        $suratSuara->update($validateData);
        SuratSuara::where('kandidat_id', $suratSuara->kandidat_id)->increment('perolehan_suara');

        $laporan = Laporan::where('id', 1)->first();
        $laporan->increment('jumlah_belum_memilih', -1);
        $laporan->increment('jumlah_sudah_memilih');

        return redirect('/voting');
    }

    public function generateKodeVoting()
    {
        $kode = Str::random(100);
        $voting = SuratSuara::get();
        if ($voting) {
            foreach ($voting as $data) {
                if ($data->kode == $kode) {
                    return $this->generateKodeVoting();
                }
            }
        }
        return $kode;
    }

    public function cekIdUser()
    {
        $id = 0;
        if (auth('pemilih')->check()) {
            $id = auth('pemilih')->user()->id;
        }
        return $id;
    }
}
