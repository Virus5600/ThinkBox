<?php

use Illuminate\Database\Seeder;

use App\MaterialLinks as ML;

class MaterialLinksTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		ML::insert([
			'material_id' => 1,
			'url' => 'http://myriad-files.herokuapp.com/'
		]);

		ML::insert([
			'material_id' => 2,
			'url' => 'http://myriad-files.herokuapp.com/'
		]);

		ML::insert([
			'material_id' => 3,
			'url' => 'http://myriad-files.herokuapp.com/'
		]);

		ML::insert([
			'material_id' => 4,
			'url' => 'http://myriad-files.herokuapp.com/'
		]);

		ML::insert([
			'material_id' => 5,
			'url' => 'http://myriad-files.herokuapp.com/'
		]);
	}
}