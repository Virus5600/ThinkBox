<?php

use Illuminate\Database\Seeder;

use App\ResearchFocus as RF;

class ResearchFocusTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// RESEARCH 1
		$this->addFocus(1, array(1));

		// RESEARCH 2
		$this->addFocus(2, array(6));

		// RESEARCH 3
		$this->addFocus(3, array(12));

		// RESEARCH 4
		$this->addFocus(4, array(6));
	}

	/**
	 * Adds a new entry to research_focus table. The $focus_id allows an array of focus or plain integer id.
	 * @param $id An integer variable that defines what research to add a focus with.
	 * @param $focus_id A variable that can either be an integer variable or an integer array variable. Plugging an array let's the function add multiple focus to a research in a single go.
	 */
	private function addFocus(int $id, $focus_id) {
		if (is_array($focus_id)) {
			foreach($focus_id as $f) {
				RF::insert([
					'research_id' => $id,
					'focus_id' => $f
				]);
			}
		}
		else {
			RF::insert([
				'research_id' => $id,
				'focus_id' => $focus_id
			]);
		}
	}
}
