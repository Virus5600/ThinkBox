<?php

use Illuminate\Database\Seeder;


use App\Skills as S;

class SkillsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		S::create([
			'id' => 1,
			'skill' => 'Business Management'
		]);

		S::create([
			'id' => 2,
			'skill' => 'Business Process Management'
		]);

		S::create([
			'id' => 3,
			'skill' => 'Consultancy'
		]);

		S::create([
			'id' => 4,
			'skill' => 'Curriculum Development'
		]);

		S::create([
			'id' => 5,
			'skill' => 'Event Management'
		]);

		S::create([
			'id' => 6,
			'skill' => 'Emphatic Computing'
		]);

		S::create([
			'id' => 7,
			'skill' => 'E-Business'
		]);

		S::create([
			'id' => 8,
			'skill' => 'Higher Education'
		]);

		S::create([
			'id' => 9,
			'skill' => 'Hosting Events'
		]);

		S::create([
			'id' => 10,
			'skill' => 'Information Technology'
		]);

		S::create([
			'id' => 11,
			'skill' => 'Information System Management'
		]);

		S::create([
			'id' => 12,
			'skill' => 'Information Management'
		]);

		S::create([
			'id' => 13,
			'skill' => 'Information Technology Management'
		]);

		S::create([
			'id' => 14,
			'skill' => 'IT Consulting'
		]);

		S::create([
			'id' => 15,
			'skill' => 'IT Project Management'
		]);

		S::create([
			'id' => 16,
			'skill' => 'Knowledge Management'
		]);

		S::create([
			'id' => 17,
			'skill' => 'MySQL'
		]);

		S::create([
			'id' => 18,
			'skill' => 'Programming'
		]);

		S::create([
			'id' => 19,
			'skill' => 'Project Management'
		]);

		S::create([
			'id' => 20,
			'skill' => 'Software Quality Assurance'
		]);

		S::create([
			'id' => 21,
			'skill' => 'Teaching'
		]);

	}
}