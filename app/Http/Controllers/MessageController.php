<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\UserMessage;
use App\AdminMessage;
use App\GuestMessage;
use App\AdminMessageTemporary;
use App\UserMessageTemporary;
use App\Notifications\NotifyInboxUser;
use App\User;
use Session;
use Validator;
use DB;

class MessageController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = User::all();
        $guestMessage = GuestMessage::where('view', 0)->get();
        $message = UserMessageTemporary::where('view', '=', 0)->get();
        // $allMessage = UserMessageTemporary::orderBy('id', 'desc')->get();
        $allMessage = DB::table('user_message_temporaries')
                            ->join('users', 'user_message_temporaries.user_id', '=', 'users.id')
                            ->select('user_message_temporaries.*', 'users.teamname', 'users.email')
                            ->orderBy('id', 'desc')
                            ->get();
        return view('messages.messagein', compact('readMessage', 'message', 'allMessage', 'guestMessage', 'team'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function msgGuestIndex()
    {
        $team = User::all();
        $guestMessage = GuestMessage::where('view', 0)->get();
        $message = UserMessageTemporary::where('view', '=', 0)->get();
        $allMessage = GuestMessage::orderBy('id', 'desc')->get();
        return view('messages.guestmessagein', compact('message', 'allMessage', 'guestMessage', 'team'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function msgOut()
    {
        $team = User::all();
        $guestMessage = GuestMessage::where('view', 0)->get();
        $message = UserMessageTemporary::where('view', '=', 0)->get();
        // $adminMessage = AdminMessage::orderBy('id', 'desc')->get();
        $adminMessage = DB::table('admin_messages')
                            ->join('users', 'admin_messages.team_id', '=', 'users.id')
                            ->select('admin_messages.*', 'users.teamname')
                            ->orderBy('id', 'desc')->get();
        return view('messages.messageout', compact('message', 'adminMessage', 'guestMessage', 'team'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function msgGuestShow($id)
    {
        $guestMessage = GuestMessage::where('view', 0)->get();
        $currentMessage = GuestMessage::find($id);
        $message = UserMessageTemporary::where('view', '=', 0)->get();
        $currentMessage->view = 1;
        $currentMessage->save();
        return view('messages.guestshowmessagein', compact('message', 'currentMessage', 'guestMessage'));
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
            'team_id' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ],[
            'team_id.required' => 'Kolom tim harus diisi',
            'subject.required' => 'Kolom subjek harus diisi',
            'message.required' => 'Pesan harus diisi',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Pesan gagal dikirim');
            return redirect('/admin/message')
                        ->withErrors($validator)
                        ->withInput();
        }

        $message = new AdminMessage;
        $message->team_id = $request->team_id;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        $message_temp = new AdminMessageTemporary;
        $message_temp->team_id = $request->team_id;
        $message_temp->subject = $request->subject;
        $message_temp->message = $request->message;
        $message_temp->save();

        User::find($request->team_id)->notify(new NotifyInboxUser);

        Session::flash('success', 'Pesan berhasil dikirim');
        return redirect('/admin/message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMsgInGuestView(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ],[
            'name.required' => 'Kolom nama harus diisi',
            'subject.required' => 'Kolom subjek harus diisi',
            'message.required' => 'Pesan harus diisi',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Pesan gagal dikirim');
            return redirect('/admin/message-guest')
                        ->withErrors($validator)
                        ->withInput();
        }

        $message = new AdminMessage;
        $message->team_id = $request->team_id;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        $message_temp = new AdminMessageTemporary;
        $message_temp->team_id = $request->team_id;
        $message_temp->subject = $request->subject;
        $message_temp->message = $request->message;
        $message_temp->save();

        User::find($request->team_id)->notify(new NotifyInboxUser);

        Session::flash('success', 'Pesan berhasil dikirim');
        return redirect('/admin/message-guest');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMsgInMsgOutView(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ],[
            'name.required' => 'Kolom nama harus diisi',
            'subject.required' => 'Kolom subjek harus diisi',
            'message.required' => 'Pesan harus diisi',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Pesan gagal dikirim');
            return redirect('/admin/message-out')
                        ->withErrors($validator)
                        ->withInput();
        }

        $message = new AdminMessage;
        $message->team_id = $request->team_id;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        $message_temp = new AdminMessageTemporary;
        $message_temp->team_id = $request->team_id;
        $message_temp->subject = $request->subject;
        $message_temp->message = $request->message;
        $message_temp->save();

        User::find($request->team_id)->notify(new NotifyInboxUser);

        Session::flash('success', 'Pesan berhasil dikirim');
        return redirect('/admin/message-out');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guestMessage = GuestMessage::where('view', 0)->get();
        $currentMessage = UserMessageTemporary::find($id);
        $message = UserMessageTemporary::where('view', '=', 0)->get();
        $currentMessage->view = 1;
        $currentMessage->save();
        return view('messages.showmessagein', compact('message', 'currentMessage', 'guestMessage'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function viewMsgOut($id)
    {
        $guestMessage = GuestMessage::where('view', 0)->get();
        $message = UserMessageTemporary::where('view', '=', 0)->get();
        $currentMessage = AdminMessage::find($id);
        return view('messages.showmessageout', compact('message', 'currentMessage', 'guestMessage'));

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
        $message = UserMessageTemporary::find($id);
        if ($message) {
            $message->delete();
        }
        Session::flash('success', 'Pesan berhasil dihapus');
        return redirect('/admin/message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteGuestMsg($id)
    {
        $message = GuestMessage::find($id);
        if ($message) {
            $message->delete();
        }
        Session::flash('success', 'Pesan berhasil dihapus');
        return redirect('/admin/message-guest');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAdminMsgOut($id)
    {
        $message = AdminMessage::find($id);
        if ($message) {
            $message->delete();
        }
        Session::flash('success', 'Pesan berhasil dihapus');
        return redirect('/admin/message-out');
    }
}
