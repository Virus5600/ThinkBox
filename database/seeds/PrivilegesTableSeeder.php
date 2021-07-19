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
			'name' => 'faculty_members'
		]);

		P::create([
			'name' => 'faculty_members_create'
		]);

		P::create([
			'name' => 'faculty_members_details'
		]);

		P::create([
			'name' => 'faculty_members_skills'
		]);

		P::create([
			'name' => 'faculty_members_contents'
		]);

		P::create([
			'name' => 'faculty_members_delete'
		]);
		// FACULTY MEMBERS END

		// ANNOUNCEMENTS
		P::create([
			'name' => 'announcements'
		]);

		P::create([
			'name' => 'announcements_create'
		]);

		P::create([
			'name' => 'announcements_details'
		]);

		P::create([
			'name' => 'announcements_delete'
		]);
		// ANNOUNCEMENTS END

		// SKILLS
		P::create([
			'name' => 'skills'
		]);

		P::create([
			'name' => 'skills_create'
		]);

		P::create([
			'name' => 'skills_edit'
		]);

		P::create([
			'name' => 'skills_delete'
		]);
		// SKILLS END
	}
}