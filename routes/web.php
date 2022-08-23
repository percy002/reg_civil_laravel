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


// Route::get('/', function () {
//     return view('template.admin_template')->middleware('auth');;
// });

Route::middleware(['auth'])->group(function () {
    
});
Route::resource('acta_defuncion', acta_defuncionController::class)->middleware('auth');
Route::resource('acta_matrimonio', acta_matrimonioController::class)->middleware('auth');
Route::resource('acta_nacimiento', acta_nacimientoController::class)->middleware('auth');
Route::resource('usuarios', userController::class)->middleware('auth');


// Route::resource('acta_nacimiento', acta_nacimientoController::class);

// Auth::routes();
// Route::get('login', );
// Route::post('login', );
Route::get('/', function () {
    return view("auth.login");
})->name("inicio");

Route::post('/login', function () {
    $credentials = request()->only('dni','password');

    if(Auth::attempt($credentials)){
        request()->session()->regenerate();
        // dd(Auth::attempt($credentials));
        return redirect()->intended('acta_nacimiento');
    }
    else
    return redirect("/");
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
 
    request()->session()->invalidate();
 
    request()->session()->regenerateToken();
 
    return redirect('/');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
