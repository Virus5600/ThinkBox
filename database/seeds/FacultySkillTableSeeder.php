<?php

use Illuminate\Database\Seeder;

use App\FacultySkill as FS;

class FacultySkillTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// USER 1
		$this->addSkills(1, array(3, 1, 20, 8, 18, 9, 17, 19, 4, 5, 14, 21));

		// USER 2
		$this->addSkills(2, array(10, 16, 7, 15, 11, 12, 13, 2, 6, 21, 8, 18));
		
		// USER 3
		$this->addSkills(3, array(8, 18, 9, 17, 19, 4, 5, 14, 21));

		// USER 4
		$this->addSkills(4, array(1, 3, 4, 5, 8, 9, 14, 17, 18, 19, 20, 21));

		// USER 5
		$this->addSkills(5, array(8, 18, 9, 19, 4, 5, 14, 21));

		// USER 6
		$this->addSkills(6, array(8, 18, 9, 19, 4, 5, 14, 21));

		// USER 7
		$this->addSkills(7, array(8, 18, 21));

		// USER 8
		$this->addSkills(8, array(8, 18, 21));
	}

	/**
	 * Adds a new entry to faculty_skill table. The $skill_id allows an array of skills or plain integer id.
	 * @param $id An integer variable that defines what faculty staff to add a skill with.
	 * @param $skill_id A variable that can either be an integer variable or an integer array variable. Plugging an array let's the function add multiple skills to a faculty user in a single go.
	 */
	private function addSkills(int $id, $skill_id) {
		if (is_array($skill_id)) {
			foreach($skill_id as $s) {
				FS::insert([
					'faculty_staff_id' => $id,
					'skill_id' => $s
				]);
			}
		}
		else {
			FS::insert([
				'faculty_staff_id' => $id,
				'skill_id' => $s
			]);
		}
	}
}