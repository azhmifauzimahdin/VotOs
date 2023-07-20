<?php

namespace App\Http\Controllers;

use App\Models\Voting;
use App\Models\Kandidat;
use App\Models\Pemilu;
use App\Models\Otp;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            $reloadpage = true;
            if ($now->isAfter($pemilu->mulai)) {
                $reloadpage = false;
            };
        }

        return view('voting', [
            'title' => 'Voting',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'status' => Voting::where('pemilih_id', $this->cekIdUser())->first(),
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
                'slug' => 'required',
            ]
        );
        $update = $request->update;
        $this->generateOtp();

        if ($update) {
            return redirect()->route('pemilih.voting.otp', ['slug' => $validateData['slug']])->with('message', 'Kode OTP telah dikirim ulang');
        }
        return redirect()->route('pemilih.voting.otp', ['slug' => $validateData['slug']]);
    }

    public function generateOtp()
    {
        $pemilih_id = auth('pemilih')->user()->id;
        $verificationCode = Otp::where('pemilih_id', $pemilih_id)->first();
        $otp = rand(123456, 999999);
        $details = [
            'nama' => auth('pemilih')->user()->nama,
            'kode' => $otp
        ];

        Mail::to(auth('pemilih')->user()->email)->send(new SendEmail($details));

        if ($verificationCode) {
            return $verificationCode->update([
                'otp' => $otp,
                'expire_at' => Carbon::now()->addMinutes(2)
            ]);
        }

        return Otp::create([
            'pemilih_id' => $pemilih_id,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addMinutes(2)
        ]);
    }

    public function otp($slug)
    {
        $id = $this->cekIdUser();
        $status = Voting::where('pemilih_id', $id)->first();
        if ($status) {
            abort(403);
        }

        return view('otp')->with([
            'title' => 'One Time Password',
            'slug' => $slug,
            'kandidat' => Kandidat::where('slug', $slug)->first()
        ]);
    }

    public function VoteWithOtp(Request $request)
    {
        $request->validate([
            'slugVote' => 'required',
            'otp' => 'required'
        ]);

        $kandidat = Kandidat::where('slug', $request->slugVote)->first();
        $kode = $this->generateKodeVoting();
        $validateData = [
            'pemilih_id' => auth('pemilih')->user()->id,
            'kandidat_id' => $kandidat->id,
            'kode' => $kode,
            'qr_code' => QrCode::size(300)->errorCorrection('M')->generate($kode)
        ];

        $verificationCode = Otp::where('pemilih_id', $validateData['pemilih_id'])->first();

        $now = Carbon::now();
        if ($request->otp !== $verificationCode->otp) {
            return redirect()->back()->with('errormessage', 'Kode OTP salah!');
        } elseif ($request->otp === $verificationCode->otp && $now->isAfter($verificationCode->expire_at)) {
            return redirect()->back()->with('errormessage', 'Kode OTP telah kadaluarsa!');
        }

        Otp::destroy($verificationCode->id);
        Voting::create($validateData);
        Kandidat::where('id', $validateData['kandidat_id'])->increment('jumlah_suara', 1);

        return redirect('/voting');
    }

    public function generateKodeVoting()
    {
        $kode = Str::random(100);
        $voting = Voting::get();
        if ($voting) {
            foreach ($voting as $data) {
                if ($data->kode == $kode) {
                    return $this->generateKodeVoting();
                }
            }
        }
        return $kode;
    }

    public function cetakPdfQrCode()
    {
        $id = $this->cekIdUser();
        $voting = Voting::where('pemilih_id', $id)->first();

        return view('cetakQrCode', [
            'title' => 'Cetak QR Code',
            'voting' => $voting
        ]);
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
