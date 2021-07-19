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
		'user_id',
		'department',
		'position',
		'location'
	];

	protected function user() {
		return $this->belongsTo('App\User');
	}

	protected function positionAttr() {
		return $this->belongsTo('App\StaffTypes', 'position');
	}

	protected function focus() {
		return $this->hasMany('App\FacultyFocus');
	}

	protected function skills() {
		return $this->hasMany('App\FacultySkill');
	}

	protected function affiliations() {
		return $this->user->hasMany('App\Affiliation');
	}

	protected function otherProfiles() {
		return $this->user->hasMany('App\OtherProfile');
	}

	public function getDepartment() {
		return Departments::find($this->department);
	}

	public function getFullName() {
		return $this->user->getFullName();
	}
}