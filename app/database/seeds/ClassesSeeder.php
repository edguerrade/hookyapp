<?php

use Faker\Factory as Faker;

class ClassesSeeder extends Seeder {

	public function run()
	{
		DB::table('classes')->delete();

		$faker = Faker::create();
		
		// Initialize empty array
		$classes = array();

		$parent_id = 0;
		$nsubject = $faker->numberBetween($min = 1, $max = 10);
		for ($h=1; $h <= $nsubject; $h++)
		{

			$classes[] = array(
				'code'        => 'A' . $h,
				'parent_id'   => 0,
				'description' => 'Asignatura ' . $h
			);

			$parent_id_m = $parent_id+1;
			$parent_id = $parent_id+1;

			$nmodulos = $faker->numberBetween($min = 1, $max = 10);
			for ($i=1; $i <= $nmodulos; $i++)
			{
				
				$classes[] = array(
					'code'        => 'M' . $i,
					'parent_id'   => $parent_id_m,
					'description' => 'Asignatura ' . $h . ' Módulo ' . $i
				);

				$parent_id = $parent_id+1;
				
				$nuf = $faker->numberBetween($min = 1, $max = 10);
				for ($j=1; $j <= $nuf; $j++)
				{
					
					$classes[] = array(
						'code'        => 'M' . $i . 'UF' . $j,
						'parent_id'   => $parent_id,
						'description' => 'Asignatura ' . $h . ' Módulo ' . $i . ' Unidad Formativa ' . $j
					);

				}
				$parent_id = $parent_id+$nuf;
			}
		}
		/*
		// Tutoria 1 classes
		$date = new DateTime;
		$classes[] = array(
			'code'        => 'M02UF4',
			'tutoria_id'  => 1,
			'description' => 'Bases de dades Objecte-Relacionals',
			'start_at'    => $date->modify('-30 day')->format('Y-m-d'),
			'end_at'      => $date->modify('+30 day')->format('Y-m-d'),
		);
		$date = new DateTime;
		$classes[] = array(
			'code'        => 'M01UF1',
			'tutoria_id'  => 1,
			'description' => 'Bases de dades Objecte-Relacionals',
			'start_at'    => $date->modify('+7 day')->format('Y-m-d'),
			'end_at'      => $date->modify('+47 day')->format('Y-m-d'),
		);
		$date = new DateTime;
		$classes[] = array(
			'code'        => 'M01UF2',
			'tutoria_id'  => 1,
			'description' => 'Bases de dades Objecte-Relacionals',
			'start_at'    => $date->modify('-2 day')->format('Y-m-d'),
			'end_at'      => $date->modify('+15 day')->format('Y-m-d'),
		);

		// Tutoria 2 classes
		$date = new DateTime;
		$classes[] = array(
			'code'        => 'M02UF1',
			'tutoria_id'  => 2,
			'description' => 'Bases de dades Objecte-Relacionals',
			'start_at'    => $date->modify('-30 day')->format('Y-m-d'),
			'end_at'      => $date->modify('+60 day')->format('Y-m-d'),
		);
		$date = new DateTime;
		$classes[] = array(
			'code'        => 'M02UF2',
			'tutoria_id'  => 2,
			'description' => 'Bases de dades Objecte-Relacionals',
			'start_at'    => $date->modify('-10 day')->format('Y-m-d'),
			'end_at'      => $date->modify('+15 day')->format('Y-m-d'),
		);

		// Tutoria 3 classes
		$date = new DateTime;
		$classes[] = array(
			'code'        => 'M02UF3',
			'tutoria_id'  => 3,
			'description' => 'Bases de dades Objecte-Relacionals',
			'start_at'    => $date->modify('+30 day')->format('Y-m-d'),
			'end_at'      => $date->modify('+60 day')->format('Y-m-d'),
		);*/

		// Delete all the classes
		DB::table('classes')->truncate();

		// Insert the classes classes
		Classe::insert($classes);
	}

}
