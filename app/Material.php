<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	protected $fillable = [
		'topic_id',
		'material_name',
		'faculty_staff_id',
		'description',
	];

	protected function topic() {
		return $this->belongsTo('App\Topic');
	}

	protected function staff() {
		return $this->belongsTo('App\FacultyStaff');
	}

	protected function files() {
		return $this->hasMany('App\MaterialFiles', 'material_id', 'id');
	}

	protected function links() {
		return $this->hasMany('App\MaterialLinks', 'material_id', 'id');
	}

	protected function user() {
		return $this->belongsTo('App\FacultyStaff')->belongsTo('App\User');
	}
}