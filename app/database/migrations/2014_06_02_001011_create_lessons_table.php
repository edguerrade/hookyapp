<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLessonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lessons', function(Blueprint $table)
		{
			// $table->increments('id');
			$table->integer('tutorial_id')->unsigned();
			$table->integer('classe_id')->unsigned();
			$table->integer('timetable_id')->unsigned();
			$table->integer('classroom_id')->unsigned();
			$table->date('start_at');
			$table->date('end_at');

			// $table->timestamps();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			
			$table->primary(array('tutorial_id', 'classe_id', 'timetable_id', 'classroom_id', 'start_at', 'end_at'), 'pk_lessons');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('lessons');
	}

}
