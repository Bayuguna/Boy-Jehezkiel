<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Auth;
use Image;
use File;
use Validator;
use Session;
use Illuminate\Http\Request;
use App\AdminMessageTemporary;

class TeamController extends Controller {
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$message = AdminMessageTemporary::where('view', '=', 0)->get();
		$member = Member::where('teamid', Auth::user()->id)->get();
		return view('team.dashboard', compact('member', 'message'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$team = Auth::user()->$id;
		return view('team.editteam', compact('team'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(),[
			'name' => 'required|string|max:255',
			'teamname' => 'required|string|max:255',
			'description' => 'required|string',
			'email' => 'required|string|email|max:255',
			'phonenumber' => 'required|string|max:255',
			'avatar' => 'nullable|image',
		],[
			'name.required' => 'Kolom nama harus diisi',
			'name.max:255' => 'Kolom nama tim harus diisi',
			'description.required' => 'Kolom deskripsi harus diisi',
			'email.required' => 'Kolom email harus diisi',
			'email.max:255' => 'Email tidak boleh lebih dari 255 karakter',
			'phonenumber.required' => 'Kolom nomor HP harus diisi',
			'phonenumber.max:255' => 'Kolom nomor HP harus diisi',
		]);

		if ($validator->fails()) {
			Session::flash('error', 'Profil tim gagal diperbaharui');
            return redirect('/team')
                        ->withErrors($validator)
                        ->withInput();
        }


		$team = User::find(Auth::user()->id);
		$team->name = $request->name;
		$team->teamname = $request->teamname;
		$team->description = $request->description;
		$team->email = $request->email;
		$team->phonenumber = $request->phonenumber;

		if($request->hasFile('avatar')){
			if ($team->avatar != "default.jpg") {
				$oldFileName = $team->avatar;
				File::delete(public_path('/avatars/'. $oldFileName));
			}

    		$avatar = $request->file('avatar');
    		$fileName = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->save( public_path('/avatars/' . $fileName ) );
    		$team->avatar = $fileName;
        }

		$team->save();
		Session::flash('success', 'Profil tim berhasil diperbaharui');
		return redirect('/team');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function updatePayment(Request $request, $id)
    {
		$validator = Validator::make($request->all(),[
			'payment' => 'nullable',

		]);
		$team = User::find(Auth::user()->id);
		if ($request->hasFile('payment')){
			if ($team->payment){
				$oldFileName = $team->payment;
				File::delete(public_path('/avatars/' . $oldFileName));
			}

			$payment = $request->file('payment');
			$fileName = time() . '.' . $payment->getClientOriginalExtension();
			Image::make($payment)->save(public_path('/avatars/' . $fileName));
			$team->payment = $fileName;
		}
		$team->save();
		return redirect('/team');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
