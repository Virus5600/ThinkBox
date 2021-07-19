<?php

use Illuminate\Database\Seeder;

use App\Departments as D;

class DepartmentsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		D::create([
			'name' => 'Computer Science',
			'college' => 1
		]);
	}
}