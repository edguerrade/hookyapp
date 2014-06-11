<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('SentrySeeder');
		$this->call('ClassroomsTableSeeder');
		$this->call('TutorialsSeeder');
		$this->call('ClassesSeeder');
		$this->call('PermissionsTableSeeder');
		$this->call('TimetablesTableSeeder');
		$this->call('LessonsTableSeeder');
		$this->call('TeachersClassesTableSeeder');
		$this->call('StudentsClassesTableSeeder');
	}

}