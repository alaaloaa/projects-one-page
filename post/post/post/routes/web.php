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
	$posts = App\Post::orderBy('created_at', 'desc')->get();
    return view('views/home', compact('posts'));
})->name('/');

Route::post('/post/create', 'posts@create')->name('post/create');
Route::get('/post/edit/{id}', 'posts@edit')->name('post/edit');
Route::post('/post/update/{id}', 'posts@update')->name('post/update');
Route::get('/post/delete/{id}', 'posts@delete')->name('post/delete');
