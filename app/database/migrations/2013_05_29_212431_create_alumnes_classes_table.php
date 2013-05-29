<?php

use Illuminate\Database\Migrations\Migration;

class CreateAlumnesClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Alumnes_Classes` table
		Schema::create('alumnes_classes', function($table)
		{
			// $table->increments('id')->unsigned();
			$table->integer('classe_id')->unsigned();
			$table->integer('alumne_id')->unsigned();
			$table->timestamps();
			$table->primary(array('classe_id', 'alumne_id'))->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `Alumnes_Classes` table
		Schema::drop('alumnes_classes');
	}

}