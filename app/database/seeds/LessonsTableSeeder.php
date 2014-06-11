<?php

use Faker\Factory as Faker;

class LessonsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('lessons')->delete();

		$faker          = Faker::create();
		$tutorials      = Tutorial::all();
		$classes        = Classe::where('parent_id', 0)->get();
		// $classes     = Classe::all();
		$ids_classes    = array();
		$timetables     = Timetable::all();
		$ids_timetables = array();
		
		$classrooms     = Classroom::all();
		$ids_classrooms = array();
		$lessons        = array();
		
		foreach ($classes as $classe)
		{
			$ids_classes[] = $classe->id;
		}

		foreach ($timetables as $timetable)
		{
			$ids_timetables[] = $timetable->id;
		}

		foreach ($classrooms as $classroom)
		{
			$ids_classrooms[] = $classe->id;
		}

		foreach ($tutorials as $tutorial)
		{
			$ndaysweek = $faker->numberBetween($min = 1, $max = 7);
			$start_at = $faker->dateTimeThisYear($format = 'Y-m-d', $max = 'now');
			$end_at = $faker->dateTimeThisYear($format = 'Y-m-d', $max = 'now');

			while($end_at < $start_at)
			{
				$end_at = $faker->dateTimeThisYear($format = 'Y-m-d', $max = 'now');
			}

			for ($i=1; $i <=$ndaysweek ; $i++)
			{
				$lessons[] = [
					'classe_id'    => $faker->randomElement($array = $ids_classes), //$classe->id,
					'timetable_id' => $faker->randomElement($array = $ids_timetables),
					'tutorial_id'  => $tutorial->id,
					'classroom_id' => $faker->randomElement($array = $ids_classrooms),
					'start_at'     => $start_at,
					'end_at'       => $end_at
				];
			}
		}

		// Delete all the lessons
		DB::table('lessons')->truncate();

		DB::table('lessons')->insert($lessons);
	}

}