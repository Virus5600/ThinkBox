<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RolePrivileges;
use App\Privileges;

class Roles extends Model
{
	protected $fillable = [
		'name'
	];

	public $timestamps = false;

	protected function users() {
		return $this->hasMany('App\User');
	}

	protected function privileges() {
		return $this->hasManyThrough('App\Privileges', 'App\RolePrivileges', 'privilege_id', 'id', 'id');
	}

	// PUBLIC FUNCTIONS
	public function hasPrivilege($privilege) {
		$userRole = $this->id;
		$targetPrivilege = Privileges::where('name', '=', $privilege)->first()->id;
		$matches = RolePrivileges::where('role_id', '=', $userRole)->where('privilege_id', '=', $targetPrivilege)->get();

		return count($matches) > 0 ? true : false;
	}

	public function hasOneOfPrivileges($privileges) {
		$targetPrivilege = array_filter($privileges, 'is_numeric');
		
		$strpriv = array_filter($privileges, 'is_string');
		foreach ($strpriv as $s)
			array_push($targetPrivilege, Privileges::where('name', '=', $s)->first()->id);

		$userRole = $this->id;
		$matches = RolePrivileges::where('role_id', '=', $userRole)->whereIn('privilege_id', $targetPrivilege)->get();

		return count($matches) > 0 ? true : false;
	}

	public function hasAllPrivileges($privileges) {
		$targetPrivilege = array_filter($privileges, 'is_numeric');
		
		$strpriv = array_filter($privileges, 'is_string');
		foreach ($strpriv as $s)
			$targetPrivilege = array_push(Privileges::where('name', '=', $s)->first()->id);

		$userRole = $this->id;
		$matches = RolePrivileges::where('role_id', '=', $userRole)->whereIn('privilege_id', $targetPrivilege)->get();

		return count($matches) == count($privileges) ? true : false;
	}
}