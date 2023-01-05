<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultySkillTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faculty_skills', function(Blueprint $table) {
            $table->integer('faculty_staff_id')->unsigned();
            $table->integer('skill_id')->unsigned();
            $table->tinyInteger('is_marked')->default(0);
			$table->mediumText('reason')->nullable();

            $table->foreign('faculty_staff_id')->references('id')->on('faculty_staffs')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('faculty_skills');
	}
}