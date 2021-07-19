<?php

use Illuminate\Database\Seeder;

use App\OtherProfile as OP;

class OtherProfileTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		OP::create([
			'user_id' => 1,
			'website' => 'Facebook',
			'url' => 'https://www.facebook.com/angelique.lacasandile.3'
		]);

		OP::create([
			'user_id' => 1,
			'website' => 'Google Scholar',
			'url' => 'https://scholar.google.com/citations?hl=en&user=ZsEoUCgAAAAJ'
		]);

		OP::create([
			'user_id' => 1,
			'website' => 'LinkedIn',
			'url' => 'https://www.linkedin.com/in/dr-angelique-lacasandile-034a3780/'
		]);

		OP::create([
			'user_id' => 3,
			'website' => 'LinkedIn',
			'url' => 'https://www.linkedin.com/in/joseph-marvin-imperial-9382b9a7/'
		]);
	}
}