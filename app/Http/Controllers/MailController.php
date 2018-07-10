<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\GuestMail;
use Session;

class MailController extends Controller
{
    public function send(){
        Mail::send(new GuestMail());
        Session::flash('success', 'Pesan terkirim');
        return redirect('/admin/message-guest');
    }
}
