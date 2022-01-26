<?php
use Illuminate\Support\Facades\Route;
//Importante poner esta ruta de abajo porque sino no deja llamar a la clase
use App\Http\Controllers\AuthController;
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

//DESARROLLO
//Home
Route::view('/', 'home')->name('home');
//Router auth

Route::get('/login', [AuthController::class, 'getLogin']);  
Route::post('/login', [AuthController::class, 'postLogin']);

Route::get('/logout', [AuthController::class, 'getLogout']);

Route::get('/register', [AuthController::class, 'getRegister']);
Route::post('/register', [AuthController::class, 'postRegister']);