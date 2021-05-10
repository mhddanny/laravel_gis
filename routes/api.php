<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('travo','Api\TravoController');
Route::get('search_travo','Api\TravoController@search');

Route::post('login_pegawai','Api\PegawaiController@login_pegawai');
Route::get('get_kategorilampu','Api\KategorilampuController@get_all');

Route::get('jalan','Api\JalanController@get_jalan');

Route::get('panel','Api\PanelController@get_panel');
Route::post('panel_store','Api\PanelController@store');
Route::get('panelshow/{id}','Api\PanelController@show');
Route::put('panelupdate/{id}','Api\PanelController@update');
Route::delete('paneldelete/{id}','Api\PanelController@delete');

Route::apiResource('lampu','Api\LampuController');
Route::get('search_lampu','Api\LampuController@search');

Route::apiResource('marker','Api\Marker1Controller');
