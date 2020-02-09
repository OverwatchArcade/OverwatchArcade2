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


Route::get('/login', 'Auth\RegisterController@redirectAuthenticationPage')->name('login');
Route::get('/login/callback', 'Auth\RegisterController@callback');

Route::get('/api/overwatch/today', 'API\OverwatchApiController@today');
Route::get('/api/overwatch/arcademodes', 'API\OverwatchApiController@gamemodes');
Route::get('/api/overwatch2/today', 'API\Overwatch2ApiController@today');
Route::get('/api/overwatch2/arcademodes', 'API\Overwatch2ApiController@gamemodes');
Route::get('/api/users', 'API\UserApiController@getAllUsers');
Route::get('/api/user/{battletag}', 'API\UserApiController@getUserProfile');
Route::post('/api/user/update', 'API\UserApiController@updateUserProfile');

Route::get('https://google.com')->name('api_screenshot');

Route::get('/staff/overwatch', 'ContributeController@index');
Route::get('/staff/settings', 'ContributeController@settings');
Route::post('/staff/overwatch/submit', 'ContributeController@submitTodaysArcade');

Route::get('/{any}', 'AppController@index')->where('any', '.*');
