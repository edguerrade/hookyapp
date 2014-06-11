<?php

class ExcelController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function tutorials()
	{
		/*Excel::create('New file', function($excel) {

		    $excel->sheet('First sheet', function($sheet) {

		    	$tutorials = Tutorial::all();
		        $sheet->loadView('tutorials.index')
					->with('tutorials', $tutorials);
		    });

		})->export('xls');*/
		Excel::create('Filename', function($excel) {

		    // Set the title
		    $excel->setTitle('Our new awesome title');

		    // Chain the setters
		    $excel->setCreator('Edgar Guerra')
		          ->setCompany('HookyApp');

		    // Call them separately
		    $excel->setDescription('A demonstration to change the file properties');

		    $excel->sheet('Sheetname', function($sheet) {

		    	$tutorials = Tutorial::all()->toArray();
		    	$sheet->fromArray(array(array('id', 'code', 'description', 'tutorid'), array($tutorials)));
		    	//$sheet->fromArray($tutorials);
		        $sheet->freezeFirstRow();

		    });

		})->export('xls');
	}

	public function importUsers()
	{
		// validate
		$rules = array(
			'csvmails' => 'required|mimes:txt,csv|max:3000'
			//'csvmails' => 'required|mimes:xls,xlsx|max:3000'
		);
		//mimes:gif,jpg,jpeg,png,bmp,zip,zipx,txt,csv,doc,docx,xls,xlsx,pdf

	    $validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('users')
				->withErrors($validator)
				->withInput();
		} else {
			if (Input::hasFile('csvmails')) {
				$file = Input::file('csvmails');
				// echo $file->getRealPath();
				// echo $file->getMimeType();
				$destinationPath = 'app/storage/tmp/import';
				$extension = $file->getClientOriginalExtension();
				$filename = str_random(12)."_import_users.{$extension}";
				//$filename = $file->getClientOriginalName(); 
				$upload_success = $file->move($destinationPath, $filename);
				if( $upload_success ) {
					$file = File::get('app/storage/tmp/import/'.$filename);
					$emails = explode(";", $file);
					foreach ($emails as $email => $value) {
						$validator = Validator::make(
						    array('email' => trim($value)),
						    array('email' => 'required|email')
						);
						if (!$validator->fails())
						{
						    $count = User::where('email', trim($value))->count();
							echo $value. '|' . $count. '|';
							if($count) {
								$user_email = User::where('email', trim($value))->first();
								echo $user_email->name;
							}
							echo '<br>';
						}
						
					}
					
					/*Excel::load('app/storage/tmp/import/'.$filename, function($reader) {

				    	$reader->toArray();
				    	$reader->dump();
				    	
					});*/
					exit();
					Session::flash('message', 'Successfully import users!');
					return Redirect::to('users');
				} else {
					Session::flash('message', 'Failed import users!');
					return Redirect::to('users');
				}
			}
			else
			{
				echo "Falta archivo.";
			}
		}
	}
}