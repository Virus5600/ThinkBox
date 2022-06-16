<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'skill',
		'is_marked',
		'reason',
	];

	protected function facultyStaff() {
		return $this->belongsToMany('App\FacultyStaff', 'faculty_skills', 'skill_id', 'faculty_staff_id');
	}

	public function users() {
		$staff = $this->facultyStaff;
		$user = [];

		foreach ($staff as $s) array_push($user, $s->user);
		array_multisort(array_column($user, 'first_name'), SORT_ASC, $user);
		return collect($user);
	}
}