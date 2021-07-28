<?php

use Illuminate\Database\Seeder;

use App\StaffTypes as ST;

class StaffTypesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		ST::create([
			'type' => 'dean'
		]);

		ST::create([
			'type' => 'program_chair'
		]);

		ST::create([
			'type' => 'professor'
		]);

		ST::create([
			'type' => 'other'
		]);
	}
}