<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

# routes/api.php
Route::get('/politics/section', 'SectionController@index');
Route::get('/choice/university', 'UniversityController@index');
Route::get('/choice/branch', 'BranchController@index');
Route::get('/choice/profession', 'ProfessionController@index');
Route::get('/university/sort/{universityID}/{sortType}', 'UniversityController@getItems');
Route::post('/university/sort', 'UniversityController@sort');
