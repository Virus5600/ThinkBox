<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchFilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('research_files', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('research_id')->unsigned();
			$table->string('original_name');
			$table->string('file');
			$table->timestamps();

			$table->foreign('research_id')->references('id')->on('research')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('research_files');
	}
}