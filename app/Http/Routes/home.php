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
use Illuminate\Support\Facades\Route;


Route::get('home', function () {
    return redirect('/home/index');
});


Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
    Route::any('/index','IndexController@index');

    Route::group(['middleware'=>'api'],function (){
        Route::any('/about/index','AboutController@index');
        Route::any('/product/index','ProductController@index');
        Route::any('/product/detail/{id}','ProductController@detail');
        Route::any('/reveal/index','RevealController@index');
        Route::any('/reveal/detail/{id}','RevealController@detail');
        Route::any('/news/index','NewsController@index');
        Route::any('/news/detail/{id}','NewsController@detail');
        Route::any('/contact/index','ContactController@index');
        Route::any('/contact/feedback','ContactController@feedback');
    });
});
