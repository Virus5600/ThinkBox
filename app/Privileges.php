<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
	protected $fillable = [
		'name'
	];

	public $timestamps = false;

	protected function users() {
		return $this->hasMany('App\Privilege', 'App\Roles');
	}
}