<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultySkill extends Model
{
	protected $fillable = [
		'faculty_staff_id',
		'skill_id',
		'is_marked',
		'reason',
	];

	public $timestamps = false;

	protected function facultyStaff() {
		return $this->belongsTo('App\FacultyStaff');
	}

	protected function skill() {
		return $this->belongsTo('App\Skills');
	}
}