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
		// MASTER ADMIN
		U::create([
			'title' => null,
			'first_name' => 'Master',
			'middle_name' => null,
			'last_name' => 'Admin',
			'suffix' => null,
			'avatar' => null,
			'isAvatarLink' => 0,
			'email' => "ma@admin.admin",
			'username' => 'ma_admin',
			'contact_no' => null,
			'password' => Hash::make('ma_admin'),
			'role_id' => 1,
			'expiration_date' => null
		]);

		// DESIGNATED USERS
		U::create([
			'title' => null,
			'first_name' => 'Angelique',
			'middle_name' => 'D',
			'last_name' => 'Lacasandile',
			'suffix' => null,
			'avatar' => 'user2.jpg',
			'isAvatarLink' => 0,
			'email' => 'angelique.lacasandile@gmail.com',
			'username' => 'adlacasandile',
			'contact_no' => '966 712 5676',
			'password' => Hash::make('pass123'),
			'role_id' => 4,
			'expiration_date' => null
		]);

		U::create([
			'title' => null,
			'first_name' => 'Mideth',
			'middle_name' => 'B',
			'last_name' => 'Abisado',
			'suffix' => null,
			'avatar' => 'user3.jpg',
			'isAvatarLink' => 0,
			'email' => 'mbabisado@national-u.edu.ph',
			'username' => 'mbabisado',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role_id' => 5,
			'expiration_date' => null
		]);

		U::create([
			'title' => null,
			'first_name' => 'Joseph Marvin',
			'middle_name' => null,
			'last_name' => 'Imperial',
			'suffix' => null,
			'avatar' => 'user4.jpg',
			'isAvatarLink' => 0,
			'email' => 'jrimperial@national-u.edu.ph',
			'username' => 'jrimperial',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role_id' => 5,
			'expiration_date' => null
		]);

		U::create([
			'title' => null,
			'first_name' => 'Arlene',
			'middle_name' => 'O',
			'last_name' => 'Trillanes',
			'suffix' => null,
			'avatar' => 'user5.jpg',
			'isAvatarLink' => 0,
			'email' => 'aotrillanes@national-u.edu.ph',
			'username' => 'aotrillanes',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role_id' => 3,
			'expiration_date' => null
		]);

		U::create([
			'title' => null,
			'first_name' => 'Susan',
			'middle_name' => 'S',
			'last_name' => 'Caluya',
			'suffix' => null,
			'avatar' => 'user6.jpg',
			'isAvatarLink' => 0,
			'email' => 'sscaluya@national-u.edu.ph',
			'username' => 'sscaluya',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role_id' => 5,
			'expiration_date' => null
		]);

		U::create([
			'title' => null,
			'first_name' => 'Bernie',
			'middle_name' => 'S',
			'last_name' => 'Fabito',
			'suffix' => null,
			'avatar' => 'user7.jpg',
			'isAvatarLink' => 0,
			'email' => 'bsfabito@national-u.edu.ph',
			'username' => 'bsfabito',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role_id' => 5,
			'expiration_date' => null
		]);

		U::create([
			'title' => null,
			'first_name' => 'Jayson Raymund',
			'middle_name' => 'D',
			'last_name' => 'Bermudez',
			'suffix' => null,
			'avatar' => 'user8.jpg',
			'isAvatarLink' => 0,
			'email' => 'jrdbermudez@national-u.edu.ph',
			'username' => 'jrdbermudez',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role_id' => 3,
			'expiration_date' => null
		]);

		U::create([
			'title' => null,
			'first_name' => 'Rogel',
			'middle_name' => 'M',
			'last_name' => 'Labanan',
			'suffix' => null,
			'avatar' => 'user9.jpg',
			'isAvatarLink' => 0,
			'email' => 'rmlabanan@national-u.edu.ph',
			'username' => 'rmlabanan',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role_id' => 5,
			'expiration_date' => null
		]);

		U::create([
			'title' => null,
			'first_name' => 'Ria Liza',
			'middle_name' => 'C',
			'last_name' => 'Canlas',
			'suffix' => null,
			'avatar' => 'user10.jpg',
			'isAvatarLink' => 0,
			'email' => 'rlccanlas@national-u.edu.ph',
			'username' => 'rlccanlas',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role_id' => 3,
			'expiration_date' => null
		]);

		U::create([
			'title' => null,
			'first_name' => 'Rafael',
			'middle_name' => 'A',
			'last_name' => 'Dimaculangan',
			'suffix' => null,
			'avatar' => 'user11.jpg',
			'isAvatarLink' => 0,
			'email' => 'rdimaculangan@national-u.edu.ph',
			'username' => 'rdimaculangan',
			'contact_no' => null,
			'password' => Hash::make('pass123'),
			'role_id' => 4,
			'expiration_date' => null
		]);

		// DEV ACCOUNT FOR LOCAL TESTING
		if (app()->isLocal()) {
			U::create([
				'title' => null,
				'first_name' => 'カール・サッチ',
				'middle_name' => 'エスゲラ',
				'last_name' => 'ナビダ',
				'suffix' => null,
				'avatar' => 'https://avatars.githubusercontent.com/u/19548426?v=4',
				'isAvatarLink' => 1,
				'email' => 'satchi5600@gmail.com',
				'username' => 'navidake',
				'contact_no' => '933 819 3519',
				'password' => Hash::make('pass123'),
				'role_id' => 1,
				'expiration_date' => null
			]);
		}
	}
}
