<?php

use Illuminate\Database\Seeder;

use App\RolePrivileges as RP;

class RolePrivilegesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// ADMIN
		$this->addPrivilege(1, array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14));

		// MODERATOR
		$this->addPrivilege(2, array(1, 3, 4, 5, 7, 8, 9, 11));
	}

	/**
	 * Adds a new entry to role_privileges table. The $privilege_id allows an array of privileges or plain integer id.
	 * @param $id An integer variable that defines what role to add a privilege with.
	 * @param $privilege_id A variable that can either be an integer variable or an integer array variable. Plugging an array let's the function add multiple privileges to a role in a single go.
	 */
	private function addPrivilege(int $id, $privilege_id) {
		if (is_array($privilege_id)) {
			foreach($privilege_id as $p) {
				RP::insert([
					'role_id' => $id,
					'privilege_id' => $p
				]);
			}
		}
		else {
			RP::insert([
				'role_id' => $id,
				'privilege_id' => $privilege_id
			]);
		}
	}
}