<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});
		// Update the `Users` table
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('avatar');
			$table->text('description');
			$table->string('tel', 20);
			$table->date('dob');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop updated columns from `users` table
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('avatar', 'description', 'dob', 'deleted_at');
		});
	}

}