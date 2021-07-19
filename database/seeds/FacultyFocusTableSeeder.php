<?php

use Illuminate\Database\Seeder;

use App\FacultyFocus as FF;
class FacultyFocusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// USER 1
    	$this->addFocus(1, array(1, 2, 3, 4));

    	// USER 2
    	$this->addFocus(2, array(6, 7, 8, 9));

    	// USER 3
    	$this->addFocus(3, array(11, 12, 13, 14));

    	// USER 4
    	// $this->addFocus(4, null);

    	// USER 5
    	$this->addFocus(5, 14);

    	// USER 6
    	$this->addFocus(6, array(15, 16, 17, 18, 1));

    	// USER 7
    	// $this->addFocus(7, null);

    	// USER 8
    	// $this->addFocus(8, null);
    }

 	/**
	 * Adds a new entry to faculty_focus table. The $focus_id allows an array of research focus or plain integer id.
	 * @param $id An integer variable that defines what role to add a research focus with.
	 * @param $focus_id A variable that can either be an integer variable or an integer array variable. Plugging an array let's the function add multiple research focus to a role in a single go.
	 */
	private function addFocus(int $id, $focus_id) {
		if (is_array($focus_id)) {
			foreach($focus_id as $f) {
				FF::create([
					'faculty_staff_id' => $id,
					'focus_id' => $f
				]);
			}
		}
		else {
			FF::create([
				'faculty_staff_id' => $id,
				'focus_id' => $focus_id
			]);
		}
	}   
}