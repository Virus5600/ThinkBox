<?php

use Illuminate\Database\Seeder;

use App\InnovationAuthors as IA;

class InnovationAuthorsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// RESEARCH 1
		$this->addAuthors(1, array(1, 2, 8));

		// RESEARCH 2
		$this->addAuthors(2, array(6, 4));

		// RESEARCH 3
		$this->addAuthors(3, array(3));

		// RESEARCH 4
		// $this->addAuthors(4, array());

		$this->addAuthors(5, array(9));
	}

	/**
	 * Adds a new entry to innovation_authors table. The $staff_id allows an array of Staff ID or plain integer id.
	 * @param $id An integer variable that defines what innovation to add an author with.
	 * @param $staff_id A variable that can either be an integer variable or an integer array variable. Plugging an array let's the function add multiple authors to an innovation in a single go.
	 */
	private function addAuthors(int $id, $staff_id) {
		if (is_array($staff_id)) {
			foreach($staff_id as $s) {
				IA::insert([
					'innovation_id' => $id,
					'staff_id' => $s
				]);
			}
		}
		else {
			IA::insert([
				'innovation_id' => $id,
				'staff_id' => $staff_id
			]);
		}
	}
}