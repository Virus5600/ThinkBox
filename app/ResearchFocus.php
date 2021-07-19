<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchFocus extends Model
{
	protected $fillable = [
		'research_id',
		'focus_id'
	];

	public $timestamps = false;
	public $table = 'research_focus';
	public $primary_key = 'research_id';
}