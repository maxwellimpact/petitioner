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
    $petitions = App\Petition::recentPublished()
                         ->paginate(10);
                     
    return view('welcome', ['petitions' => $petitions]);
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('petitions', 'PetitionController', [
    'parameters' => 'singular'
]);

Route::resource('petitions.signs', 'SignController', [
    'parameters' => 'singular'
]);
