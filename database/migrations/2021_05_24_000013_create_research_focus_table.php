<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchFocusTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('research_focus', function (Blueprint $table) {
			$table->integer('research_id')->unsigned();
			$table->integer('focus_id')->unsigned();

			$table->foreign('research_id')->references('id')->on('research')->onDelete('cascade');
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
		Schema::dropIfExists('research_focus');
	}
}