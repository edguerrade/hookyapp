<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home');
});

// Route::pattern('id', '[0-9]+');

Route::resource('lessons', 'LessonController');
Route::resource('tutorials/excel', 'ExcelController@tutorials');
Route::resource('tutorials', 'TutorialController');
Route::resource('groups', 'GroupController');
Route::resource('users/import-csv', 'ExcelController@importUsers');
Route::resource('users', 'UserController');
Route::resource('users/image', 'UserController@updateImage');
Route::resource('users/groups', 'UserController@updateGroups');
Route::resource('users/permissions', 'UserController@updatePermissions');
Route::resource('classes', 'ClasseController');

# Classe Management
Route::group(array('prefix' => 'classes'), function()
{
	Route::get('{any?}/list', array(
	    'as'   => 'admin',
	    'uses' => 'ClasseController@getListByCode'
	))->where('any', '(.*)?');

	Route::get('{any?}/show', array(
	    'as'   => 'admin',
	    'uses' => 'ClasseController@showByCode'
	))->where('any', '(.*)?');
});

Route::get('api/search', 'ApiSearchController@index');

// Display all SQL executed in Eloquent
/*Event::listen('illuminate.query', function($query)
{
    var_dump($query . '<br>');
});*/