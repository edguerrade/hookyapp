<?php

class GroupController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the groups
		$groups = Sentry::findAllGroups();

		// load the view and pass the tutorials
		return View::make('groups.index')
			->with('groups', $groups);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Request::ajax()) {
			// load the create form (app/views/groups/modalcreate.blade.php)
			return View::make('groups.modalcreate');
		} else {
			// load the create form (app/views/groups/create.blade.php)
			return View::make('groups.create');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
		$rules = array(
			'name'		  => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('groups/create')
				->withErrors($validator)
				->withInput();
		} else {
			try
			{
			    // Create the group
			    if (Input::has('permissions') && is_array(Input::get('permissions')))
				{
					$permissions = Input::get('permissions');
				}

			    $group = Sentry::createGroup(array(
			        'name'        => Input::get('name'),
			        'permissions' => $permissions,
			    ));

			    // redirect
				Session::flash('message', 'Successfully created group!');
				return Redirect::to('groups/' . $group->id);
			}
			catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
			{
			    echo 'Name field is required';
			}
			catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
			{
			    echo 'Group already exists';
			}
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
		// get the group
		$group = Sentry::findGroupById($id);

		// show the view and pass the group to it
		return View::make('groups.show')
			->with('group', $group);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the group
		$group = Sentry::findGroupById($id);
		$permissions = Permission::all(array('code'));

		$allperms = array();
		foreach ($permissions as $permission ) {
			$allperms[$permission->code] = 0;
		}
		$allperms = array_merge($allperms, $group->getPermissions());

		// show the edit form and pass the group
		if(Request::ajax()) {
			return View::make('groups.modaledit')
				->with('group', $group);
		} else {
			return View::make('groups.edit')
				->with('group', $group)
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
			'name'		  => 'required',
			'permissions' => 'array'
		);

	    $validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('groups/' . $id . '/edit')
				->withErrors($validator)
				->withInput();
		} else {
			try
			{
				// Update the group details
				$group = Sentry::findGroupById($id);
			    $group->name = Input::get('name');
			    if (Input::has('permissions'))
				{
					$permissions = Input::get('permissions');
					if (is_array($permissions))
					{
						$group->permissions = Input::get('permissions');
					}
				}
				// Update the group
			    if ($group->save())
			    {
			        // redirect
					Session::flash('message', 'Successfully updated group!');
					return Redirect::to('groups/' . $id);
			    }
			    else
			    {
			        // redirect
					Session::flash('message', 'Failed updated group!');
					return Redirect::to('groups/' . $id . '/edit');
			    }
			}
			catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
			{
			    echo('Name field is required');
			}
			catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
			{
			    echo('Group already exists.');
			}
			catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
			{
			    echo('Group was not found.');
			}
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
		try
		{
		    // Delete the group
			$group = Sentry::findGroupById($id);
	    	$group->delete();

	    	// redirect
			Session::flash('message', 'Successfully deleted the group!');
			return Redirect::to('groups');
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo('Group was not found.');
		}
	}

}