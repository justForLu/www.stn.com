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

Route::any('/api', 'ServerController@serve');
Route::any('/callback', 'ServerController@callback');
Route::any('/notify', 'ServerController@notify');
Route::any('/dispatch', 'ServerController@dispatchMenu');
Route::get('/soap/show','SoapController@show');
Route::any('/soap/webservice','SoapController@webservice');
Route::any('/soap/test','SoapController@test');

foreach(File::allFiles(__DIR__.'/Routes') as $partial)
{
    require_once $partial->getPathname();
}