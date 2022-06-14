<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title')->nullable();
			$table->string('first_name');
			$table->string('middle_name')->nullable();
			$table->string('last_name');
			$table->string('suffix')->nullable();
			$table->string('avatar')->nullable();
			$table->boolean('isAvatarLink');
			$table->string('email')->nullable()->unique();
			$table->string('username')->unique();
			$table->string('contact_no')->nullable()->unique();
			$table->string('password');
			$table->integer('role_id')->unsigned()->nullable();
			$table->rememberToken();
			$table->timestamps();
			$table->dateTime('expiration_date')->nullable();
			
			$table->foreign('role')->references('id')->on('roles')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}
}