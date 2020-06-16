<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('v1/languages', 'Api\v1\LanguageController@index');
Route::get('v1/languages/{language_id}', 'Api\v1\LanguageController@get');
Route::post('v1/languages', 'Api\v1\LanguageController@add');
Route::put('v1/languages/{language_id}', 'Api\v1\LanguageController@update');
Route::delete('v1/languages/{language_id}', 'Api\v1\LanguageController@delete');
