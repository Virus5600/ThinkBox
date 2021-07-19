<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
	protected $fillable = [
		'user_id',
		'position',
		'organization'
	];

	public $timestamps = false;

	protected function user() {
		return $this->belongsTo('App\User');
	}
}