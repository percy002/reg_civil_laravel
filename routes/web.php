<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\acta_nacimientoController;
use App\http\Controllers\acta_defuncionController;
use App\http\Controllers\acta_matrimonioController;
use App\http\Controllers\personaController;
use App\http\Controllers\pdfController;
use App\Http\Controllers\userController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActasPDFController;

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

Route::get('/admin', function () {
    return view('template.admin_template');
});
Route::resource('acta_defuncion', acta_defuncionController::class);

Route::get('files/my-example-file.pdf', function () {
    return response()->file($path);
});
// Route::resource('acta_nacimiento', acta_nacimientoController::class);
