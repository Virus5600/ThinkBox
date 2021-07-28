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
		OP::insert([
			'user_id' => 1,
			'website' => 'Facebook',
			'url' => 'https://www.facebook.com/angelique.lacasandile.3'
		]);

		OP::insert([
			'user_id' => 1,
			'website' => 'Google Scholar',
			'url' => 'https://scholar.google.com/citations?hl=en&user=ZsEoUCgAAAAJ'
		]);

		OP::insert([
			'user_id' => 1,
			'website' => 'LinkedIn',
			'url' => 'https://www.linkedin.com/in/dr-angelique-lacasandile-034a3780/'
		]);

		OP::insert([
			'user_id' => 3,
			'website' => 'LinkedIn',
			'url' => 'https://www.linkedin.com/in/joseph-marvin-imperial-9382b9a7/'
		]);

		OP::insert([
			'user_id' => 7,
			'website' => 'Facebook',
			'url' => 'https://www.facebook.com/JayBermudezPH'
		]);

		OP::insert([
			'user_id' => 7,
			'website' => "Google Scholar",
			'url' => 'https://scholar.google.com/citations?user=Tb8Zzk0AAAAJ&hl=en&oi=ao'
		]);
	}
}