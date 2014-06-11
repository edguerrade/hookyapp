<?php

use Faker\Factory as Faker;

class TeachersClassesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('teachers_classes')->delete();
		
		$faker            = Faker::create();
		$teachers_classes = array();
		$teachers         = array();
		$n_teachers       = 1;
		$teacher_g        = Sentry::findGroupByName('Docent');
		$users            = Sentry::findAllUsers();
		$classes          = Classe::all();

		foreach ($users as $user)
		{
			if ($user->inGroup($teacher_g))
			{
				$teachers[] = $user->id;
			}
		}

		foreach ($classes as $classe)
		{
			$n_teachers = $faker->numberBetween($min = 1, $max = 2);
			for ($i=0; $i < $n_teachers; $i++) { 
				$teachers_classes[] = [
					'classe_id' => $classe->id,
					'professor_id' => $faker->randomElement($array = $teachers)
				];
			}
	    }

		// Delete all the tutorials
		DB::table('teachers_classes')->truncate();

		DB::table('teachers_classes')->insert($teachers_classes);
	}

}