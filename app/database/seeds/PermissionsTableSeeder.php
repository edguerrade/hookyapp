<?php

class PermissionsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('permissions')->delete();

		$permissions = [
			['code' => 'admin', 'description' => 'admin'], 
			['code' => 'tutor', 'description' => 'tutor'], 
			['code' => 'docent', 'description' => 'docent'], 
			['code' => 'users', 'description' => 'users'], 
			['code' => 'alumne', 'description' => 'alumne'], 
			['code' => 'user.create', 'description' => 'user.create'], 
			['code' => 'user.delete', 'description' => 'user.delete'], 
			['code' => 'user.view', 'description' => 'user.view'], 
			['code' => 'user.update', 'description' => 'user.update'], 
		];

		DB::table('permissions')->insert($permissions);
	}

}