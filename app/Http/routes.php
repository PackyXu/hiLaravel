<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
| 文件调用的模板文件在resources／views／中
| sites.test == sites/test 两者写法不同，意思一样。
| 定义多个路由文件。
|
|
*/
//Auth::loginUsingId(2);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    $data = array ('one'=>'apple','two'=>'google');
    return view('sites.test',$data);
});
Route::get('/hello','TestController@hello');
Route::get('/contact','TestController@contact');
    /*Route::get('/articles','ArticlesController@index');
    Route::get('/articles/create','ArticlesController@create');
    Route::get('/articles/{id}','ArticlesController@show');
    Route::post('/articles','ArticlesController@store');*/
//注册多条路由
Route::resource('/articles','ArticlesController');

    /**
     * 登陆、注册、退出路由
     */
Route::get('/auth/login','Auth\AuthController@getLogin');
Route::post('/auth/login','Auth\AuthController@postLogin');

Route::get('/auth/register','Auth\AuthController@getRegister');
Route::post('/auth/register','Auth\AuthController@postRegister');

Route::get('/auth/logout','Auth\AuthController@getLogout');