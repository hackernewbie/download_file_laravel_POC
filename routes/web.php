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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\MainController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
	Route::get('/home','App\Http\Controllers\MainController@index')->name('home');
	Route::post('/file/upload','App\Http\Controllers\MainController@FileUpload')->name('file-upload');
	Route::get('/file/donwload/{file_id}','App\Http\Controllers\MainController@FileDownload')->name('file-download');
});

