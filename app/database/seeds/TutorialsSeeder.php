<?php

use Faker\Factory as Faker;

class TutorialsSeeder extends Seeder {

	public function run()
	{
		DB::table('tutorials')->delete();
		
		$faker     = Faker::create();
		$tutors    = array();
		$tutor_g   = Sentry::findGroupByName('Tutor');
		$users     = Sentry::findAllUsers();
		
		foreach ($users as $user)
		{
			if ($user->inGroup($tutor_g))
		    {
		        $tutorials[] = [
					'code' => strtoupper($faker->unique()->bothify($string = '???##?')),
					'description' => $faker->sentence($nbWords = 4),
					'tutor_id' => $user->id
				];
		    }
		}
		
		/*$tutorials[] = [
			['code' => 'DAW1', 'description' => 'Desenvolupament d\'Aplicacions Web 1r curs.'],
			['code' => 'DAW1A', 'description' => 'Desenvolupament d\'Aplicacions Web 1r curs Grup A.'],
			['code' => 'DAW1B', 'description' => 'Desenvolupament d\'Aplicacions Web 1r curs Grup B.'],
			['code' => 'DAW1C', 'description' => 'Desenvolupament d\'Aplicacions Web 1r curs Grup C.'],
			['code' => 'DAW2', 'description' => 'Desenvolupament d\'Aplicacions Web 2n curs.'],
			['code' => 'DAW2A', 'description' => 'Desenvolupament d\'Aplicacions Web 2n curs Grup A.'],
			['code' => 'DAW2B', 'description' => 'Desenvolupament d\'Aplicacions Web 2n curs Grup B.'],
			['code' => 'DAI1', 'description' => 'Desenvolupament d\'Aplicacions Informàtiques 1r curs.'],
			['code' => 'DAI2', 'description' => 'Desenvolupament d\'Aplicacions Informàtiques 2n curs.'],
			['code' => 'ASI1', 'description' => 'Administració de Sistemes Informàtics 1r curs.'],
			['code' => 'ASI2', 'description' => 'Administració de Sistemes Informàtics 2n curs.'],
			['code' => 'DAM1', 'description' => 'Desenvolupament d\'Aplicacions Multiplataforma 1r curs.'],
			['code' => 'DAM2', 'description' => 'Desenvolupament d\'Aplicacions Multiplataforma 2n curs.'],
			['code' => 'ASIX1', 'description' => 'Administració de Sistemes Informàtics en Xarxa 1r curs.'],
			['code' => 'ASIX2', 'description' => 'Administració de Sistemes Informàtics en Xarxa 2n curs.'],
			['code' => 'SMX1', 'description' => 'Sistemes microinformàtics i xarxes 1r curs.'],
			['code' => 'SMX2', 'description' => 'Sistemes microinformàtics i xarxes 2n curs.'],
			['code' => '1BTX-H-A', 'description' => 'Batxillerat modalitat d\'Humanitats i Ciències Socials 1r curs Classe A.'],
			['code' => '1BTX-H-B', 'description' => 'Batxillerat modalitat d\'Humanitats i Ciències Socials 1r curs Classe B.'],
			['code' => '4ESO-A', 'description' => 'Educació Secundària Obligatòria 4t curs Classe A.'],
			['code' => '4ESO-B', 'description' => 'Educació Secundària Obligatòria 4t curs Classe B.'],
			['code' => '3ESO-A', 'description' => 'Educació Secundària Obligatòria 3r curs Classe A.'],
			['code' => '3ESO-B', 'description' => 'Educació Secundària Obligatòria 3r curs Classe B.'],
			['code' => '2ESO-A', 'description' => 'Educació Secundària Obligatòria 2n curs Classe A.'],
			['code' => '2ESO-B', 'description' => 'Educació Secundària Obligatòria 2n curs Classe B.'],
			['code' => '1ESO-A', 'description' => 'Educació Secundària Obligatòria 1r curs Classe A.'],
			['code' => '1ESO-B', 'description' => 'Educació Secundària Obligatòria 1r curs Classe B.'],
		];*/
		
		// Delete all the tutorials
		DB::table('tutorials')->truncate();

		DB::table('tutorials')->insert($tutorials);

		//'content' => file_get_contents(__DIR__ . '/post-content.txt'),
		
	}

}
