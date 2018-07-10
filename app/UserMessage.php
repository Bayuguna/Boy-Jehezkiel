<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    protected $fillable = [
		'user_id', 'subject', 'message', 'view',
	];

	public function user(){
		return $this->belongsTo(User::class);
	}
}
