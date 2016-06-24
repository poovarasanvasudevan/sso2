<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if (!Auth::user())
        return view('welcome');
    else
        return response()->redirectTo('/dashboard');
});

Route::post('/login', 'LoginController@login');
Route::get('/dashboard', 'LoginController@dashboard');
Route::get('/logout', 'LoginController@logout');
Route::get('/allartefacttype', 'ArtefactController@getAllArtefactType');
Route::get('/definition', 'DefinitionController@index');
Route::get('/alllocation', 'ArchiveLocationController@getAllLocation');
