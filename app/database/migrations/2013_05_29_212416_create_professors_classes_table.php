<?php

use Illuminate\Database\Migrations\Migration;

class CreateProfessorsClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Professors_Classes` table
		Schema::create('professors_classes', function($table)
		{
			// $table->increments('id')->unsigned();
			$table->integer('classe_id')->unsigned();
			$table->integer('professor_id')->unsigned();
			$table->timestamps();
			$table->primary(array('classe_id', 'professor_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `Professors_Classes` table
		Schema::drop('professors_classes');
	}

}