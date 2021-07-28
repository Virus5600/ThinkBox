<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
	protected $fillable = [
		'name'
	];

	public $timestamps = false;

	public function departments() {
		return $this->hasMany('App\Departments', 'college');
	}
}