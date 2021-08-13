<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Var extends Model
{
	protected $fillable = [
		'option_name',
		'value',
		'description'
		'updated_at'
	];
}