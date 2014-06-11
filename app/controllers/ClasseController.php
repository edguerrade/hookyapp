<?php

class ClasseController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the classes
		// $classes = Classe::all();
		$classes = Classe::where('parent_id', 0)->get();

		// load the view and pass the classes
		return View::make('classes.index')
			->with('classes', $classes);
	}

	public function getListByCode($code)
	{
		$classetype  = explode("/", $code);
		$type        = end($classetype);
		// echo 'code: ' . $code . '<br>';
		// echo 'type: ' . $type . '<br>';
		$classes     = Classe::where('code', $type)->get();
		$exitclasses = false;
		$classe_id   = 0;
		foreach ($classes as $classe)
		{
			$urlItem = '/'. $classe->code;
			if($classetype==explode("/", substr($urlItem, 1)))
			{
				$classe_id = $classe->id;
				$exitclasses = true;
			}
			$item = $classe->parent;
			while($item != NULL)
			{
				$urlItem = '/'. $item->code . $urlItem;
				// echo 'urlItem: ' . substr($urlItem, 1) . '<br>';
				if($classetype==explode("/", substr($urlItem, 1)))
				{
					$classe_id = $classe->id;
					$exitclasses = true;
				}
				if($exitclasses) break; 
				$item = $item->parent;
			}
			if($exitclasses) break; 
		}
		//News::find($classe)->news()->whereRaw('parent_id= parent_id')->get();	
		
		if($classe_id != 0)
		{
			// get all the classes with parent_id
			$parent = Classe::find($classe_id);
			$classes = Classe::where('parent_id', $classe_id)->get();
			// load the view and pass the classes
			return View::make('classes.list')
				->with('classes', $classes)
				->with('parent', $parent);
		}
		else
		{
			// redirect
			Session::flash('message', 'Classe not found!');
			return Redirect::to('classes');
		}
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the create form (app/views/classes/create.blade.php)
		return View::make('classes.create');
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
			'code'        => 'required',
			'parent_id'   => 'required|numeric',
			'tutoria_id'  => 'required|numeric',
			'description' => 'required',
			'start_at'    => 'required',
			'end_at'      => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('classes/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$classe              = new Classe;
			$classe->code        = Input::get('code');
			$classe->parent_id   = Input::get('parent_id');
			$classe->tutoria_id  = Input::get('tutoria_id');
			$classe->description = Input::get('description');
			$classe->start_at    = Input::get('start_at');
			$classe->end_at      = Input::get('end_at');
			$classe->save();

			// redirect
			Session::flash('message', 'Successfully created classe!');
			return Redirect::to('classes');
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
		// get the classe
		$classe = Classe::find($id);

		// show the view and pass the classe to it
		return View::make('classes.show')
			->with('classe', $classe);
	}

	/**
	 * Display the specified resource by code.
	 *
	 * @param  string  $code
	 * @return Response
	 */
	public function showByCode($code)
	{
		$classetype  = explode("/", $code);
		$type        = end($classetype);
		$classes     = Classe::where('code', $type)->get();
		$exitclasses = false;
		$classe_id   = 0;
		foreach ($classes as $classe)
		{
			$urlItem = '/'. $classe->code;
			if($classetype==explode("/", substr($urlItem, 1)))
			{
				$classe_id = $classe->id;
				$exitclasses = true;
			}
			$item = $classe->parent;
			while($item != NULL)
			{
				$urlItem = '/'. $item->code . $urlItem;
				if($classetype==explode("/", substr($urlItem, 1)))
				{
					$classe_id = $classe->id;
					$exitclasses = true;
				}
				if($exitclasses) break; 
				$item = $item->parent;
			}
			if($exitclasses) break; 
		}
		
		if($classe_id != 0)
		{
			return self::show($classe_id);
		}
		else
		{
			// redirect
			Session::flash('message', 'Classe not found!');
			return Redirect::to('classes');
		}
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the classe
		$classe = Classe::find($id);

		// show the edit form and pass the classe
		return View::make('classes.edit')
			->with('classe', $classe);
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
			'parent_id' 	  => 'required|numeric',
			'tutoria_id' 	  => 'required|numeric',
			'description' => 'required',
			'start_at' => 'required',
			'end_at' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('classes/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$classe = Classe::find($id);
			$classe->code       = Input::get('code');
			$classe->parent_id       = Input::get('parent_id');
			$classe->tutoria_id       = Input::get('tutoria_id');
			$classe->description      = Input::get('description');
			$classe->start_at = Input::get('start_at');
			$classe->end_at = Input::get('end_at');
			$classe->save();

			// redirect
			Session::flash('message', 'Successfully updated classe!');
			return Redirect::to('classes');
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
		$classe = Classe::find($id);
		$classe->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the classe!');
		return Redirect::to('classes');
	}

}