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
Route::get('/nada', function () {
    return "nada";
});

Route::get('files/my-example-file.pdf', function () {
    return response()->file($path);
});
// Route::resource('acta_nacimiento', acta_nacimientoController::class);
