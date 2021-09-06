<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInnovationAuthorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('innovation_authors', function (Blueprint $table) {
			$table->integer('innovation_id')->unsigned();
			$table->integer('staff_id')->unsigned();

			$table->foreign('innovation_id')->references('id')->on('innovations')->onDelete('cascade');
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
		Schema::drop('innovation_authors');
	}
}
