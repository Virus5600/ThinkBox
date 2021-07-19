<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyFocus extends Model
{
	protected $fillable = [
		'faculty_staff_id',
		'focus_id'
	];

	public $timestamps = false;
	public $table = 'faculty_focus';
	public $primary_key = 'faculty_staff_id';

	protected function focus() {
		return $this->belongsTo('App\Focus');
	}

	protected function facultyStaff() {
		return $this->belongsTo('App\FacultyStaff');
	}
}