<?php

use Illuminate\Database\Seeder;

use App\Roles as R;

class RolesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		R::create([
			'name' => 'master_admin'
		]);

		R::create([
			'name' => 'admin'
		]);

		R::create([
			'name' => 'moderator'
		]);

		R::create([
			'name' => 'supervisor'
		]);

		R::create([
			'name' => 'user'
		]);
	}
}