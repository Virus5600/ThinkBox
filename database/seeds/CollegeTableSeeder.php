<?php

use Illuminate\Database\Seeder;

use App\College as C;

class CollegeTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		C::create([
			'name' => 'Others'
		]);

		C::create([
			'name' => 'College of Computing and Information Technology',
			'abbr' => 'CCIT'
		]);
	}
}