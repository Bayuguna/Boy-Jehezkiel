<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Champion;
use App\User;
use App\Member;
use DB;

class IndexController extends Controller
{
    public function index(){
        $champion = Champion::all();
        return view('home', compact('champion'));
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function detailChampion($id) {
        $member = DB::table('members')
                        ->join('users', 'users.id', '=', 'members.teamid')
                        ->join('champions', 'users.id', '=', 'champions.team_id')
                        ->select('members.*')->get();


        $champion = Champion::find($id);
		return view('championdetail', compact('team', 'member', 'champion'));
	}
}
