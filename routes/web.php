<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::match(["GET","post"],"/register",function(){
  return redirect('login');
})->name('register');

Route::view('template', 'layouts.template2');

Route::resource('jalan', 'JalanController')->except(['show']);
Route::get('jalan.destroy/{id}','JalanController@destroy')->name('jalan.destroy');

Route::get('export_jalan', 'ExcelController@export_jalan')->name('export_jalan');
Route::post('import_jalan', 'ExcelController@import_jalan')->name('import_jalan');

Route::resource('jaringan', 'JaringanController');
Route::resource('user', 'UserController');
Route::resource('pegawai', 'PegawaiController')->except(['show']);
Route::resource('tiang', 'TiangController');
Route::resource('ktlampu', 'KtLampuController')->except(['show']);
Route::resource('lampu', 'LampuController');

Route::get('kordinat_lampu', 'LampuController@koordinat');
Route::get('lampu.destroy/{id}','lampuController@destroy')->name('lampu.destroy');
//Route::post('lampu/{id}/update_kor', 'LampuController@update_kor');
Route::get('export_lampu', 'ExcelController@export_lampu')->name('export_lampu');
Route::post('import_lampu', 'ExcelController@import_lampu')->name('import_lampu');

Route::resource('marker', 'Marker1Controller');

Route::get('kordinat_marker', 'Marker1Controller@koordinat')->name('kordinat_marker');
Route::get('export_marker', 'ExcelController@export_marker')->name('export_marker');
Route::post('import_marker', 'ExcelController@import_marker')->name('import_marker');

Route::resource('panel','PanelController');
Route::get('panel.destroy/{id}','PanelController@destroy')->name('panel.destroy');
Route::get('kordinat_panel', 'PanelController@kordinat');
Route::get('export_panel', 'ExcelController@export_panel')->name('export_panel');
Route::post('import_panel', 'ExcelController@import_panel')->name('import_panel');

Route::resource('travo','TravoController');
Route::get('travo.destroy/{id}','TravoController@destroy')->name('travo.destroy');
Route::get('kordinat_travo','TravoController@kordinat');

Route::get('export_travo', 'ExcelController@export_travo')->name('export_travo');
Route::post('import_travo', 'ExcelController@import_travo')->name('import_travo');

Route::get('getdatamarker',[
            'uses' => 'Marker1Controller@getdatamarker',
            'as'   => 'ajax.get.data.marker',
            ]);
