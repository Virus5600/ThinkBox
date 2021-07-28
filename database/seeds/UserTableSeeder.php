<?php

use Illuminate\Database\Seeder;

use App\User as U;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		U::create([
			'id' => 1,
			'title' => 'Dr.',
			'first_name' => 'Angelique',
			'middle_name' => 'D',
			'last_name' => 'Lacasandile',
			'suffix' => null,
			'avatar' => 'user1.jpg',
			'isAvatarLink' => 0,
			'email' => 'angelique.lacasandile@gmail.com',
			'username' => 'lacasandillea',
			'contact_no' => '966 712 5676',
			'password' => Hash::make('pass123'),
			'role' => 1,
			'expiration_date' => null
		]);

		U::create([
			'id' => 2,
			'title' => null,
			'first_name' => 'Mideth',
			'middle_name' => 'B',
			'last_name' => 'Abisado',
			'suffix' => null,
			'avatar' => 'user2.jpg',
			'isAvatarLink' => 0,
			'email' => 'mbabisado@national-u.edu.ph',
			'username' => 'abisadomb',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role' => 3,
			'expiration_date' => null
		]);

		U::create([
			'id' => 3,
			'title' => null,
			'first_name' => 'Joseph Marvin',
			'middle_name' => null,
			'last_name' => 'Imperial',
			'suffix' => null,
			'avatar' => 'user3.jpg',
			'isAvatarLink' => 0,
			'email' => 'jrimperial@national-u.edu.ph',
			'username' => 'imperialjm',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role' => 3,
			'expiration_date' => null
		]);

		U::create([
			'id' => 4,
			'title' => 'Dr.',
			'first_name' => 'Arlene',
			'middle_name' => 'O',
			'last_name' => 'Trillanes',
			'suffix' => null,
			'avatar' => 'user4.jpg',
			'isAvatarLink' => 0,
			'email' => 'aotrillanes@national-u.edu.ph',
			'username' => 'trillanesao',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role' => 1,
			'expiration_date' => null
		]);

		U::create([
			'id' => 5,
			'title' => null,
			'first_name' => 'Susan',
			'middle_name' => 'S',
			'last_name' => 'Caluya',
			'suffix' => null,
			'avatar' => 'user5.jpg',
			'isAvatarLink' => 0,
			'email' => 'sscaluya@national-u.edu.ph',
			'username' => 'caluyass',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role' => 3,
			'expiration_date' => null
		]);

		U::create([
			'id' => 6,
			'title' => null,
			'first_name' => 'Bernie',
			'middle_name' => 'S',
			'last_name' => 'Fabito',
			'suffix' => null,
			'avatar' => 'user6.jpg',
			'isAvatarLink' => 0,
			'email' => 'bsfabito@national-u.edu.ph',
			'username' => 'fabitobs',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role' => 3,
			'expiration_date' => null
		]);

		U::create([
			'id' => 7,
			'title' => null,
			'first_name' => 'Jayson Raymund',
			'middle_name' => 'D',
			'last_name' => 'Bermudez',
			'suffix' => null,
			'avatar' => 'user7.jpg',
			'isAvatarLink' => 0,
			'email' => 'jrdbermudez@national-u.edu.ph',
			'username' => 'bermudezjrd',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role' => 3,
			'expiration_date' => null
		]);

		U::create([
			'id' => 8,
			'title' => null,
			'first_name' => 'Rogel',
			'middle_name' => 'M',
			'last_name' => 'Labanan',
			'suffix' => null,
			'avatar' => null,
			'isAvatarLink' => 0,
			'email' => null,
			'username' => 'labananrm',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role' => 3,
			'expiration_date' => null
		]);
		if (env('APP_ENV') == 'local') {
			U::create([
				'id' => 9,
				'title' => null,
				'first_name' => 'カール・サッチ',
				'middle_name' => 'エスゲラ',
				'last_name' => 'ナビダ',
				'suffix' => null,
				'avatar' => 'https://avatars.githubusercontent.com/u/19548426?v=4',
				'isAvatarLink' => 1,
				'email' => 'satchi5600@gmail.com',
				'username' => 'navidakse',
				'contact_no' => '933 819 3519',
				'password' => Hash::make('pass123'),
				'role' => 1,
				'expiration_date' => null
			]);
		}
	}
}
