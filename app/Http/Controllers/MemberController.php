<?php

namespace App\Http\Controllers;

use App\Member;
use Auth;
use Image;
use File;
use Validator;
use Session;
use Illuminate\Http\Request;

class MemberController extends Controller {
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
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('member.createmember');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'steamid' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:members',
			'phonenumber' => 'required|string|max:255',
			'address' => 'required|string',
			'avatar' => 'nullable',
		],[
			'name.required' => 'Kolom nama harus diisi',
			'name.max:255' => 'Nama tidak boleh lebih dari 255 karakter',
			'steamid.required' => 'Kolom ID Steam harus diisi',
			'steamid.max:255' => 'ID Steam tidak boleh lebih dari 255 karakter',
			'email.unique' => 'Email sudah digunakan',
			'email.max:255' => 'Email tidak boleh lebih dari 255 karakter',
			'phonenumber.required' => 'Kolom nomor HP harus diisi',
			'address.required' => 'kolom Alamat harus diisi',
		]);

		if ($validator->fails()) {
			Session::flash('error', 'Anggota gagal ditambahkan');
            return redirect('/team')
                        ->withErrors($validator)
                        ->withInput();
        }

		$member = new Member;

		$member->name = $request->name;
		$member->steamid = $request->steamid;
		$member->email = $request->email;
		$member->phonenumber = $request->phonenumber;
		$member->address = $request->address;
		$member->teamid = Auth::user()->id;

		if($request->hasFile('avatar')){
			$avatar = $request->file('avatar');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Image::make($avatar)->save( public_path('/avatars/' . $filename ) );
			$member->avatar= $filename;
		}

		$member->save();
		Session::flash('success', 'Anggota berhasil ditambahkan');
		return redirect('/team');
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$member = Member::find($id);
		return view('member.editmember', compact('member'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'steamid' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'phonenumber' => 'required|string|max:255',
			'address' => 'required|string',
			'avatar' => 'nullable',
		],[
			'name.required' => 'Kolom nama harus diisi',
			'name.max:255' => 'Nama tidak boleh lebih dari 255 karakter',
			'steamid.required' => 'Kolom ID Steam harus diisi',
			'steamid.max:255' => 'ID Steam tidak boleh lebih dari 255 karakter',
			'email.required' => 'Kolom email harus diisi',
			'email.max:255' => 'Email tidak boleh lebih dari 255 karakter',
			'phonenumber.required' => 'Kolom nomor HP harus diisi',
			'address.required' => 'kolom Alamat harus diisi',
		]);

		if ($validator->fails()) {
			Session::flash('error', 'Anggota gagal diubah');
            return redirect('/team')
                        ->withErrors($validator)
                        ->withInput();
        }

		$member = Member::find($id);
		$member->name = $request->name;
		$member->steamid = $request->steamid;
		$member->email = $request->email;
		$member->phonenumber = $request->phonenumber;
		$member->address = $request->address;

		if($request->hasFile('avatar')){
			if ($member->avatar != "default.jpg") {
				$oldFileName= $member->avatar;
				File::delete(public_path('/avatars/'. $oldFileName) );
			}

    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->save( public_path('/avatars/' . $filename ) );
			$member->avatar = $filename;
        }

		$member->save();
		Session::flash('success', 'Anggota berhasil diperbaharui');
		return redirect('/team');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$member = Member::find($id);
		if ($member) {
			$member->delete();
			$oldFileName= $member->avatar;
			File::delete(public_path('/avatars/'. $oldFileName) );
		}
		Session::flash('success', 'Anggota berhasil dihapus');
		return redirect('/team');
	}
}
