<?php

class LessonController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /lesson
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the lessons
		$lessons = Lesson::all();

		// load the view and pass the lessons
		return View::make('lessons.index')
			->with('lessons', $lessons);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /lesson/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /lesson
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /lesson/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /lesson/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /lesson/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /lesson/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}