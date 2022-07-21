<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\acta_nacimientoController;
use App\http\Controllers\acta_defuncionController;
use App\http\Controllers\acta_matrimonioController;
use App\http\Controllers\personaController;
use App\http\Controllers\pdfController;
use App\Http\Controllers\userController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActasPDFController;
use Illuminate\Routing\RouteGroup;

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
Route::post('save_pdf_defunciones',[pdfController::class, 'save_defunciones']);
Route::post('save_pdf_nacimientos',[pdfController::class, 'save_nacimientos']);
Route::post('save_pdf_matrimonios',[pdfController::class, 'save_matrimonios']);
// Route::post('save_pdf',[pdfController::class, 'save']);

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [userController::class, 'logout']);
    Route::post('me', [userController::class, 'save']);
});

Route::get('actas_pdf', [ActasPDFController::class,'return_acta_pdf']);

Route::get('archivos/ejemplo.pdf', [pdfController::class, 'recuperar_acta']);
