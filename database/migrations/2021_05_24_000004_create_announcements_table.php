<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('announcements', function(Blueprint $table) {
			$table->increments('id');
			$table->string('image')->nullable();
			$table->string('title');
			$table->string('source')->nullable();
			$table->mediumtext('content');
			$table->integer('author_id')->unsigned()->nullable();
			$table->tinyInteger('is_marked')->default(0);
            $table->mediumText('reason')->nullable();
			$table->timestamps();
			
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');

			$table->charset = 'utf8mb4';
			$table->collation = 'utf8mb4_unicode_ci';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('announcements');
	}
}