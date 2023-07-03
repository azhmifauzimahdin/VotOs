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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserVotingController extends Controller
{
    public function index()
    {
        if (auth('pemilih')->check()) {
            $id = auth('pemilih')->user()->id;
        } else {
            $id = 0;
        }
        $voting = Voting::where('pemilih_id', $id)->first();

        return view('voting', [
            'title' => 'Voting',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'votings' => Voting::get(),
            'status' => $voting,
            'waktu' => Carbon::now(),
            'pemilu' => Pemilu::first(),
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
        $encryptOtp = Crypt::encryptString($otp);
        $details = [
            'nama' => auth('pemilih')->user()->nama,
            'kode' => $otp
        ];

        Mail::to(auth('pemilih')->user()->email)->send(new SendEmail($details));

        if ($verificationCode) {
            return $verificationCode->update([
                'otp' => $encryptOtp,
                'expire_at' => Carbon::now()->addMinutes(2)
            ]);
        }

        return Otp::create([
            'pemilih_id' => $pemilih_id,
            'otp' => $encryptOtp,
            'expire_at' => Carbon::now()->addMinutes(2)
        ]);
    }

    public function otp($slug)
    {
        if (auth('pemilih')->check()) {
            $id = auth('pemilih')->user()->id;
        } else {
            $id = 0;
        }

        $status = Voting::vote($id)->first();
        if ($id === 0 || $status) {
            abort(403);
        }

        return view('otp')->with([
            'title' => 'One Time Password',
            'slug' => $slug
        ]);
    }

    public function VoteWithOtp(Request $request)
    {
        $request->validate([
            'slugVote' => 'required',
            'otp' => 'required'
        ]);

        $kandidat = Kandidat::where('slug', $request->slugVote)->first();
        $kode = Crypt::encryptString($this->generateKodeVoting());
        $validateData = [
            'pemilih_id' => auth('pemilih')->user()->id,
            'kandidat_id' => $kandidat->id,
            'kode' => $kode,
            'qr_code' => QrCode::size(300)->errorCorrection('Q')->generate($kode)
        ];

        $verificationCode = Otp::where('pemilih_id', $validateData['pemilih_id'])->first();
        try {
            $decryptOtp = Crypt::decryptString($verificationCode->otp);
        } catch (DecryptException $e) {
            return redirect()->back()->with('errormessage', 'Gagal deskripsi data!');
        }

        $now = Carbon::now();
        if ($request->otp !== $decryptOtp) {
            return redirect()->back()->with('errormessage', 'Kode OTP salah!');
        } elseif ($request->otp === $decryptOtp && $now->isAfter($verificationCode->expire_at)) {
            return redirect()->back()->with('errormessage', 'Kode OTP telah kadaluarsa!');
        }

        Otp::destroy($verificationCode->id);
        Voting::create($validateData);
        Kandidat::where('id', $validateData['kandidat_id'])->increment('jumlah_suara', 1);

        return redirect('/voting');
    }

    public function generateKodeVoting()
    {
        $number = mt_rand(1000000000, 9999999999);
        if (count($this->CekKode($number))) {
            return $this->generateKodeVoting();
        }
        return $number;
    }

    public function CekKode($number)
    {
        $items = Voting::all()->filter(function ($record) use ($number) {
            if (Crypt::decryptString($record->kode) == $number) {
                return $record;
            }
        });
        return $items;
    }

    public function cetakPdfQrCode()
    {
        if (auth('pemilih')->check()) {
            $id = auth('pemilih')->user()->id;
        } else {
            $id = 0;
        }

        $voting = Voting::where('pemilih_id', $id)->first();

        return view('cetakQrCode', [
            'title' => 'Cetak QR Code',
            'voting' => $voting
        ]);
    }
}
