<?php

use Illuminate\Support\Facades\Route;
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


Route::get('/','HomepageController@index')->name('home');

Route::get('/teams/{id}','TeamController@showTeam')->name('team.show');
Route::get('/teams','TeamController@teams')->name('teams');

Route::get('/camps/{id}','TournamentController@show')->name('camp.show');

Route::get('/news/{id}','NewsController@showNews')->name('news.show');
Route::get('/news','NewsController@showNewsCategory')->name('news.showCategory');


Route::get('/kontakt','ContactController@index')->name('contact');
Route::get('/impressum','ContactController@impress')->name('impress');
Route::get('/datenschutz','ContactController@privacy')->name('privacy');

Route::get('/ueber-uns','StaticSiteController@showVerein')->name('verein');
Route::get('/vorstand','StaticSiteController@showVorstand')->name('vorstand');
Route::get('/trainer','StaticSiteController@showTrainer')->name('trainer');
Route::get('/schiedsrichter','StaticSiteController@showSchiedsrichter')->name('schiedsrichter');

Route::get('/persons/{id}','PersonController@show')->name('person.show');
Route::get('/turnier/{id}','TournamentController@show')->name('tournament.show');

Route::get('/downloads','DownloadController@index')->name('downloads');
Route::get('/download/{id}','DownloadController@download')->name('download');

Route::get('/academy/bc70','StaticSiteController@bc70')->name('bc70-academy');
Route::get('/academy/kindersport','StaticSiteController@kinder')->name('kinder-academy');