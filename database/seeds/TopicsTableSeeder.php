<?php

use Illuminate\Database\Seeder;

use App\Topic as T;

class TopicsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$topic_name = array(
			'Branding',
            'Microsoft',
            'Programming',
            'Project Management'
		);

		foreach ($topic_name as $tn) {
			T::create([
				'topic_name' => $tn
			]);
		}
	}
}
