<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'skill'
	];

	protected function facultyStaff() {
		$this->hasMany('App\FacultySkill');
	}
}