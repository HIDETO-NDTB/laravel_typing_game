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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'DrillsController@index')->name('drills');

Route::get('/drills/show/{id}', 'DrillsController@show')->name('drills.show');

Route::group([ 'middleware' => 'auth'], function () {
    Route::get('/mypage', 'DrillsController@mypage')->name('mypage');
    Route::get('/drills/new', 'DrillsController@new')->name('new');
    Route::post('/drills/new', 'DrillsController@create')->name('drills.create');
    Route::get('/drills/{id}', 'DrillsController@edit')->name('drills.edit');
    Route::post('/drills/{id}', 'DrillsController@update')->name('drills.update');
    Route::post('drills/{id}/delete', 'DrillsController@destroy')->name('drills.delete');
});
