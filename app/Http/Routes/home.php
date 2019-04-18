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
        Route::any('/course/index','CourseController@index');
        Route::any('/course/details/{id}','CourseController@details');
        Route::any('/news/index','NewsController@index');
        Route::any('/news/details/{id}','NewsController@details');
        Route::any('/news/mall','NewsController@mall');

        Route::any('/check_category/index','CheckCategoryController@index');
        Route::any('/check_category/details/{id}','CheckCategoryController@details');
        Route::any('/check_content/index/{id}','CheckContentController@index');
        Route::any('/check_content/details','CheckContentController@details');
        Route::any('/check_content/null','CheckContentController@null');
        Route::any('/collect_news','NewsController@collect_news');
        Route::any('/get_collect_news','NewsController@get_collect_news');
        Route::any('/getUserInfo','NewsController@getUserInfo');
    });
});
