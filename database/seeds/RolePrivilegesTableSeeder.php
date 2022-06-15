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
		// MASTER ADMIN
		$this->addPrivilege(1, array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33));

		// ADMIN
		$this->addPrivilege(2, array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 17, 18, 19, 20, 21, 22, 23, 24, 25, 29, 30, 31, 33));

		// MODERATOR
		$this->addPrivilege(3, array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 17, 18, 19, 20, 21, 22, 23, 24, 25, 29, 30, 33));

		// SUPERVISOR
		$this->addPrivilege(4, array(1, 2, 3, 4, 5, 6, 7, 8, 12, 18, 19, 20, 24, 25, 29, 30, 33));
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