<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Innovation extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'authors',
		'description',
		'posted_by',
		'url',
		'is_file_requestable',
		'is_featured',
		'date_published'
	];

	protected function facultyStaff() {
		return $this->belongsTo('App\FacultyStaff', 'posted_by');
	}

	protected function user() {
		return $this->facultyStaff->belongsTo('App\User');
	}

	protected function innovationAuthors() {
		return $this->hasMany('App\InnovationAuthors');
	}

	protected function innovationFocus() {
		return $this->belongsToMany('App\Focus', 'innovation_focus', 'innovation_id', 'focus_id');
	}

	protected function postedBy() {
		return $this->belongsTo('App\FacultyStaff', 'posted_by', 'id');
	}

	protected function files() {
		return $this->hasMany('App\InnovationFile', 'innovation_id', 'id');
	}

	public function getFileNames($amt = 0) {
		$i = 1;
		$text = '';

		foreach ($this->files as $f) {
			if ($amt == 1) {
				$text = $text . $f->original_name;
				break;
			}

			if ($i > $amt && $amt != 0)
				break;

			$text = $text . $f->original_name;

			if ($i == count($this->files)-1)
				$text = $text . ' and ';
			else if ($i < count($this->files)-1)
				$text = $text . ', ';

			$i++;
		}

		if ($amt > 0 && count($this->files) > 1) {
			$text = $text . ' and ' . (count($this->files) - $amt) . ' other more.';
		}

		return $text;
	}
}