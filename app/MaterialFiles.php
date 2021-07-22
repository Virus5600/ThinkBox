<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialFiles extends Model
{
	protected $fillable = [
		'material_id',
		'file_name'
	];

	public $timestamps = false;

	protected function material() {
		return $this->belongsTo('App\Material');
	}

	protected function topic() {
		return $this->belongsTo('App\Material')->belongsTo('App\Topic');
	}

	protected function staff() {
		return $this->belongsTo('App\Material')->belongsTo('App\FacultyStaff');
	}
	
	protected function user() {
		return $this->belongsTo('App\Material')->belongsTo('App\FacultyStaff')->belongsTo('App\User');
	}
}