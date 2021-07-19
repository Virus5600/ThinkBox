<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePrivileges extends Model
{
	protected $fillable = [
		'role_id',
		'privilege_id'
	];

	public $timestamps = false;
	public $primary_key = 'role_id';
}