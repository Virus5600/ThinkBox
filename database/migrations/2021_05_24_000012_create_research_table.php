<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('research', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->mediumtext('authors')->nullable();
			$table->mediumtext('description');
			$table->integer('posted_by')->unsigned();
			$table->string('url')->nullable();
			$table->tinyInteger('is_file_requestable')->unsigned()->default(0);
			$table->tinyInteger('is_featured')->unsigned()->default(0);
			$table->date('date_published');
			$table->timestamps();

			$table->foreign('posted_by')->references('id')->on('faculty_staffs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('research');
	}
}