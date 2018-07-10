<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    protected $fillable = [
		'sender', 'receiver', 'subject', 'id_team', 'message', 'view',
	];

	// public function admin(){
	// 	return $this->belongsTo('App\Admin');
	// }

	public function user(){
		return $this->belongsTo(User::class, 'team_id');
	}
}
