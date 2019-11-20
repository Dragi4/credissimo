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

    $clients = \App\Clients::all();

    return view('welcome', ['clients' => $clients]);
})->name('welcome');


Route::get('/test', "TestController@test");
Route::post('deposits-add/{id}', 'DepositsController@add');