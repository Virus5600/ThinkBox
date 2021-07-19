<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InnovationFocus extends Model
{
	protected $fillable = [
		'innovation_id',
		'focus_id'
	];

	public $timestamps = false;
	public $table = 'innovation_focus';
	public $primary_key = 'innovation_id';
}