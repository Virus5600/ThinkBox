<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffTypes extends Model
{
	protected $fillable = [
		'type'
	];

	public $timestamps = false;
}