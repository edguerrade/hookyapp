<?php

use anlutro\cURL\cURL;

class SentrySeeder extends Seeder {
    /**
     * Run the users/groups/permissions database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();
        
        // Generate Groups
        $adminGroup = Sentry::getGroupProvider()->create(array(
            'name'        => 'Admin',
            'permissions' => array(
                'admin'         => 1,
                'tutor'         => 1,
                'docent'        => 1,
                'users'         => 1,
                'user.create'   => 1,
                'user.delete'   => 1,
                'user.view'     => 1,
                'user.update'   => 1,
            ),
        ));

        try
        {
            // Create the group
            $group = Sentry::createGroup(array(
                'name'        => 'Moderator',
                'permissions' => array(
                    'admin' => 1,
                    'users' => 1,
                ),
            ));
        }
        catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
        {
            echo 'Name field is required';
        }
        catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            echo 'Group already exists';
        }

        $tutorGroup = Sentry::getGroupProvider()->create(array(
            'name'          => 'Tutor',
            'permissions'   => array(
                'tutor'     => 1,
                'docent'    => 1,
            ),
        ));

        $docentGroup = Sentry::getGroupProvider()->create(array(
            'name'        => 'Docent',
            'permissions' => array('docent' => 1),
        ));

        $alumneGroup = Sentry::getGroupProvider()->create(array(
            'name'        => 'Alumne',
            'permissions' => array('alumne' => 1),
        ));

        // Generate Users - http://api.randomuser.me/0.3/?seed=brownOstrich
        $adminUser = Sentry::getUserProvider()->create(array(
            'email'       => 'ed.guerra.de@gmail.com',
            'password'    => 'admin',
            'first_name'  => 'HookyApp',
            'last_name'   => 'Admin',
            'activated'   => true,
        ));
        // Assign user permissions
        $adminUser->addGroup($adminGroup);

        /*
        for ($i = 1; $i <= 50; $i++)
        {
            $docentUser = Sentry::getUserProvider()->create(array(
                'nif'         => 10000 + $i,
                'email'       => 'docent'.$i.'@insjoandaustria.org',
                'password'    => "docent".$i,
                'first_name'  => 'Docent'.$i,
                'last_name'   => 'Cognoms Docent'.$i,
                'activated'   => 1,
            ));
            // Assign user permissions every 5 a Tutor
            if ($i % 5 === 0) $docentUser->addGroup($tutorGroup);
            $docentUser->addGroup($docentGroup);
        }

        for ($i = 1; $i <= 200; $i++)
        {
            $alumneUser = Sentry::getUserProvider()->create(array(
                'nif'         => 20000 + $i,
                'email'       => 'alumne'.$i.'@insjoandaustria.org',
                'password'    => "alumne".$i,
                'first_name'  => 'Alumne'.$i,
                'last_name'   => 'Cognoms Alumne'.$i,
                'activated'   => 1,
            ));
            // Assign user permissions
            $alumneUser->addGroup($alumneGroup);
        }
        */
        $i = 0;
        $j = 0;
        for ($k=0; $k < 50 ; $k++) { 

            $curl = new cURL;
            $response = $curl->get('http://api.randomuser.me/0.3/?results=5');
            $users = json_decode($response, true);

            foreach ($users['results'] as $user) {
                
                $fechan = date("Y-m-d",$user['user']['dob']);
                
                /*$file = Filesystem::getRemote($user['user']['picture']);
                $destinationPath = 'public/avatar/';
                $extension =$file->getClientOriginalExtension();
                $filename = str_random(12).".{$extension}";
                //$filename = $file->getClientOriginalName(); 
                $upload_success = $file->move($destinationPath, $filename);*/
                $destinationPath = 'public/avatar/';
                $extension = pathinfo($user['user']['picture'], PATHINFO_EXTENSION);
                $filename = str_random(12).".{$extension}";
                copy($user['user']['picture'], $destinationPath . $filename);

                $alumneUser = Sentry::getUserProvider()->create(array(
                    'email'       => $user['user']['email'],
                    'password'    => $user['user']['password'],
                    'first_name'  => ucwords($user['user']['name']['first']),
                    'last_name'   => ucwords($user['user']['name']['last']),
                    'avatar'      => 'avatar/' . $filename, // $user['user']['picture'],
                    'description' => 'password: '.$user['user']['password'],
                    'tel'         => $user['user']['phone'],
                    'dob'         => $fechan,
                    'activated'   => true,
                    /*'permissions' => array(
                        'user.create' => -1,
                    ),*/
                ));
                // Assign user permissions
                if ($i % 5 === 0) {
                    $alumneUser->addGroup($docentGroup);
                    if ($j % 5 === 0) $alumneUser->addGroup($tutorGroup);
                    $j++;
                } else { 
                    $alumneUser->addGroup($alumneGroup);
                }
                $i++;
            }
        }
    }
 
}