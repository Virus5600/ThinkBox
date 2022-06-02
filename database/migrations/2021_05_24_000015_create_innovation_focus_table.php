<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInnovationFocusTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('innovation_focus', function (Blueprint $table) {
			$table->integer('innovation_id')->unsigned();
			$table->integer('focus_id')->unsigned();

			$table->foreign('innovation_id')->references('id')->on('innovations')->onDelete('cascade');
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
		Schema::drop('innovation_focus');
	}
}