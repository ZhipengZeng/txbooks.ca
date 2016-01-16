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
// Route::get('test', 'Test\TestAjaxController@test');

Route::get('aboutus', function(){
	return view('aboutus');
})->name('aboutus');

Route::get('mybooks/delete/{id}', 'BookController@deleteMyBook' )->name('deleteMyBook');
Route::get('mybooks', 'BookController@getMyBooks')->name('getMyBooks');

Route::post('book/post/ajaxGetCourses', 'BookController@ajaxGetCourses')->name('ajaxGetCourses');
Route::post('book/post/ajaxGetPrograms', 'BookController@ajaxGetPrograms')->name('ajaxGetPrograms');
Route::post('book/post/ajaxGetSchools', 'BookController@ajaxGetSchools')->name('ajaxGetSchools');

Route::get('book/post', 'BookController@create')->name('book_create');
Route::post('book/post', 'BookController@store')->name('book_store');
Route::get('book/{id}', 'BookController@getBook')->name('book');
Route::get('sidebar/school/{id}', 'SidebarController@schoolClicked')->name('schoolClicked');


// Route::get('test', 'Test\TestController@test');

Route::get('admin', 'Admin\AdminController@getIndex')->name('admin');
Route::post('admin/schools', 'Admin\SchoolController@postAdd');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');


Route::get('auth/register', 'Auth\UserController@getRegister')->name('register');
Route::post('auth/register', array('before'=>'csrf','uses'=>'Auth\UserController@postRegister'));

Route::get('authlogout', 'Auth\UserController@logout');
Route::get('auth/verify/{confirmation_code}', 'Auth\UserController@verify');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');



Route::get('auth/login/{provider?}', 'Auth\AuthController@sociallogin')->name('twitter');
Route::get('auth/dashboard/{provider?}', 'Auth\AuthController@sociallogin')->name('dashboard');



Route::get('admin/schools', 'Admin\SchoolController@getIndex')->name('schools');
Route::get('admin/schools/delete/{id}', 'Admin\SchoolController@getDelete');







// Route::get('demo/map/{id?}', function($id = null){
// 	return view('demo/map')->with('id', $id);
// });
Route::get('home/books/program/{id}', 'SearchController@getBooks')->name('getBooks');
Route::get('/home', 'SearchController@search')->name('search');
Route::get('/{home?}', 'HomeController@index')->name('home');

