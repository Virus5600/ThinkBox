<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultySkill extends Model
{
	protected $fillable = [
		'faculty_staff_id',
		'skill_id'
	];

	public $timestamps = false;
	public $primary_key = 'faculty_staff_id';

	protected function facultyStaff() {
		return $this->belongsTo('App\FacultyStaff');
	}

	protected function skill() {
		return $this->belongsTo('App\Skills');
	}
}