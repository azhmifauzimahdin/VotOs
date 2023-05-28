<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class KirimEmailController extends Controller
{
    public function index()
    {
	    // $details = [
        //     'title' => 'Mail from websitepercobaan.com',
        //     'body' => 'This is for testing email using smtp'
        // ];
           
        // Mail::to('pemrograman11@gmail.com')->send(new SendEmail($details));
        $details = [
            'name'=>'Azhmi Fauzi mahdin',
            'url'=>'https://www.bacancytechnology.com/'
        ];
 
        Mail::to('pemrograman11@gmail.com')->send(new SendEmail($details));
        return back()->with('status','Mail sent successfully');;
    
    }
}
