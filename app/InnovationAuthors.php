<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InnovationAuthors extends Model
{
	protected $fillable = [
		'innovation_id',
		'staff_id'
	];

	public $timestamps = false;
	public $table = 'innovation_authors';
	public $primary_key = null;

	protected function staff() {
		return $this->belongsTo('App\FacultyStaff');
	}

	protected function user() {
		return $this->staff->belongsTo('App\User');
	}

	protected function innovation() {
		return $this->belongsTo('App\Innovation');
	}
}