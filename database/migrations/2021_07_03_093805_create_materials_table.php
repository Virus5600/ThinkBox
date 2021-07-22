<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materials', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('topic_id')->unsigned();
			$table->integer('faculty_staff_id')->unsigned();
			$table->string('material_name');
			$table->mediumText('description');
			$table->timestamps();

			$table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
			$table->foreign('faculty_staff_id')->references('id')->on('faculty_staffs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::down('materials');
	}
}