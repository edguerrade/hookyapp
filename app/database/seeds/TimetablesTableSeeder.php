<?php

use Faker\Factory as Faker;

class TimetablesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$timetables = array();
		for ($i=0; $i < 10; $i++) { 
			
			foreach(range(0, 6) as $index)
			{
				$start_one=$faker->time($format = 'H:i', $max = 'now');
				
				$start_two=$faker->time($format = 'H:i', $max = 'now');
				while($start_one>$start_two)
				{
					$start_two=$faker->time($format = 'H:i', $max = 'now');
				}
				
				$start_three=$faker->time($format = 'H:i', $max = 'now');
				while($start_two>$start_three)
				{
					$start_three=$faker->time($format = 'H:i', $max = 'now');
				}

				$start_four=$faker->time($format = 'H:i', $max = 'now');
				while($start_three>$start_four)
				{
					$start_four=$faker->time($format = 'H:i', $max = 'now');
				}

				$start_five=$faker->time($format = 'H:i', $max = 'now');
				while($start_four>$start_five)
				{
					$start_five=$faker->time($format = 'H:i', $max = 'now');
				}

				$start_six=$faker->time($format = 'H:i', $max = 'now');
				while($start_five>$start_six)
				{
					$start_six=$faker->time($format = 'H:i', $max = 'now');
				}


				$j = $faker->randomDigit;
				if ($j % 2 === 0) {
					$timetables[] = [
						'weekday' => $index, 
						'time' => '[
										[
											"' . $start_one . '",
											"' . $start_two . '"
										],
										[
											"' . $start_three . '",
											"' . $start_four . '"
										]
									]'
					];
				}
				elseif($j % 3 === 0)
				{
					$timetables[] = [
						'weekday' => $index, 
						'time' => '[
										[
											"' . $start_one . '",
											"' . $start_two . '"
										]
									]'
					];
				}
				else
				{
					$timetables[] = [
						'weekday' => $index, 
						'time' => '[
										[
											"' . $start_one . '",
											"' . $start_two . '"
										],
										[
											"' . $start_three . '",
											"' . $start_four . '"
										],
										[
											"' . $start_five . '",
											"' . $start_six . '"
										]
									]'
					];
				}
			}
		}
		// print_r($timetables);

		DB::table('timetables')->delete();
		// Delete all the timetables
		DB::table('timetables')->truncate();
		/*$timetables = [
			['weekday' => 0, 'time' => '[["7:00","13:00"],["14:00","16:00"]]'],
			['weekday' => 1, 'time' => '[["8:00","12:00"]]'],
			['weekday' => 2, 'time' => '[["6:45","12:00"],["12:30","18:00"]]'],
			['weekday' => 3, 'time' => '[["13:00","20:00"]]'],
			['weekday' => 4, 'time' => '[["7:00","13:00"],["14:00","16:00"]]'],
			['weekday' => 5, 'time' => '[]'],
			['weekday' => 6, 'time' => '[]'],
		];*/
		
		DB::table('timetables')->insert($timetables);
	}

}