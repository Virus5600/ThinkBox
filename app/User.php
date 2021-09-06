<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use \Http\Controllers\TmpController;

class User extends Authenticatable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'first_name',
		'middle_name',
		'last_name',
		'suffix',
		'avatar',
		'isAvatarLink',
		'email',
		'username',
		'contact_no',
		'password',
		'type',
		'role',
		'expiration_date'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	protected function staff() {
		return $this->hasOne('App\FacultyStaff');
	}

	protected function affiliations() {
		return $this->hasMany('App\Affiliations');
	}

	protected function otherProfiles() {
		return $this->hasMany('App\OtherProfile');
	}

	public function getFullName() {
		$middleName = '';
		if ($this->middle_name != null) {
			$words = preg_split("/\s+/", $this->middle_name);
			foreach ($words as $w)
				$middleName .= $w[0] . '. ';
		}

		return ($this->title == null ? '' : $this->title) . ' ' . $this->first_name . ' ' . ($this->middle_name == null ? '' : $middleName) . $this->last_name . ($this->suffix == null ? '' : ', ' . $this->suffix);
	}
}