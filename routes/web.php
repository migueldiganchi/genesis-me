<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/notes'], function ($router) {
   $router->get('/', 'NoteController@index');
   $router->post('/', 'NoteController@store');
   $router->patch('/{id}', 'NoteController@update');
   $router->delete('/{id}', 'NoteController@destroy');
});
