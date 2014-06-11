<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Tutorials` table
		Schema::create('tutorials', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('code', 10)->unique();
			$table->text('description');
			$table->integer('tutor_id')->unsigned();

			// $table->timestamps();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `Tutorials` table
		Schema::dropIfExists('tutorials');
	}

}