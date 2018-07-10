<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\GuestMessage;

class GuestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        // $guest = GuestMessage::find($id);
        return $this->view('mail.mail',
                            ['name' =>$request->name , 'msg' => $request->message])
                            ->to($request->email)->subject('Notifikasi pesan masuk')
                            ->from('itesegaunud@gmail.com', 'IT-ESEGA');
    }
}
