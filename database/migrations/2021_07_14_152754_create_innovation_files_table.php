<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInnovationFilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('innovation_files', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('innovation_id')->unsigned();
			$table->string('original_name');
			$table->string('file');

			$table->foreign('innovation_id')->references('id')->on('innovations')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('research_files');
	}
}
