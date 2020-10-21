<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/storeNote','App\Http\Controllers\NotesController@storeNote');
Route::get('/getNotes', 'App\Http\Controllers\NotesController@getNotes');
Route::post('/deleteNote/{id}', 'App\Http\Controllers\NotesController@deleteNote');
Route::post('/editNotes/{id}', 'App\Http\Controllers\NotesController@editNote');
