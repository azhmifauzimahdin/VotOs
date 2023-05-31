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
        if($status){
            $qrcode = 'ID Voting : '.$status->id.', Nomor Kandidat : '.$status->kandidat->nomor.', Nama : '.$status->kandidat->nama;
            $verificationCode = VerificationCode::where('pemilih_id', $id)->latest()->first();
            if($verificationCode){
                VerificationCode::destroy($verificationCode->id);
            }
        }
        $qrcode = ' ';
       
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
        $details = [
            'name'=> auth('pemilih')->user()->nama,
            'kode' => $otp,
            // 'url'=>'http://www.votos.test/coba/'.$slug.'/'.$otp.'/'.auth('pemilih')->user()->id
        ];
 
        Mail::to(auth('pemilih')->user()->email)->send(new SendEmail($details));

        if($verificationCode){
            return $verificationCode->update([
                'otp' => $otp,
                'expire_at' => Carbon::now()->addMinutes(2)
            ]);
        }
        
        return VerificationCode::create([
            'pemilih_id' => $pemilih_id,
            'otp' => $otp,
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
        $verificationCode = VerificationCode::where('pemilih_id', $validateData['pemilih_id'])->where('otp', $request->otp)->first();

        $now = Carbon::now();
        if (!$verificationCode) {
            return redirect()->back()->with('errormessage', 'Kode OTP salah!');
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            return redirect()->back()->with('errormessage', 'Kode OTP telah kadaluarsa!');
        }

        $verificationCode->update([
            'expire_at' => Carbon::now()
        ]);

        Voting::create($validateData);
        Kandidat::where('id', $validateData['kandidat_id'])->increment('jumlah_suara',1);

        return redirect('/voting')->with('message', 'Hasil voting berhasil ditambahkan');
    }

    // Vote button email
    // public function VoteWithOtpEmail($slug, $otp, $id)
    // {
    //     $kandidat = Kandidat::where('slug', $slug)->first();
    //     $validateData = [
    //         'pemilih_id' => $id,
    //         'kandidat_id' => $kandidat->id,
    //     ];
    //     $verificationCode = VerificationCode::where('pemilih_id', $validateData['pemilih_id'])->where('otp', $otp)->first();

    //     $now = Carbon::now();
    //     if (!$verificationCode) {
    //         return redirect()->back()->with('errormessage', 'Kode OTP salah!');
    //     }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
    //         return redirect()->back()->with('errormessage', 'Kode OTP telah kadaluarsa!');
    //     }

    //     $verificationCode->update([
    //         'expire_at' => Carbon::now()
    //     ]);

    //     Voting::create($validateData);
    //     Kandidat::where('id', $validateData['kandidat_id'])->increment('jumlah_suara',1);

    //     return redirect('/voting')->with('message', 'Hasil voting berhasil ditambahkan');
    // }

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
                $qrcode = 'ID Voting : '.$data->id.', Nomor Kandidat : '.$data->kandidat->nomor.', Nama : '.$data->kandidat->nama;
            }
        }

        return view('cetakQrCode', [
            'title' => 'Cetak QR Code',
            'qrcode' => QrCode::size(400)->errorCorrection('H')->generate($qrcode)
        ]);
    }

}
