<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyFocusTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculty_focus', function (Blueprint $table) {
            $table->integer('faculty_staff_id')->unsigned();
            $table->integer('focus_id')->unsigned();

            $table->foreign('faculty_staff_id')->references('id')->on('faculty_staffs')->onDelete('cascade');
            $table->foreign('focus_id')->references('id')->on('focus')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('faculty_focus');
	}
}