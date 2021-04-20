<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyStaff extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'avatar', 'name' , 'department'
	];
}