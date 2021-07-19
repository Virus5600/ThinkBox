<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchAuthors extends Model
{
	protected $fillable = [
		'research_id',
		'staff_id'
	];

	public $timestamps = false;
	public $table = 'research_authors';
	public $primary_key = null;

	protected function staff() {
		return $this->belongsTo('App\FacultyStaff');
	}

	protected function user() {
		return $this->staff->belongsTo('App\User');
	}

	protected function research() {
		return $this->belongsTo('App\Research');
	}
}