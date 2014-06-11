<?php

class TutorialController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the tutorials
		$tutorials = Tutorial::all();

		// load the view and pass the tutorials
		return View::make('tutorials.index')
			->with('tutorials', $tutorials);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Request::ajax()) {
			// load the create form (app/views/tutorials/modalcreate.blade.php)
			return View::make('tutorials.modalcreate');
		} else {
			// load the create form (app/views/tutorials/create.blade.php)
			return View::make('tutorials.create');
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
			'code'		  => 'required',
			'description' => 'required',
			'tutor_id' 	  => 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('tutorials/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store
			$tutorial = new Tutorial;
			$tutorial->code       = Input::get('code');
			$tutorial->description      = Input::get('description');
			$tutorial->tutor_id = Input::get('tutor_id');
			$tutorial->save();

			// redirect
			Session::flash('message', 'Successfully created tutorial!');
			return Redirect::to('tutorials');
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
		// get the tutorial
		$tutorial = Tutorial::find($id);

		// show the view and pass the tutorial to it
		return View::make('tutorials.show')
			->with('tutorial', $tutorial);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the tutorial
		$tutorial = Tutorial::find($id);

		// show the edit form and pass the tutorial
		if(Request::ajax()) {
			return View::make('tutorials.modaledit')
				->with('tutorial', $tutorial);
		} else {
			return View::make('tutorials.edit')
				->with('tutorial', $tutorial);
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
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'code'		  => 'required',
			'description' => 'required',
			'tutor_id' 	  => 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('tutorials/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$tutorial = Tutorial::find($id);
			$tutorial->code       = Input::get('code');
			$tutorial->description      = Input::get('description');
			$tutorial->tutor_id = Input::get('tutor_id');
			$tutorial->save();

			// redirect
			Session::flash('message', 'Successfully updated tutorial!');
			return Redirect::to('tutorials');
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
		// delete
		$tutorial = Tutorial::find($id);
		$tutorial->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the tutorial!');
		return Redirect::to('tutorials');
	}

}