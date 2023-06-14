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
// Route::group(['prefix' => 'category'] ,function(){
Route::group(['middleware' => ['role:super_admin|admin']], function() {
    Route::resource('/category', 'CategoryController');
    Route::post('/categoriesPosition', 'CategoryController@categoriesPosition');
    Route::resource('/tags', 'TagsController');
    Route::post('/topics_store', 'TagsController@topicsStore');

    Route::get('/link/create', 'CategoryController@create_link');
    Route::post('/link/store', 'CategoryController@store_link');
    Route::get('/link/{id}/edit', 'CategoryController@edit_link');
    Route::patch('/link/update/{id}', 'CategoryController@update_link');

});
