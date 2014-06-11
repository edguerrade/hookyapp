<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ClassroomsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('classrooms')->delete();
		
		$faker             = Faker::create();
		$classrooms        = array();
		$tutor_g           = Sentry::findGroupByName('Tutor');
		$users             = Sentry::findAllUsers();
		$n_flats           = 10;
		$n_classrooms_flat = 10;

		for ($i=1; $i <= $n_flats; $i++) { 
			for ($j=1; $j <= $n_classrooms_flat; $j++) { 
				
				$classrooms[] = [
					'code' => 'P'. $i . '-A' . $j,
					'description' => 'Planta '. $i . ' - Aula ' . $j
				];
			}
		}

		// Delete all the classrooms
		DB::table('classrooms')->truncate();

		DB::table('classrooms')->insert($classrooms);
	}

}