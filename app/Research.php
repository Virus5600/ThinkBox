<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title', 'url', 'date_published', 'authors', 'description', 'posted_by', 'is_file'
	];
}