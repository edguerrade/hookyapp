<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `students_classes` table
		Schema::create('students_classes', function(Blueprint $table)
		{
			// $table->increments('id')->unsigned();
			$table->integer('classe_id')->unsigned();
			$table->integer('alumne_id')->unsigned();
			
			// $table->timestamps();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			
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
		// Delete the `students_classes` table
        Schema::dropIfExists('students_classes');
	}

}