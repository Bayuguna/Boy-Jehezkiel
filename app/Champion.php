<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    protected $fillable = [
		'year', 'team_id',
	];

	public function user(){
		return $this->belongsTo(User::class, 'team_id');
	}
}
