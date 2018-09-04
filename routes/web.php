<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/datatable',[
       'uses'  =>'UsersController@index',
        'as' => 'datatable'
]);

Route::get('/ajaxdatatable',[
    'uses'  =>'UsersController@ajaxdatatable',
    'as' => 'ajaxdatatable'
]);


Route::get('/user/{id}','UsersController@destroy');

Route::post('user/store', 'UsersController@store')->name('user.store');

Route::get('/api/users', 'APIController@getUsers')->name('api.users');