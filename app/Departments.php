<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
	protected $fillable = [
		'name',
		'college',
		'abbr'
	];

	public $timestamps = false;

	public function college() {
		return $this->belongsTo('App\College', 'college');
	}
}