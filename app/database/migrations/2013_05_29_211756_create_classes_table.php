<?php

use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Classes` table
		Schema::create('classes', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('code', 10)->unique();
			$table->integer('parent_id')->unsigned();
			$table->integer('tutoria_id')->unsigned();
			$table->text('description');
			$table->timestamp('start_at');
			$table->timestamp('end_at');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `Classes` table
		Schema::drop('classes');
	}

}