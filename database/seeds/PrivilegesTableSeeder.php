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
			'name' => 'faculty_members_view'
		]);

		P::create([
			'id' => 3,
			'name' => 'faculty_members_create'
		]);

		P::create([
			'id' => 4,
			'name' => 'faculty_members_edit'
		]);

		P::create([
			'id' => 5,
			'name' => 'faculty_members_delete'
		]);

		P::create([
			'id' => 6,
			'name' => 'faculty_members_mark'
		]);

		// FACULTY MEMBER CONTENT
		P::create([
			'id' => 7,
			'name' => 'faculty_members_contents'
		]);

		P::create([
			'id' => 8,
			'name' => 'faculty_members_contents_view'
		]);

		P::create([
			'id' => 9,
			'name' => 'faculty_members_contents_create'
		]);

		P::create([
			'id' => 10,
			'name' => 'faculty_members_contents_edit'
		]);

		P::create([
			'id' => 11,
			'name' => 'faculty_members_contents_delete'
		]);

		P::create([
			'id' => 12,
			'name' => 'faculty_members_contents_mark'
		]);
		// FACULTY MEMBERS CONTENT END

		// FACULTY MEMBERS SKILLS
		P::create([
			'id' => 13,
			'name' => 'faculty_members_skills'
		]);

		P::create([
			'id' => 14,
			'name' => 'faculty_members_skills_view'
		]);

		P::create([
			'id' => 15,
			'name' => 'faculty_members_skills_create'
		]);

		P::create([
			'id' => 16,
			'name' => 'faculty_members_skills_edit'
		]);

		P::create([
			'id' => 17,
			'name' => 'faculty_members_skills_delete'
		]);

		P::create([
			'id' => 18,
			'name' => 'faculty_members_skills_mark'
		]);
		// FACULTY MEMBERS SKILLS END

		// ANNOUNCEMENTS
		P::create([
			'id' => 19,
			'name' => 'announcements'
		]);

		P::create([
			'id' => 20,
			'name' => 'announcements_view'
		]);

		P::create([
			'id' => 21,
			'name' => 'announcements_create'
		]);

		P::create([
			'id' => 22,
			'name' => 'announcements_edit'
		]);

		P::create([
			'id' => 23,
			'name' => 'announcements_delete'
		]);

		P::create([
			'id' => 24,
			'name' => 'announcements_mark'
		]);
		// ANNOUNCEMENTS END

		// SKILLS
		P::create([
			'id' => 25,
			'name' => 'skills'
		]);

		P::create([
			'id' => 26,
			'name' => 'skills_view'
		]);

		P::create([
			'id' => 27,
			'name' => 'skills_create'
		]);

		P::create([
			'id' => 28,
			'name' => 'skills_edit'
		]);

		P::create([
			'id' => 29,
			'name' => 'skills_delete'
		]);

		P::create([
			'id' => 30,
			'name' => 'skills_mark'
		]);
		// SKILLS END

		// ACTIVITY LOG
		P::create([
			'id' => 31,
			'name' => 'activity_log'
		]);

		P::create([
			'id' => 32,
			'name' => 'activity_log_view'
		]);

		P::create([
			'id' => 33,
			'name' => 'activity_log_reset'
		]);

		P::create([
			'id' => 34,
			'name' => 'activity_log_mark'
		]);
		// ACTIVITY LOG END
	}
}