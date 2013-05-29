<?php

use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Update the `Users` table
		Schema::table('users', function($table)
		{
			$table->softDeletes();
			$table->string('nif', 30)->unique();
			$table->string('avatar');
			$table->text('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop updated columns from `Users` table
		Schema::table('users', function($table)
		{
			$table->dropColumn('nif', 'avatar', 'description', 'deleted_at');
		});
	}

}