<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InnovationFile extends Model
{
	protected $fillable = [
		'innovation_id',
		'original_name',
		'file'
	];

	public $timestamps = false;
	public $primary_key = 'innovation_id';

	protected function research() {
		return $this->belongsTo('App\Innovation', 'innovation_id', 'id');
	}
}