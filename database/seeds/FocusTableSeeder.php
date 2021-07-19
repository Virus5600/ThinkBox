<?php

use Illuminate\Database\Seeder;


use App\Focus as F;


class FocusTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		F::create([
			'id' => 1,
			'name' => 'e-government & e-governance'
		]);

		F::create([
			'id' => 2,
			'name' => 'disaster preparedness'
		]);

		F::create([
			'id' => 3,
			'name' => 'android technology'
		]);

		F::create([
			'id' => 4,
			'name' => 'data mining'
		]);

		F::create([
			'id' => 5,
			'name' => 'artificial intelligence'
		]);

		F::create([
			'id' => 6,
			'name' => 'e-learning'
		]);

		F::create([
			'id' => 7,
			'name' => 'adaptive learning'
		]);

		F::create([
			'id' => 8,
			'name' => 'emphatic coding'
		]);

		F::create([
			'id' => 9,
			'name' => 'machine learning'
		]);

		F::create([
			'id' => 10,
			'name' => 'readability assessment'
		]);

		F::create([
			'id' => 11,
			'name' => 'ai for education'
		]);

		F::create([
			'id' => 12,
			'name' => 'natural language processing'
		]);

		F::create([
			'id' => 13,
			'name' => 'computational linguistics'
		]);

		F::create([
			'id' => 14,
			'name' => 'computing technology'
		]);

		F::create([
			'id' => 15,
			'name' => 'social computing'
		]);

		F::create([
			'id' => 16,
			'name' => 'm-learning'
		]);

		F::create([
			'id' => 17,
			'name' => 'mobile game continuance'
		]);

		F::create([
			'id' => 18,
			'name' => 'is success theories'
		]);

	}
}