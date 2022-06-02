<?php

use Illuminate\Database\Seeder;

use App\Var;

class VarTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Var::insert([
			'option_name' => 'Site Name',
			'value' => 'CS Department',
			'description' => 'The name of this website.',
			'updated_at' => \Carbon\Carbon::now()
		]);

		Var::insert([
			'option_name' => 'Description'
			'value' => 'Countless number of IDEAS that is INNOVATIVE, in a form of file',
			'description' => 'The description of this website.',
			'updated_at' => \Carbon\Carbon::now()
		]);

		Var::insert([
			'option_name' => 'Email'
			'value' => 'privatelaravelmailtester@gmail.com',
			'description' => 'The email used by this website.',
			'updated_at' => \Carbon\Carbon::now()
		]);
	}
}