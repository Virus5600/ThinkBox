<?php

use Illuminate\Database\Seeder;

use App\InnovationFocus as IFo;

class InnovationFocusTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// INNOVATION 1
		$this->addFocus(1, array(1));

		// INNOVATION 2
		$this->addFocus(2, array(6));

		// INNOVATION 3
		$this->addFocus(3, array(12));

		// INNOVATION 4
		$this->addFocus(4, array(6));
	}

	/**
	 * Adds a new entry to innovation_focus table. The $focus_id allows an array of focus or plain integer id.
	 * @param $id An integer variable that defines what innovation to add a focus with.
	 * @param $focus_id A variable that can either be an integer variable or an integer array variable. Plugging an array let's the function add multiple focus to a innovation in a single go.
	 */
	private function addFocus(int $id, $focus_id) {
		if (is_array($focus_id)) {
			foreach($focus_id as $f) {
				IFo::insert([
					'innovation_id' => $id,
					'focus_id' => $f
				]);
			}
		}
		else {
			IFo::insert([
				'faculty_staff_id' => $id,
				'focus_id' => $f
			]);
		}
	}
}
