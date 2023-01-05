<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchAuthorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('research_authors', function (Blueprint $table) {
			$table->integer('research_id')->unsigned();
			$table->integer('staff_id')->unsigned();

			$table->foreign('research_id')->references('id')->on('research')->onDelete('cascade');
			$table->foreign('staff_id')->references('id')->on('faculty_staffs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('research_authors');
	}
}