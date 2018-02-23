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

Auth::routes();

Route::view('/', 'home')->middleware('auth');
Route::view('/home', 'home')->middleware('auth');

Route::resource('songs', 'SongController')->middleware('auth');
Route::resource('songs.verses', 'VerseController')->middleware('auth');
