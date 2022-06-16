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
		$priv = Privileges::where('name', '=', $privilege)->first();

		if ($priv == null)
			return false;

		$userRole = $this->id;
		$targetPrivilege = $priv->id;
		$matches = RolePrivileges::where('role_id', '=', $userRole)->where('privilege_id', '=', $targetPrivilege)->get();

		return count($matches) > 0 ? true : false;
	}

	public function hasOneOfPrivileges($privileges) {
		$targetPrivilege = array_filter($privileges, 'is_numeric');
		
		$strpriv = array_filter($privileges, 'is_string');
		foreach ($strpriv as $s) {
			$priv = Privileges::where('name', '=', $s)->first();

			if ($priv == null)
				continue;
			
			array_push($targetPrivilege, $priv->id);
		}

		$userRole = $this->id;
		$matches = RolePrivileges::where('role_id', '=', $userRole)->whereIn('privilege_id', $targetPrivilege)->get();

		return count($matches) > 0 ? true : false;
	}

	public function hasAllPrivileges($privileges) {
		$targetPrivilege = array_filter($privileges, 'is_numeric');
		
		$strpriv = array_filter($privileges, 'is_string');
		foreach ($strpriv as $s) {
			$priv = Privileges::where('name', '=', $s)->first();

			if ($priv == null)
				continue;

			$targetPrivilege = array_push($priv->id);
		}

		$userRole = $this->id;
		$matches = RolePrivileges::where('role_id', '=', $userRole)->whereIn('privilege_id', $targetPrivilege)->get();

		return count($matches) == count($privileges) ? true : false;
	}
}