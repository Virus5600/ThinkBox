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
			'abbr' => 'CS',
			'college' => 2
		]);

		D::create([
			'name' => 'Information Technology',
			'abbr' => 'IT',
			'college' => 2
		]);

		D::create([
			'name' => 'Center for Innovation and Entrepreneurship',
			'abbr' => 'CentIE',
			'college' => 1
		]);
	}
}