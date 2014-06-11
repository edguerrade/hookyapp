<?php

/**
 * Api/SearchController is used for the "smart" search throughout the site.
 * it returns and array of items (with type and icon specified) so that the selectize.js plugin 
 * can render the search results properly
 **/

class ApiSearchController extends \BaseController {

	public function appendValue($data, $type, $element, $force = false)
	{
		// operate on the item passed by reference, adding the element and type
		foreach ($data as $key => & $item) {
			if($force) {
				$item[$element] = $type;
			} else {
				if(isset($item[$element]) && $item[$element] == "") {
					$item[$element] = $type;
				} elseif (!isset($item[$element])) {
					$item[$element] = $type;
				}
			}
		}
		return $data;		
	}

	public function appendURL($data, $prefix)
	{
		// operate on the item passed by reference, adding the url based on slug
		foreach ($data as $key => & $item) {
			$item['url'] = url($prefix.'/'.$item['id']);
		}
		return $data;		
	}

	public function index()
	{
		$query = e(Input::get('q',''));

		if(!$query && $query == '') return Response::json(array(), 400);

		$classes = Classe::where('code','like','%'.$query.'%')
			->orWhere('description','like','%'.$query.'%')
			->orderBy('code','asc')
			->take(5)
			->get(array('id', 'code AS name','description'))
			->toArray();

		$tutorials = Tutorial::where('code','like','%'.$query.'%')
			->orWhere('description','like','%'.$query.'%')
			->orderBy('code','asc')
			->take(5)
			->get(array('id', 'code AS name','description'))
			->toArray();

		$users = User::where('first_name','like','%'.$query.'%')
			->orWhere('last_name','like','%'.$query.'%')
			// ->orWhere('email','like','%'.$query.'%')
			->orderBy('first_name','asc')
			->take(5)
			->get(array('id', DB::raw('CONCAT(first_name, " ", last_name) AS name'), 'avatar AS icon', 'email'))
			->toArray();

		// Data normalization
		//$classes   = $this->appendValue($classes, 'assets/img/blank.png','icon');
		//$tutorials = $this->appendValue($tutorials, 'assets/img/blank.png','icon');
		$users     = $this->appendValue($users, 'assets/img/default-avatar.png','icon');

		$classes   = $this->appendURL($classes, 'classes');
		$tutorials = $this->appendURL($tutorials, 'tutorials');
		$users     = $this->appendURL($users, 'users');

		// Add type of data to each item of each set of results
		$classes   = $this->appendValue($classes, 'classe', 'class');
		$tutorials = $this->appendValue($tutorials, 'tutorial', 'class');
		$users     = $this->appendValue($users, 'user', 'class');

		// Merge all data into one array
		$data = array_merge($classes, $tutorials, $users);

		return Response::json(array(
			'data'=>$data
		));
	}

}