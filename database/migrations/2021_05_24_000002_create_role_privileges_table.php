<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePrivilegesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_privileges', function (Blueprint $table) {
			$table->integer('role_id')->unsigned();
			$table->integer('privilege_id')->unsigned();

			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
			$table->foreign('privilege_id')->references('id')->on('privileges')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_privileges');
	}
}