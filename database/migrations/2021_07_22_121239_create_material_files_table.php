<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialFilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('material_files', function (Blueprint $table) {
			$table->integer('material_id')->unsigned();
			$table->string('file_name');

			$table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::down('material_files');
	}
}
