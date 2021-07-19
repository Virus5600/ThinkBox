<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	protected $fillable = [
		'topic_id',
		'material_name',
		'faculty_staff_id',
        'is_file',
        'description',
        'url',
	];

	protected function topic() {
		return $this->belongsTo('App\Topic');
	}

	protected function staff() {
		return $this->belongsTo('App\FacultyStaff');
	}

	protected function user() {
		return $this->belongsTo('App\FacultyStaff')->belongsTo('App\User');
	}
}