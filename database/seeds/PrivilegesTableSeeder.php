<?php

use Illuminate\Database\Seeder;

use App\Privileges as P;
class PrivilegesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// FACULTY MEMBERS
		P::create([
			'id' => 1,
			'name' => 'faculty_members'
		]);

		P::create([
			'id' => 2,
			'name' => 'faculty_members_create'
		]);

		P::create([
			'id' => 3,
			'name' => 'faculty_members_details'
		]);

		P::create([
			'id' => 4,
			'name' => 'faculty_members_skills'
		]);

		P::create([
			'id' => 5,
			'name' => 'faculty_members_contents'
		]);

		P::create([
			'id' => 6,
			'name' => 'faculty_members_delete'
		]);
		// FACULTY MEMBERS END

		// ANNOUNCEMENTS
		P::create([
			'id' => 7,
			'name' => 'announcements'
		]);

		P::create([
			'id' => 8,
			'name' => 'announcements_create'
		]);

		P::create([
			'id' => 9,
			'name' => 'announcements_details'
		]);

		P::create([
			'id' => 10,
			'name' => 'announcements_delete'
		]);
		// ANNOUNCEMENTS END

		// SKILLS
		P::create([
			'id' => 11,
			'name' => 'skills'
		]);

		P::create([
			'id' => 12,
			'name' => 'skills_create'
		]);

		P::create([
			'id' => 13,
			'name' => 'skills_edit'
		]);

		P::create([
			'id' => 14,
			'name' => 'skills_delete'
		]);
		// SKILLS END
	}
}