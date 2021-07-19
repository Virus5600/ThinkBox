<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'image',
		'title' ,
		'source',
		'content',
		'author_id'
	];

	protected function authorID() {
		return $this->belongsTo('App\User');
	}
}