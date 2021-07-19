<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// ROLES & PRIVILEGES
		$this->call(RolesTableSeeder::class);
		$this->call(PrivilegesTableSeeder::class);
		$this->call(RolePrivilegesTableSeeder::class);

		// USERS
		$this->call(UserTableSeeder::class);

		// ANNOUNCEMENTS
		$this->call(AnnouncementsTableSeeder::class);

		// DEPARTMENT AND COLLEGE
		$this->call(CollegeTableSeeder::class);
		$this->call(DepartmentsTableSeeder::class);

		// FACULTY STAFF
		$this->call(StaffTypesTableSeeder::class);
		$this->call(FacultyStaffTableSeeder::class);

		// SKILLS AND ASSIGNMENT OF SKILLS TO FACULTY
		$this->call(SkillsTableSeeder::class);
		$this->call(FacultySkillTableSeeder::class);

		// FOCUS AND ASSIGNMENT OF FOCUS TO FACULTY
		$this->call(FocusTableSeeder::class);
		$this->call(FacultyFocusTableSeeder::class);

		// RESEARCH, ASSIGNMENT OF FOCUS TO RESEARCH, AND ASSIGNMENT OF RESEARCH AUTHORS
		$this->call(ResearchTableSeeder::class);
		$this->call(ResearchFocusTableSeeder::class);
		$this->call(ResearchAuthorsTableSeeder::class);
		$this->call(ResearchFilesTableSeeder::class);

		// INNOVATION, ASSIGNEMENT OF FOCUS TO INNOVATION, AND ASSIGNMENT OF INNOVATION AUTHORS
		$this->call(InnovationTableSeeder::class);
		$this->call(InnovationFocusTableSeeder::class);
		$this->call(InnovationAuthorsTableSeeder::class);
		$this->call(InnovationFilesTableSeeder::class);

		// AFFILIATIONS, OTHER PROFILES
		$this->call(AffiliationTableSeeder::class);
		$this->call(OtherProfileTableSeeder::class);

		// TOPICS AND MATERIALS
		$this->call(TopicsTableSeeder::class);
		$this->call(MaterialsTableSeeder::class);
	}
}