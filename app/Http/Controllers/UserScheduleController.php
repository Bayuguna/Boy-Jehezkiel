<?php

namespace App\Http\Controllers;

use DB;
use App\MatchLocation;
use App\AdminMessageTemporary;

class UserScheduleController extends Controller {
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
	public function userIndex() {
		$message = AdminMessageTemporary::where('view', '=', 0)->get();
		$location = MatchLocation::all();
		$schedule = DB::table('schedules')->join('users as team1', 'team1.id', '=', 'schedules.teamid1')
			->join('users as team2', 'team2.id', '=', 'schedules.teamid2')
			->select('schedules.*', 'team1.teamname as team1', 'team2.teamname as team2')
			->orderBy('id', 'asc')
			->get();

		// select from schedules
		// join users as team1 on team1.id = schedules.teamid1
		// join users as team2 on team2.id = schedules.teamid2

		return view('schedule.userschedule', compact('schedule', 'location', 'message'));
	}
}
