<?php

namespace App\Http\Controllers;

use App\Models\Voting;
use App\Models\Kandidat;
use App\Models\Pemilu;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Models\VerificationCode;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserVotingController extends Controller
{
    public function index()
    {
        if(auth('pemilih')->check()){
            $id = auth('pemilih')->user()->id;
        }else{
            $id = 0;
        }
        $status = Voting::vote($id)->first();
        $qrcode = ' ';
        if($status){
            $qrcode = $status->id;
            $verificationCode = VerificationCode::where('pemilih_id', $id)->latest()->first();
            if($verificationCode){
                VerificationCode::destroy($verificationCode->id);
            }
        }
       
        return view('voting', [
            'title' => 'Voting',
            'kandidats' => Kandidat::orderBy('nomor', 'ASC')->get(),
            'votings' => Voting::get(),
            'status' => $status,
            'waktu' => Carbon::now(),
            'pemilu' => Pemilu::first(),
            'qrcode' => QrCode::size(300)->errorCorrection('H')->generate($qrcode)
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
        
        if($update){
            return redirect()->route('pemilih.voting.otp',['slug' => $validateData['slug']])->with('message', 'Kode OTP telah dikirim ulang');
        }
        return redirect()->route('pemilih.voting.otp',['slug' => $validateData['slug']]);
    }

    public function generateOtp()
    {
        $pemilih_id = auth('pemilih')->user()->id;
        $verificationCode = VerificationCode::where('pemilih_id', $pemilih_id)->latest()->first();
        $otp = rand(123456, 999999);
        $encryptOtp = Crypt::encryptString($otp);
        $details = [
            'name'=> auth('pemilih')->user()->nama,
            'kode' => $otp,
            // 'url'=>'http://www.votos.test/coba/'.$slug.'/'.$otp.'/'.auth('pemilih')->user()->id
        ];
 
        Mail::to(auth('pemilih')->user()->email)->send(new SendEmail($details));

        if($verificationCode){
            return $verificationCode->update([
                'otp' => $encryptOtp,
                'expire_at' => Carbon::now()->addMinutes(2)
            ]);
        }
        
        return VerificationCode::create([
            'pemilih_id' => $pemilih_id,
            'otp' => $encryptOtp,
            'expire_at' => Carbon::now()->addMinutes(2)
        ]);
    }

    public function otp($slug)
    {
        if(auth('pemilih')->check()){
            $id = auth('pemilih')->user()->id;
        }else{
            $id = 0;
        }

        $status = Voting::vote($id)->first();
        if($id === 0 || $status){
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
            'slug' => 'required',
            'otp' => 'required'
        ]);
        $kandidat = Kandidat::where('slug', $request->slug)->first();
        $validateData = [
            'pemilih_id' => auth('pemilih')->user()->id,
            'kandidat_id' => $kandidat->id,
        ];

        $verificationCode = VerificationCode::where('pemilih_id', $validateData['pemilih_id'])->first();
        try {
            $decryptOtp = Crypt::decryptString($verificationCode->otp);
        } catch (DecryptException $e) {
            return redirect()->back()->with('errormessage', 'Gagal deskripsi data!');
        }

        $now = Carbon::now();
        if ($request->otp !== $decryptOtp) {
            return redirect()->back()->with('errormessage', 'Kode OTP salah!');
        }elseif($request->otp === $decryptOtp && $now->isAfter($verificationCode->expire_at)){
            return redirect()->back()->with('errormessage', 'Kode OTP telah kadaluarsa!');
        }

        $verificationCode->update([
            'expire_at' => Carbon::now()
        ]);

        Voting::create($validateData);
        Kandidat::where('id', $validateData['kandidat_id'])->increment('jumlah_suara',1);

        return redirect('/voting')->with('message', 'Hasil voting berhasil ditambahkan');
    }

    public function cetakPdfQrCode(){
        if(auth('pemilih')->check()){
            $id = auth('pemilih')->user()->id;
        }else{
            $id = 0;
        }

        $status = Voting::vote($id)->get();
        $qrcode = ' ';
        if($status){
            foreach($status as $data){
                $qrcode = $data->id;
            }
        }

        return view('cetakQrCode', [
            'title' => 'Cetak QR Code',
            'qrcode' => QrCode::size(400)->errorCorrection('H')->generate($qrcode)
        ]);
    }

}
