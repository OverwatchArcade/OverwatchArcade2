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

Route::get('/settings', 'ContributeController@settings');
Route::post('/settings/user/update', 'ContributeController@updateUserProfile');
Route::get('/api/avatars', 'ContributeController@getAvatars');

Route::get('/staff/overwatch', 'ContributeController@overwatch_submit_index');
Route::get('/staff/overwatch2', 'ContributeController@overwatch2_submit_index');
Route::post('/staff/overwatch/submit', 'ContributeController@submitOverwatchTodaysArcade');
Route::post('/staff/overwatch/undo', 'ContributeController@undoOverwatchTodaysArcade');
Route::post('/staff/overwatch2/submit', 'ContributeController@submitOverwatch2TodaysArcade');
Route::post('/staff/overwatch2/undo', 'ContributeController@undoOverwatch2TodaysArcade');

Route::get('/{any}', 'AppController@index')->where('any', '.*');
