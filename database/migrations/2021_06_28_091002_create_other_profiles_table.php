<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherProfilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('other_profiles', function (Blueprint $table) {
			$table->integer('user_id')->unsigned();
			$table->enum('website', ['Facebook', 'Github', 'Google Scholar', 'LinkedIn', 'Twitter'])->nullable();
			$table->string('url');

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('other_profiles');
	}
}
