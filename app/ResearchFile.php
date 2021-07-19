<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchFile extends Model
{
	protected $fillable = [
		'research_id',
		'original_name',
		'file'
	];

	public $timestamps = false;
	public $primary_key = null;

	protected function research() {
		return $this->belongsTo('App\Research', 'research_id', 'id');
	}
}