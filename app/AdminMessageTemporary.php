<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMessageTemporary extends Model
{
    protected $fillable = [
		'sender', 'receiver', 'subject', 'id_team', 'message', 'view',
	];

	public function user(){
		return $this->belongsTo(User::class, 'team_id');
	}
}
