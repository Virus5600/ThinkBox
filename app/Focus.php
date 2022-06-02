<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Focus extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	public $table = 'focus';

	protected function facultyStaff() {
		return $this->hasMany('App\FacultyStaff');
	}
}