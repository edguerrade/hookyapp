<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teachers_classes', function(Blueprint $table)
		{
			// $table->increments('id')->unsigned();
			$table->integer('classe_id')->unsigned();
			$table->integer('professor_id')->unsigned();
			
			// $table->timestamps();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			
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
		// Delete the `teachers_classes` table
		Schema::dropIfExists('teachers_classes');
	}

}