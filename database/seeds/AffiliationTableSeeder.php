<?php

use Illuminate\Database\Seeder;

use App\Affiliation as A;

class AffiliationTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{  
		A::insert([
			'user_id' => 1,
			'position' => 'Co-Founder',
			'organization' => 'Aguora IT Solutions and Technology Inc.'
		]);

		A::insert([
			'user_id' => 1,
			'position' => 'Ambassador',
			'organization' => 'Microsoft'
		]);

		A::insert([
			'user_id' => 1,
			'position' => 'Technical Consultant',
			'organization' => 'House of Representative & TNC Cafe'
		]);

		A::insert([
			'user_id' => 9,
			'position' => 'Managing Director',
			'organization' => 'Po-Lite Technology Inc.'
		]);

		A::insert([
			'user_id' => 9,
			'position' => 'General Manager',
			'organization' => 'RPM Business Solutions'
		]);

		A::insert([
			'user_id' => 9,
			'position' => 'Civil Contractor',
			'organization' => 'CACTech Construction'
		]);

		A::insert([
			'user_id' => 9,
			'position' => 'Graduate School Professor',
			'organization' => 'Technological Institute of the Philippines.'
		]);
	}
}