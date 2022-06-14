<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyStaffTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculty_staffs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('department')->unsigned();
			$table->integer('position')->unsigned();
			$table->string('location')->nullable();
			$table->mediumText('description')->nullable();
			$table->tinyInteger('is_marked')->default(0);
			$table->mediumText('reason')->nullable();
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('position')->references('id')->on('staff_types')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('faculty_staffs');
	}
}