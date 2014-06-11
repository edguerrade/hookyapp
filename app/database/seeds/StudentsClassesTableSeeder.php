<?php

use Faker\Factory as Faker;

class StudentsClassesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('students_classes')->delete();
		
		$faker            = Faker::create();
		$students_classes = array();
		$students         = array();
		$students_g       = Sentry::findGroupByName('Alumne');
		$users            = Sentry::findAllUsers();
		$classes          = Classe::all();
		
		foreach ($users as $user)
		{
			if ($user->inGroup($students_g))
			{
				$students[] = $user->id;
			}
		}

		foreach ($classes as $classe)
		{
			$n_students_classe = $faker->numberBetween($min = 1, $max = 3);
			$students_classe = $faker->unique->randomElements($array = $students, $count = $n_students_classe);
			foreach ($students_classe as $student_id) {
				$students_classes[] = [
					'classe_id' => $classe->id,
					'alumne_id' => $student_id
				];
			}
	    }

		// Delete all the tutorials
		DB::table('students_classes')->truncate();

		DB::table('students_classes')->insert($students_classes);
	}

}