<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
	protected $fillable = [
		'date', 'time', 'match',
	];
}
