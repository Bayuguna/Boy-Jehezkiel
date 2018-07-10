<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminMessage;
use App\User;
use App\UserMessage;
use App\AdminMessageTemporary;
use Auth;
use DB;
use Validator;
use App\UserMessageTemporary;
use Session;
use App\Admin;
use App\Notifications\NotifyInboxAdmin;
use Notification;

class UserMessageController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = AdminMessageTemporary::where('view', '=', 0)->get();
        $allMessage = AdminMessageTemporary::orderBy('id', 'desc')->get();
        return view('messages.usermessagein', compact('message', 'allMessage'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sentMsg()
    {
        $message = AdminMessageTemporary::where('view', '=', 0)->get();
        $userMessage = UserMessage::orderBy('id', 'desc')->get();
        return view('messages.usermessageout', compact('message', 'userMessage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ],[

            'subject.required' => 'Kolom subjek harus diisi',
            'subject.max:255' => 'Subjek tidak boleh lebih dari 255 karakter',
            'message.required' => 'Kolom Pesan harus diisi',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Pesan gagal dikirim');
            return redirect('/user/message')
                        ->withErrors($validator)
                        ->withInput();
        }

        $message = new UserMessage;
        $message->user_id = Auth::user()->id;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        $message_temp = new UserMessageTemporary;
        $message_temp->user_id = Auth::user()->id;
        $message_temp->subject = $request->subject;
        $message_temp->message = $request->message;
        $message_temp->save();

        $admins = Admin::all();
        Notification::send($admins, new NotifyInboxAdmin);

        Session::flash('success', 'Pesan berhasil dikirim');
        return redirect('/user/message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function msgToAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ],[

            'subject.required' => 'Kolom subjek harus diisi',
            'subject.max:255' => 'Subjek tidak boleh lebih dari 255 karakter',
            'message.required' => 'Kolom Pesan harus diisi',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Pesan gagal dikirim');
            return redirect('/user/message-out')
                        ->withErrors($validator)
                        ->withInput();
        }

        $message = new UserMessage;
        $message->user_id = Auth::user()->id;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        $message_temp = new UserMessageTemporary;
        $message_temp->user_id = Auth::user()->id;
        $message_temp->subject = $request->subject;
        $message_temp->message = $request->message;
        $message_temp->save();

        Session::flash('success', 'Pesan berhasil dikirim');
        return redirect('/user/message-out');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentMessage = AdminMessageTemporary::find($id);
        $message = AdminMessageTemporary::where('view', '=', 0)->get();
        // update view status
        $currentMessage->view = 1;
        $currentMessage->save();
        return view('messages.usershowmessagein', compact('message', 'currentMessage'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function seeMsg($id)
    {
        // Selecet data to compact
        $currentMessage = UserMessage::find($id);
        $message = AdminMessageTemporary::where('view', '=', 0)->get();
        return view('messages.usershowmessageout', compact('message', 'currentMessage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = AdminMessageTemporary::find($id);
        if ($message) {
            $message->delete();
        }
        Session::flash('success', 'Pesan berhasil dihapus');
        return redirect('/user/message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUserMsg($id)
    {
        $message = UserMessage::find($id);
        if ($message) {
            $message->delete();
        }
        Session::flash('success', 'Pesan berhasil dihapus');
        return redirect('/user/message-out');
    }
}
