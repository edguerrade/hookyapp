<?php

use Rees\Sanitizer\Sanitizer;

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the users
		// $users = User::all();
		$users = Sentry::findAllUsers();

		// load the view and pass the tutorials
		return View::make('users.index')
			->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try
		{
		    // Create the user
		    $user = Sentry::createUser(array(
		        'email'     => 'john.doe@example.com',
		        'password'  => 'test',
		        'activated' => true,
		    ));

		    // Find the group using the group id
		    $adminGroup = Sentry::findGroupById(1);

		    // Assign the group to the user
		    $user->addGroup($adminGroup);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    echo 'User with this login already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group was not found.';
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the user
		$user = User::find($id);

		// show the view and pass the user to it
		return View::make('users.show')
			->with('user', $user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the user
		$user = Sentry::findUserById($id);
		
		// get the user_groups
		$groups = Sentry::findAllGroups();
		
		$allgroups = array();
		foreach ($groups as $group ) {
			$allgroups[$group->name] = 0;
		}

		$usergroups = array();
		foreach ($user->getGroups() as $key => $u_group) {
			$usergroups[$u_group->name] = 1;
		}
	

		$allgroups = array_merge($allgroups, $usergroups);

		// get the user_perms
		$permissions = Permission::all(array('code'));
		
		$alluserperms = array();
		foreach ($permissions as $permission ) {
			$alluserperms[$permission->code] = 0;
		}

		$allperms = array_merge($alluserperms, $user->getMergedPermissions());

		// show the edit form and pass the user
		if(Request::ajax()) {
			return View::make('users.modaledit')
				->with('user', $user);
		} else {
			return View::make('users.edit')
				->with('user', $user)
				->with('groups', $allgroups)
				->with('permissions', $allperms);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
		$rules = array(
			'email' => 'required',
			'image' => 'image|max:3000'
		);

	    $validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('users/' . $id . '/edit')
				->withErrors($validator)
				->withInput();
		} else {
			try
			{
			    $rules = [
					'first_name'  => 'trim|strtolower|ucwords',
					'last_name'   => 'trim|strtolower|ucwords',
					'email'       => 'trim|strtolower',
					'description' => 'trim'
				];
				$data = Input::all();

				$sanitizer = new Sanitizer;
				$sanitizer->sanitize($rules, $data);
				// Sanitizer::sanitize($rules, $data);
				// var_dump($data);
				// exit();

			    // Find the user using the user id
			    $user = Sentry::findUserById($id);

			    // Update the user details
				/*$user->first_name  = Input::get('first_name');
				$user->last_name   = Input::get('last_name');
				$user->email       = Input::get('email');
				// $user->tel      = Input::get('tel');
				$user->dob         = Input::get('dob');
				$user->description = Input::get('description');*/

				$user->first_name  = $data['first_name'];
				$user->last_name   = $data['last_name'];
				$user->email       = $data['email'];
				// $user->tel      = Input::get('tel');
				$user->dob         = Input::get('dob');
				$user->description = $data['description'];

				if (Input::hasFile('image')) {
				    $file = Input::file('image');

					$destinationPath = 'public/avatar';
					$extension =$file->getClientOriginalExtension();
					$filename = str_random(12).".{$extension}";
					//$filename = $file->getClientOriginalName(); 
					$upload_success = $file->move($destinationPath, $filename);
					
					if( $upload_success ) {
						if(File::exists($user->avatar)) {
							File::delete($user->avatar);
						}
						$user->avatar = 'avatar/' . $filename;
						// return Response::json('success', 200);
					} else {
						Session::flash('message', 'Failed updated image!');
						return Redirect::to('users/' . $id . '/edit');
					}
				}

			    // Update the user
			    if ($user->save())
			    {
					// redirect
					Session::flash('message', 'Successfully updated user!');
					return Redirect::to('users/' . $id);
			    }
			    else
			    {
			        // redirect
					Session::flash('message', 'Failed updated user!');
					return Redirect::to('users/' . $id . '/edit');
			    }
			}
			catch (Cartalyst\Sentry\Users\UserExistsException $e)
			{
			    echo 'User with this login already exists.';
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    echo 'User was not found.';
			}
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateGroups($id)
	{
		// validate
		$rules = array(
			'groups' => 'array'
		);

	    $validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('users/' . $id . '/edit')
				->withErrors($validator)
				->withInput();
		} else {
			try
			{
				// Find the user using the user id
			    $user = Sentry::findUserById($id);

				if (Input::has('groups'))
				{
					$groups = Input::get('groups');
					if (is_array($groups))
					{
						foreach (Sentry::findAllGroups() as $group)
						{
							if ($user->removeGroup($group))
						    {
						        // Group removed successfully
						    }
						    else
						    {
						        // Group was not removed
								Session::flash('message', 'Failed remove user from group!');
								return Redirect::to('users/' . $id . '/edit');
						    }
						}
						foreach (Input::get('groups') as $group_name => $value) {
							$group = Sentry::findGroupByName($group_name);
							
							if($value=='1')
							{
								if ($user->addGroup($group))
							    {
							        // Group assigned successfully
							        	
							    }
							    else
							    {
							        // Group was not assigned
									Session::flash('message', 'Failed add user to group!');
									return Redirect::to('users/' . $id . '/edit');
							    }
						    }
						}
						// redirect
						Session::flash('message', 'Successfully edit groups!');
						return Redirect::to('users/' . $id);
					}
				}
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    echo 'User was not found.';
			}
			catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
			{
				echo 'Group was not found.';
			}
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updatePermissions($id)
	{
		// validate
		$rules = array(
			'permissions' => 'array'
		);

	    $validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('users/' . $id . '/edit')
				->withErrors($validator)
				->withInput();
		} else {

			// Find the user using the user id
			$user = Sentry::findUserById($id);

			if (Input::has('permissions'))
			{
				$permissions = Input::get('permissions');
				if (is_array($permissions))
				{
					$new_perms = array();
					foreach ($permissions as $permission => $value ) {
						$new_perms[$permission] = intval($value);
					}
					foreach ($user->getGroups() as $group)
					{
						$new_perms = array_diff($new_perms, $group->getPermissions());
					}
					// var_dump($new_perms);
					// exit();
					$user->permissions = $new_perms;

					if ($user->save())
				    {
						// redirect
						Session::flash('message', 'Successfully edit permissions!');
						return Redirect::to('users/' . $id);
				    }
				    else
				    {
				        // redirect
						Session::flash('message', 'Failed edit permissions!');
						return Redirect::to('users/' . $id . '/edit');
				    }
				}
			}
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateImage($id)
	{
		// validate
		$rules = array(
			'get-data-input' => 'required'
		);

	    $validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('users/' . $id . '/edit')
				->withErrors($validator)
				->withInput();
		} else {
			$imgdata = json_decode(Input::get('get-data-input'), true);
			
			// Find the user using the user id
			$user = Sentry::findUserById($id);

			// open file a image resource
			$img = Image::make('public/' . $user->avatar);

			// crop image
			$img->crop($imgdata['width'],$imgdata['height'], $imgdata['x1'], $imgdata['y1']);
			$img->resize(null, 512, function ($constraint) {
		    	$constraint->aspectRatio();
				$constraint->upsize();
			});
			$img->save('public/' . $user->avatar);
		    
			// redirect
			Session::flash('message', 'Successfully update image!');
			return Redirect::to('users/' . $id);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// TODO: remove user storage like images
		try
		{
		    // Find the user using the user id
		    $user = Sentry::findUserById($id);

		    // Delete the user
		    $user->delete();
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
	}

}