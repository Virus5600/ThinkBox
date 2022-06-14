<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
	protected $fillable = [
		'name'
	];

	public $timestamps = false;

	protected function users() {
		return $this->hasMany('App\User');
	}

	protected function privileges() {
		return $this->hasManyThrough('App\Privileges', 'App\RolePrivileges', 'privilege_id', 'id', 'id');
	}
}