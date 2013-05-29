<?php

use Illuminate\Database\Migrations\Migration;

class CreateTutoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Tutories` table
		Schema::create('tutories', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('code', 10)->unique();
			$table->text('description');
			$table->integer('tutor_id')->unsigned();
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
		// Delete the `Tutories` table
		Schema::drop('tutories');
	}

}