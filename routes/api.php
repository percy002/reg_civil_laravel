<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\acta_nacimientoController;
use App\http\Controllers\acta_defuncionController;
use App\http\Controllers\acta_matrimonioController;
use App\http\Controllers\personaController;
use App\http\Controllers\pdfController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('/', personaController::class);
Route::resource('persona', personaController::class);
Route::resource('acta_nacimiento', acta_nacimientoController::class);
Route::resource('acta_defuncion', acta_defuncionController::class);
Route::resource('acta_matrimonio', acta_matrimonioController::class);
// Route::resource('usuario', usuarioController::class);
Route::post('save_pdf',[pdfController::class, 'save']);
