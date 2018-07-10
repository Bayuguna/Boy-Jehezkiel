<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestMessage extends Model
{
    protected $fillable = [
		'sender', 'email', 'subject', 'message', 'view',
	];

	public function user(){
		return $this->belongsTo(User::class);
	}
}
